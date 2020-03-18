<?php 
	session_start();

	session_unset();
	session_destroy();
	setcookie("user[User_email]", "");
    setcookie("user[User_mdp]", "");
    unset($_COOKIE["user"]);
	header("Location: index.php");
	exit;