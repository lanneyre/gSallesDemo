<?php 
	

	require_once 'include/Autoloader.php';
	Autoloader::register();

	session_start();

	database::createConnexion();

	secure::redirect();

	if(isset($_SESSION['User_email'])) {
		$userInLine = database::selectUser($_SESSION['User_email']);
	}

	function inArray($id, $array, $Salle_id){
		$return = [];
		foreach ($array as $compare) {
			# code...
			if(in_array($id, $compare)){
				$return[] = $compare;
			}
		}

		foreach ($return as $r) {
			# code...
			if($r['Salle_id'] == $Salle_id){
				return $r;
			}
		}

		return false;
	}

	function generateCellule($id, $resa){
		$salles = salle::getAllsalle();
		
		$return = "";
		for ($s=1; $s <= sizeof($salles); $s++) { 
			$cel = inArray($id, $resa, $s);
			# code...
			$style = "width: ".floor(100/sizeof($salles))."% !important; ";
			if( $cel['Salle_id'] == $s){
				$salle = salle::getSalle($cel['Salle_id']);
				$style .= "background-color: ".$salle["Salle_couleur"];
			} else {
				$style .= "";
			}
			$return .= '<span class="salle'.$salles[$s-1]['Salle_id'].'" style="'.$style.'">&nbsp;</span>'; 	
		}
		return $return;
	}

	function generateCelluleSalle($id, $resa, $Salle_id){
		//$salles = salle::getAllsalle();
		$salle = salle::getSalle($Salle_id);
		$cel = inArray($id, $resa, $Salle_id);
		$return = "";

		$style = "";

		if( $cel['Salle_id'] == $Salle_id){		
			$style .= "background-color: ".$salle["Salle_couleur"];
			$formation = formation::getFormation($cel['Formation_id']);
			$text = $formation['Formation_nomCourt'];
		} else {
			$style .= "";
			$text = "&nbsp";
		}

		$return .= '<span class="salle" style="'.$style.'">'.$text.'</span>';
		return $return;
	}