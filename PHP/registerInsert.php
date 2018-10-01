<?php
require_once '../Connection/session.php';
require_once '../Connection/database.php';
 

if (isset($_POST['username'])&&isset($_POST['name'])&&isset($_POST['surname'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['birth']))
{
$usr = $_POST['username'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password= $_POST['password'];
//$password = sha1($pass);
$birth  = $_POST['birth'];
$query = "INSERT INTO users (username, name, surname, email, password, birthday) VALUES ('$usr', '$name', '$surname', '$email', '$password', '$birth')";
$pdo->query($query);
header("Location: ../index.php");
}

?>