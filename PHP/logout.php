<?php
	require_once '../Connection/session.php';
	require_once '../Connection/database.php';
    
    session_destroy();
    
    header("Location: ../login.php");
    
?>