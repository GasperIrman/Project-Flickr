<?php 	require_once('./Connection/database.php');
		require_once('./Connection/session.php');?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="./Templates/styles.css"/>
	</head>
<body>
		<nav id="menu">
			<ul id="menulist">
				<li><div class="nav py-2 d-none d-md-inline-block"><a href="index.php">Home</a></div></li>
				 
						<?php if(isset($_SESSION['user_id'])){echo '<li><div class="nav py-2 d-none d-md-inline-block"><a href="upload.php">Upload</a></div></li>';}
								?>
								
				
				<li id="hello"><div class="nav py-2 d-none d-md-inline-block"> 
					<?php if(isset($_SESSION['user_id'])){echo "Hello <a href=\"profile.php?username=".$_SESSION['username']."\">".$_SESSION['name']."</a>";}
							else {echo '<a href="login.php">Log in</a>';} ?>
							</div></li>
				<li id="logout"><div class="nav py-2 d-none d-md-inline-block">
					<?php if(isset($_SESSION['user_id'])) echo'<a href="PHP/logout.php">Logout</a>'; else echo '<a href="register.php">Sign up</a>'?>
						</div></li>
				<li id="logout"><div class="nav py-2 d-none d-md-inline-block">
					<?php if(isset($_SESSION['user_id'])) echo'<form action="index.php"><input name="s" type="text" placeholder="Search.."></form>';?>
						</div></li>

			</ul>
		</nav>
	<div id="content"></body>
