<?php

	require_once '../Connection/session.php';
	require_once '../Connection/database.php';

	
	$user = $_POST['email'];
	$pass = $_POST['password'];
	//echo $user."<br>".$pass;

	if(!empty($user) && !empty($pass))
	{
		$query = 'SELECT * FROM users WHERE email=? AND password=?';
		$stmt = $pdo->prepare($query);
		$stmt->execute([$user, $pass]);

		if($stmt->rowCount() != 1)
		{
			header('Location: ../login.php');
		}

		else{
			$res = $stmt->fetch();
			$_SESSION['user_id'] = $res["id"];
            $_SESSION['name'] = $res["name"];
            $_SESSION['surname'] = $res["surname"];
            $_SESSION['username'] = $res["username"];

            header('Location: ../index.php');
		}
	}
	else{
		echo "empty username pa geslo";
		header('Location: ../login.php');
	}
?>