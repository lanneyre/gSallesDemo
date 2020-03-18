<?php 
/**
 * 
 */
class salle
{
	static function getAllsalle()
	{
		# code...
		return database::selectAll("salle");
	}
	
	static function getSalleByType($type = "Numerique"){
		return database::selectByType($type);
	}

	static function getSalle($id){
		return database::selectById("salle", $id);
	}

	static function insertSalle($Params){
		$p = [];
		foreach ($Params as $key => $value) {
			# code...
			$p[":".$key] = $value;
		}
		return database::insert("salle", $p);
	}

	static function checkParams($data){
		$error = [];
		if(empty($data["Salle_nom"])){
			$error["nom"] = "vide";
		}
		if(empty($data["Salle_capacite"])){
			$error["capacite"] = "vide";
		}
		if(empty($data["Salle_couleur"]) ){
			$error["couleur"] = "vide";
		}
		if(empty($data["Salle_emplacement"])){
			$error["emplacement"] = "vide";
		}
		
		if(sizeof($error) > 0){
			return $error;
		} else {
			return true;
		}
	}

	static function deleteSalle($data){
		$error = [];
		if(empty($data["Salle_id"])){
			$error["id"] = "vide";
		}
		$p = [];
		foreach ($data as $key => $value) {
			# code...
			$p[":".$key] = $value;
		}
		return database::delete("salle", $p);
	}
}