<?php 	require_once('./Connection/database.php');
		require_once('./Connection/session.php');?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="./style.css"/>
	</head>
<body>
		<nav id="menu">
			<ul id="menulist">
				<li><div class="nav">Home</div></li>
				<li id="hello"><div class="nav"> 
					<?php if(isset($_SESSON['id']))echo "Hello ".$_SESSION['name'];
							else echo '<a href="login.php">Log in</a>'; ?>
								
							</div></li>
				<li id="logout"><div class="nav">
					<?php if(isset($_SESSION['id'])) echo'<a href="PHP/logout.php">Logout</a>'; else echo '<a href="register.php">Sign up</a>'?>
						
					</div></li>
			</ul>
		</nav>
	<div id="content"></body>
