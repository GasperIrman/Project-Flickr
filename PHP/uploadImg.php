<?php

	require_once '../Connection/session.php';
	require_once '../Connection/database.php';

	if(isset($_POST['tags']))
	{
		$tags[] = explode(" ", $_POST['tags']);
	}
	$allowedFileTypes = ['jpg', 'png', 'jpeg', 'gif'];
	$targetDir = dirname(getcwd(), 1).'\Uploads';
	$targetFile = $targetDir;
	$url = 'Uploads';
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
	        	$targetFile .= "\img".$numPosts.".".$fileType;
	        	$url .= "\img".$numPosts.".".$fileType;
	        	if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) 
	        	{
			        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
			        $query = "INSERT INTO posts (url, title, description, user_id) VALUES (?, ?, 'test za zdj', '1');";
			        $stmt = $pdo->prepare($query);
			        $stmt->execute([$url, $fileName]);
			        header('Location: ../index.php');
			    } 

			    else 
			    {
			        echo "<script> alert(Sorry, there was an error uploading your file.)</scritp";
			        header('Location: ../index.php');
			    }
	        }
	    }
    } 

    else 
    {
        echo "File is not an image.";
        //NOT OK
    }
}
else
{
	echo "Choose a file pls";
}