<?php 
/**
 * 
 */
class secure
{
	static function redirect(){
		$script = explode("/", $_SERVER['SCRIPT_NAME']);
		$script = $script[sizeof($script)-1];

		if(!empty($_COOKIE['user']['User_email'])){
			$_SESSION['User_email'] = $_COOKIE['user']['User_email'];
		}
		if(!empty($_COOKIE['user']['User_mdp'])){
			$_SESSION['User_mdp'] = $_COOKIE['user']['User_mdp'];
		}

		if((empty($_SESSION['User_email']) || empty($_SESSION['User_mdp']) || !user::checkUser($_SESSION['User_email'], $_SESSION['User_mdp'])) && $script != "login.php"){
			header("Location: login.php");
			exit;
		}
	}

	static function validateForm($User_email, $User_mdp){
		if(user::checkUser($User_email, $User_mdp)){
			$_SESSION['User_email'] = $User_email;
			$_SESSION['User_mdp'] = $User_mdp;
			header("Location: index.php");
			exit;
		}
	}

	static function checkAdmin($user){
		if($user["User_statut"] == 0){
			header("Location: index.php");
			exit;
		} 
		
	}
}