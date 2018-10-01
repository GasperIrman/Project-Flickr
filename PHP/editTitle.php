<?php
require_once '../Connection/session.php';
require_once '../Connection/database.php';

if(isset($_GET['title']) && isset($_GET['id']))
{
	$title =  $_GET['title'];
$id =  $_GET['id'];

$query = "UPDATE posts SET title = ? WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$title, $id]);
header("Location: ../index.php");
}
else
	header("Location: ../index.php");	
?>