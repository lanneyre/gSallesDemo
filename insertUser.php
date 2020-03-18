<?php include("include/appTop.inc.php");
$action = array_pop($_POST);
$data = $_POST;
 switch($action){
 	case "insert":
 		$cp = user::checkParams($data);
 		//print_r(($cp));
 		if($cp === true){
 			print_r(user::insertUser($data)) ;
 			//echo "ok";
 		} else {
 			print_r(json_encode($cp));
 		}
 		break;
 	case "delete":
 		echo user::deleteUser($data);
 		break;
 	case "edit" :
 		$cp = user::checkParams($data, false);
 		//print_r($data);
 		if($cp === true){
 			print_r(user::updateUser($data)) ;
 		} else {
 			print_r(json_encode($cp));
 		}
 		//echo "hourra";
 		break;
 	default:
 		echo "erreur d'action";
 		break;
 }