<?php 	require_once('./Templates/header.php');?>



<form id="login" method="post" action="./PHP/registerInsert.php">
	<br>
	<table>
		<tr><td>Username:</td><td><input type="text" name="username"></td></tr><tr></tr>
		<tr><td>Name:</td><td><input type="text" name="name"></td></tr><tr></tr>
		<tr><td>Surname:</td><td><input type="text" name="surname"></td></tr><tr></tr>
		<tr><td>Email:</td><td><input type="text" name="email"></td></tr><tr></tr>
	 	<tr><td>Password:</td><td><input type="text" name="password"></td></tr>
	<tr><td><input type="submit" value="Register"></td></tr>
</table>
</form>
<br>
