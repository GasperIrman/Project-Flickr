<?php
require_once '../Connection/session.php';
require_once '../Connection/database.php';

if(isset($_GET['content']) && isset($_GET['id']))
{
	$content =  $_GET['content'];
	$id =  $_GET['id'];

$query = "UPDATE posts SET description = ? WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$content, $id]);
header("Location: ../index.php");
}
else
	header("Location: ../index.php");	
?>