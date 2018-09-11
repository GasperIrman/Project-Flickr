<?php
    session_start();

    $allowed = ['/Flickr/login.php','/Flickr/PHP/login_check.php',
                '/Flickr/register.php', '/Flickr/header.php'];

    if (!isset($_SESSION['user_id']) && !in_array($_SERVER['REQUEST_URI'], $allowed)) {
        header("Location: login.php");
    }

?>