<?php
    session_start();

    $allowed = ['/Flickr/login.php','/Flickr/PHP/login_check.php',
                '/Flickr/register.php', '/Flickr/header.php', '/Flickr/PHP/googleLogin.php'];
    if ((!isset($_SESSION['user_id']) && !in_array($_SERVER['REQUEST_URI'], $allowed)) && substr($_SERVER['REQUEST_URI'], 0 ,27) != "/Flickr/PHP/googleLogin.php") {
		header("Location: login.php");
    }
    if(isset($_SESSION['user_id']) && $_SERVER['REQUEST_URI'] == "/Flickr/login.php") {
        header("Location: index.php");
    }

?>