<?php 
/**
 * 
 */
class user
{
	static function getAlluser()
	{
		# code...
		return database::selectAll("user");
	}
	

	static function getUser($id){
		return database::selectById("user", $id);
	}

	static function insertUser($Params){
		$p = [];
		foreach ($Params as $key => $value) {
			# code...
			$p[":".$key] = $value;
		}
		//print_r($Params);
		return database::insert("user", $p);
	}

	static function updateUser($Params){
		$p = [];
		foreach ($Params as $key => $value) {
			# code...
			$p[":".$key] = $value;
		}
		return database::update("user", $p);
	}

	static function checkParams($data, $mdp = true){
		$error = [];
		if(empty($data["User_nom"])){
			$error["nom"] = "vide";
		}
		if(empty($data["User_prenom"])){
			$error["prenom"] = "vide";
		}
		if(empty($data["User_email"])){
			$error["email"] = "vide";
		}
		if(empty($data["User_mdp"]) && $mdp){
			$error["mdp"] = "vide";
		}
		if(!$mdp && !empty($data["User_mdp2"]) && !empty($data["User_mdp"]) && $data["User_mdp"] != $data["User_mdp2"]){
			$error["newmdp"] = "different";
		}
		if(!$mdp && empty($data["User_mdp2"]) && !empty($data["User_mdp"])){
			$error["newmdp"] = "no mdp2";
		}
		if(!$mdp && !empty($data["User_mdp2"]) && empty($data["User_mdp"])){
			$error["newmdp"] = "no mdp";
		}
		if (!filter_var($data["User_email"], FILTER_VALIDATE_EMAIL)) {
		    $error["emailFormat"] = "Mal formation";
		} 

		if(sizeof($error) > 0){
			return $error;
		} else {
			return true;
		}
	}

	static function deleteUser($data){
		$error = [];
		if(empty($data["User_id"])){
			$error["id"] = "vide";
		}
		$p = [];
		foreach ($data as $key => $value) {
			# code...
			$p[":".$key] = $value;
		}
		return database::delete("user", $p);
	}

	static function checkUser($User_email, $User_mdp){

		$dataUser = database::selectUser($User_email);
		// print_r($dataUser);
		if(password_verify($User_mdp, $dataUser['User_mdp'])){
			return true;
		} else {
			return false;
		}
	}
}