<?php
require_once '../Connection/session.php';
require_once '../Connection/database.php';

if(isset($_GET['id']))
{
	$query = "DELETE FROM posts WHERE id = ?";
	$query1 = "SELECT * FROM posts WHERE id = ?";
	$stmt1 = $pdo->prepare($query1);
	$stmt1->execute([$_GET['id']]);
	$line = $stmt1->fetch();
	$stmt = $pdo->prepare($query);
	$stmt->execute([$_GET['id']]);

	unlink($line['url']);
	header('Location: ../index.php');
}
else
{
	header('Location: ../index.php');
}
?>