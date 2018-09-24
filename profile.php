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


if(!isset($me))
{
	$query = "SELECT * FROM follows WHERE user_id = (SELECT id FROM users WHERE username='".$_GET['username']."') AND follower_id = ".$_SESSION['user_id']."";
	$stmt = $pdo->query($query);
	if($stmt->rowCount() == 1) $follow = true;
}

?>

<body>

<?php echo $line['username']."<br>".$line['name']." ".$line['surname']; 
//Check za follow gumb
if(!isset($me) && $follow == false) echo '<form method="post"><input name="follow" type="submit" value="Follow"></form>';
else if(!isset($me) && $follow == true) echo '<form method="post"><input name="unfollow" type="submit" value="Unfollow"></form>';

//Objave profila
$query = "SELECT * FROM posts WHERE user_id = (SELECT id FROM users WHERE username = ?) ORDER BY date DESC";
$stmt1 = $pdo->prepare($query);
$stmt1->execute([$_GET['username']]);

//Popravit ker učasih gre prevečkrat čez
if($line = $stmt1->fetch())
{
	for($i = 0; $i<$stmt1->rowCount(); $i++)
	{
	    	echo '<div style="text-align: center; margin-top: 50px; margin-botom: 50px"><h3 style="text-align: left">'.$line['title'].'</h3><img width="600" src="'.$line['url'].'" alt="Image missing">
	    	<p style="text-align: left">Description: '.$line['description'].'</p>
	    	</div>';
		$line = $stmt->fetch();
	}
}

?>
</body>

<?php 	include_once('./Templates/footer.php');?>