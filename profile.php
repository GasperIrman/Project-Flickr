<?php 	require_once('./Templates/header.php');

if(!isset($_GET['username']))
{
	header("Location: index.php");
}
if(isset($_POST['follow']))
{
	//TODO če ga že followaš unfollow
	$query = "INSERT INTO follows (user_id, follower_id) VALUES ((SELECT id FROM users WHERE username='".$_GET['username']."'), ".$_SESSION['user_id'].")";
	$pdo->query($query);
}
if(isset($_POST['unfollow']))
{
	//TODO če ga že followaš unfollow
	$query = "DELETE FROM follows WHERE user_id = (SELECT id FROM users WHERE username='".$_GET['username']."') AND  follower_id = ".$_SESSION['user_id'];
	$pdo->query($query);
}

$query = "SELECT * FROM users WHERE username='".$_GET['username']."'";
$stmt = $pdo->query($query);
$line = $stmt->fetch();
$follow = false;

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
if(!isset($me) && $follow == false) echo '<form method="post"><input name="follow" type="submit" value="Follow"></form>';
else if(!isset($me) && $follow == true) echo '<form method="post"><input name="unfollow" type="submit" value="Unfollow"></form>';
$query = "SELECT * FROM posts WHERE user_id = (SELECT id FROM users WHERE username = ?) ORDER BY date DESC";
$stmt1 = $pdo->prepare($query);
$stmt1->execute([$_GET['username']]);


if($line = $stmt1->fetch())
{
for($i = 0; $i<$stmt->rowCount(); $i++)
{
	echo '<div style="text-align: center; margin-top: 50px; margin-botom: 50px"><img width="600" src="'.$line['url'].'" alt="Image missing">
	    	<p style="text-align: left">Description: '.$line['description'].'</p>
	    	</div>';
	$line = $stmt->fetch();
}
}

?>
</body>

<?php 	include_once('./Templates/footer.php');?>