<?php 	require_once('./Templates/header.php');

//Če v URL-ju ni uporabniškega imena -> na index
if(!isset($_GET['username']))
{
	header("Location: index.php");
}

//Če kliknemo follow sledimo profilu na katerem smo
if(isset($_POST['follow']))
{
	$query = "INSERT INTO follows (user_id, follower_id) VALUES ((SELECT id FROM users WHERE username='".$_GET['username']."'), ".$_SESSION['user_id'].")";
	$pdo->query($query);
}

//Če kliknemo follow ne sledimo več profilu na katerem smo
if(isset($_POST['unfollow']))
{
	$query = "DELETE FROM follows WHERE user_id = (SELECT id FROM users WHERE username='".$_GET['username']."') AND  follower_id = ".$_SESSION['user_id'];
	$pdo->query($query);
}
//SELECT vseh informacij o profilu, ki ga obiskujemo
$query = "SELECT * FROM users WHERE username='".$_GET['username']."'";
$stmt = $pdo->query($query);
$line = $stmt->fetch();
$follow = false;

//Check če je to naš profil
if($line['id'] == $_SESSION['user_id']) $me = true; 
else $me = false;


if(!$me)
{
	$query = "SELECT * FROM follows WHERE user_id = (SELECT id FROM users WHERE username='".$_GET['username']."') AND follower_id = ".$_SESSION['user_id']."";
	$stmt = $pdo->query($query);
	if($stmt->rowCount() == 1) $follow = true;
}

?>

<body>

<?php echo $line['username']."<br>".$line['name']." ".$line['surname']; 
//Check za follow gumb
if(!$me && $follow == false) echo '<form method="post" style"float: right"><input name="follow" type="submit" value="Follow"></form>';
else if(!$me && $follow == true) echo '<form method="post"  style"float: right"><input name="unfollow" type="submit" value="Unfollow"></form>';

//Objave profila
$query = "SELECT * FROM posts WHERE user_id = (SELECT id FROM users WHERE username = ?) ORDER BY date DESC";
$stmt = $pdo->prepare($query);
$stmt->execute([$_GET['username']]);
for($i = 0; $i<$stmt->rowCount(); $i++)
{
	if($me || $_SESSION['admin'])
	{
	
			$line = $stmt->fetch();
		    	echo '<div style="overflow: hidden"><h3 style="float: left; display: block; margin-right: 20px">'.$line['title'].'</h3><button id="'.$i.'" onclick="TitleOn(this.id)" style="float: left;height:48px;">Edit</button><form action="PHP/editTitle.php" id="editTitle'.$i.'" style="display: inline-block; float:left; margin-left: 10px; visibility: hidden"><input style="left: 10px;" type="text" name="title"><input hidden type="text" name="id" value="'.$line['id'].'"><br><input type="submit"></form><h3 style="float: right"><a href="PHP/delete.php?id='.$line['id'].'">Delete</a></h3></div><img width="600" src="'.$line['url'].'" alt="Image missing">
	    	<div style="overflow: hidden"><p style="float: left; margin-right: 10px">Description: '.$line['description'].'</p><button id="'.$i.'" onclick="ContentOn(this.id)" style="float: left; font-size: 10px">Edit</button><form action="PHP/editContent.php" id="editContent'.$i.'" style="display: inline-block; float_left; margin-left: 10px;visibility: hidden"><input type="text" name="content"><input hidden type="text" name="id" value="'.$line['id'].'"><br><input type="submit"></form></div>';
	}
	else
	{
			$line = $stmt->fetch();
		    	echo '<div style="text-align: center; margin-top: 50px; margin-botom: 50px"><h3 style="text-align: left">'.$line['title'].'</h3><img width="600" src="'.$line['url'].'" alt="Image missing">
            <p style="text-align: left">Description: '.$line['description'].'</p>';
	}
}
?>
    <script>
        function TitleOn(id)
        {
            var form = "editTitle" + id;
            console.log(form);
            document.getElementById(form).style.visibility="visible";
        }
        function ContentOn(id)
        {
            var form = "editContent" + id;
            console.log(form);
            document.getElementById(form).style.visibility="visible";
        }
    </script>
</body>

<?php 	include_once('./Templates/footer.php');?>