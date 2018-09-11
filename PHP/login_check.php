<?php

	require_once '../Connection/session.php';
	require_once '../Connection/database.php';

	
	$user = $_POST['email'];
	$pass = $_POST['password'];
	echo $user."<br>".$pass;

	if(!empty($user) && !empty($pass))
	{
		//Zamenji z PDO

		$query = "SELECT * FROM users WHERE email='$user' AND password='$pass'";
		$stmt = $pdo->prepare($query);
		$stmt->execute(([$title]);

		$login = "SELECT * FROM users WHERE email='$user' AND password='$pass'";

		$logged = mysqli_query($link, $login);
		if(mysqli_num_rows($logged) != 1)
		{
			echo "ok ampak vec kot ena vrstica";
			//header('Location: login.php');
		}

		else{
			$user = mysqli_fetch_array($logged);
			$_SESSION['user_id'] = $user['id'];
            $_SESSION['ime'] = $user['ime'];
            $_SESSION['priimek'] = $user['priimek'];

				//Zamenji z PDO
				$query = "SELECT p.predmet_id, p.razred_id, i.ime AS ikratica, r.kratica FROM predmeti i INNER JOIN predmeti_razredi p ON p.predmet_id = i.id INNER JOIN razredi r ON r.id = p.razred_id WHERE p.ucitelj_id = ".$_SESSION['user_id'].";";
			echo "cist ok";
            //header('Location: index.php');
		}
	}
	else{
		echo "empty username pa geslo";
		//header('Location: login.php');
	}
?>