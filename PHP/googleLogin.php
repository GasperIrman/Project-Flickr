<?php
	require_once '../Connection/session.php';
	require_once '../Connection/database.php';

$id = $_GET['id'];
$name = $_GET['name'];
$email = $_GET['email'];
$name1 = explode(" ", $name);
$query = "SELECT * FROM users WHERE auth_token = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
$line = $stmt->fetch();
if(empty($line))
{
	$query = "INSERT INTO users (auth_token, username, name, surname, email) VALUES (?, ?, ?, ?, ?)";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$id, $name, $name1[0], $name1[1], $email]);

	$query = "SELECT * FROM users WHERE auth_token = ?";
	$stmt = $pdo->prepare($query);
	$stmt->execute([$id]);
	$line = $stmt->fetch();
}
			$_SESSION['user_id'] = $line['id'];
            $_SESSION['name'] = $line["name"];
            $_SESSION['surname'] = $line["surname"];
            $_SESSION['username'] = $name;

            header("Location: ../index.php");
?>