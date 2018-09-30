<?php
    session_start();

    $allowed = ['/FlickrTest/login.php','/FlickrTest/PHP/login_check.php',
                '/FlickrTest/register.php', '/FlickrTest/header.php', '/FlickrTest/PHP/registerInsert.php'];
    if ((!isset($_SESSION['user_id']) && !in_array($_SERVER['REQUEST_URI'], $allowed)) && substr($_SERVER['REQUEST_URI'], 0 ,27) != "/FlickrTest/PHP/googleLogin.php") {
		header("Location: login.php");
    }
    if(isset($_SESSION['user_id']) && $_SERVER['REQUEST_URI'] == "/FlickrTest/login.php") {
        //header("Location: index.php");
    }

?>