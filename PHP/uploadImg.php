<?php

	require_once '../Connection/session.php';
	require_once '../Connection/database.php';

	if(isset($_POST['tags']))
	{
		$tags = explode(" ", $_POST['tags']);
		$tags1 = explode(" ", $_POST['tags']);
	}
	foreach($tags as $tag) {
		$query = "SELECT * FROM tags WHERE tag = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$tag]);
		$return = $stmt->rowCount();
		echo "Found tag!! ".$tag."<br>";
		echo $return."<br>";
		if($return == 0)
		{
			$query = "INSERT INTO tags (tag) VALUES ('$tag')";
			$stmt = $pdo->query($query);
			//$stmt->execute([$tag]);
			echo "Inserted tag!! <br>";
		}
	}
	$allowedFileTypes = ['jpg', 'png', 'jpeg', 'gif'];
	$targetDir = dirname(getcwd(), 1).'/Uploads';
	$targetFile = $targetDir;
	$url = 'https://localhost/FlickrTest/Uploads';
	$url1 = 'Flickr/Uploads/';
	$fileType = strtolower(pathinfo($targetDir.basename($_FILES['file']['name']),PATHINFO_EXTENSION));
	$fileName = basename($_FILES['file']['name']);

if(isset($_POST["submit"]) && $_FILES["file"]["tmp_name"] != NULL) 
{
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) 
    {
        //echo "File is an image - " . $check["mime"] . ".";
        //OK
        if(in_array($fileType, $allowedFileTypes))
        {
        	//echo "File is correct type<br>";
	        if($_FILES['file']['size'] <= 20000000) //Ne sme bit večja od 20MB
	        {
	        	//echo "File is smaller than 20MB<br>";
	        	$query = "SELECT COUNT(*) FROM posts";
	        	$stmt = $pdo->query($query);
	        	$numPosts = $stmt->fetchColumn();
	        	//echo $numPosts;
	        	$numPosts++;
	        	$targetFile .= "/img".$numPosts.".".$fileType;
	        	$url .= "/img".$numPosts.".".$fileType;
	        	$url1 .= "/img".$numPosts.".".$fileType;
	        	echo "<br>".$url;

	        	$queryTags = "INSERT INTO posts_tags (post_id, tag_id) VALUES ((SELECT id FROM posts WHERE url = '$url'), (SELECT id FROM tags WHERE tag = ?))";

	        	if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) 
	        	{
			        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
			        $query = "INSERT INTO posts (url, title, description, user_id) VALUES (?, ?, ?, ?);";
			        $stmt = $pdo->prepare($query);
			        $stmt->execute([$url, $_POST['title'], $_POST['description'], $_SESSION['user_id']]);
			      	$stmt1 = $pdo->prepare($queryTags);
			      foreach($tags1 as $tag) {
			      	echo "<br>".$url;
			        $stmt1->execute([$tag]);
					echo $tag."<br>";
			    	}
			        header('Location: ../index.php');
			    } 

			    else 
			    {
			       header('Location: ../index.php');
			    }
	        }
	    }
    } 

    else 
    {
        //echo "File is not an image.";
        //NOT OK
        header("Location: ../upload.php");
    }
}
else
{
	//echo "Choose a file";
	header("Location: ../upload.php");
}