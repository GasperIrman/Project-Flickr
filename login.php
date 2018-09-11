<?php 	require_once('./Templates/header.php');?>



<form id="login" method="post" action="./PHP/login_check.php">
	Email: <input type="text" name="email"><br><br>
	Password: <input type="text" name="password"><br><br>
	<input type="submit">
</form>
<br>
<?php

$query = "SELECT name FROM users";
$stmt = $pdo->prepare($query);
$stmt->execute();
$row = $stmt->fetch();
echo $row['name'];
?>