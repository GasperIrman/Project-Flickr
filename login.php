<?php 	require_once('./Templates/header.php');?>

 <script src="https://apis.google.com/js/platform.js" async defer></script>
 <meta name="google-signin-client_id" content="662715309007-1leuk510kl8665491e6pipgmsm8fd1gs.apps.googleusercontent.com">
 <link rel="stylesheet" href="assets/css/main.css" />
<form id="login" method="post" action="./PHP/login_check.php">
	<br>
	<table>

		<tr><td><input id="demo-email" type="text" placeholder="email" name="email"></td></tr><tr></tr>
	 	<tr><td><input id="demo-name" type="password" placeholder="password" name="password"></td></tr>
	<tr><td><input type="submit" value="Login"></td></tr>
</table>
</form>
<!-- Google login -->
<br>Log in with Google<br>
<div class="g-signin2" data-onsuccess="onSignIn"></div>

<script>
function onSignIn(googleUser) {
	var profile = googleUser.getBasicProfile();
	var url = "PHP/googleLogin.php?id="+profile.getId()+"&name="+profile.getName()+"&email="+profile.getEmail();
	window.location.href = url;
}

</script>