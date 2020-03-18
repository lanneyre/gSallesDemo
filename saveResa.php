<?php 
include("include/appTop.inc.php");

$explodeHeure = explode("-", $_POST['heure'], 2);
$heure = explode("-", substr($explodeHeure[1], 1));
$d = explode("/",$_POST["date"]);
$heure = new DateTime($d[2]."-".$d[1]."-".$d[0]." ".$heure[0].":".$heure[1].":00");

$dateTravail = substr($explodeHeure[0], 1);
// $d[0] == date selectionnée
$diff = $d[0]-$dateTravail;
$newD = new DateTime($d[2]."-".$d[1]."-".$d[0]);
if($diff <= 6 && $diff >= 0){
	$newD->modify("-".abs($diff)." day");
} else if($diff < 0 && $diff >= -6){
	$newD->modify("+".abs($diff)." day");
} else if($diff > 6){
	$diff2 = $d[0] - $diff;
	$newD->modify("+1 month");
	$newD->setDate($newD->format("Y"), $newD->format("m"), $diff2);
} else if($diff < -6){
	$diff2 = $d[0] - $diff;
	$newD->modify("-1 month");
	$newD->setDate($newD->format("Y"), $newD->format("m"), $diff2);
}

//echo $diff;

$quart1 = ["08:30:00", "09:00:00", "09:30:00", "10:00:00"];
$quart2 = ["10:30:00", "11:00:00", "11:30:00", "12:00:00"];
$quart3 = ["13:30:00", "14:00:00", "14:30:00"];
$quart4 = ["15:00:00", "15:30:00", "16:00:00"];

switch(true){
	case in_array($heure->format("H:i:s"), $quart1):
		$quart = $quart1;
		break;
	case in_array($heure->format("H:i:s"), $quart2):
		$quart = $quart2;
		break;
	case in_array($heure->format("H:i:s"), $quart3):
		$quart = $quart3;
		break;
	case in_array($heure->format("H:i:s"), $quart4):
		$quart = $quart4;
		break;
	default:
		$quart = [$heure->format("H:i:s")];
		break;
}

foreach ($quart as $horaire) {
	$AllParams[] = [":Salle_id"=> $_POST['salle'], ":Formation_id"=>$_POST['formation'], ":Reservation_date"=>$newD->format("Y-m-d"), ":Reservation_heure"=>$horaire, ":User_id"=>1, ":Reservation_motif"=>NULL, ":Reservation_creation"=>date("y-m-d G:i:s")];
}
$resultToReturn = [];
foreach ($AllParams as $Params) {
	# code...
	$result = reservation::doReservation($Params, $userInLine["User_statut"]);
	if(gettype($result) == "boolean"){
		if($result){
			$resultToReturn[] = "ok";
		} else {
			$resultToReturn[] = "ko";
		}
	} else {
		$resultToReturn[] = $result;
	}
}
$return = "ok";
foreach ($resultToReturn as $result) {
	if($result != "ok" && $result != "ko"){
		$return = $result;
		break(1);
	} else if($result == "ko"){
		$return = $result;
		break(1);
	}
}
echo $return;
//$Params = [":Salle_id"=> $_POST['salle'], ":Formation_id"=>$_POST['formation'], ":Reservation_date"=>$newD->format("Y-m-d"), ":Reservation_heure"=>$heure->format("H:i:s"), ":User_id"=>1, ":Reservation_motif"=>NULL, ":Reservation_creation"=>date("y-m-d G:i:s")];
//print_r($Params);//

//$result = reservation::doReservation($Params, $userInLine["User_statut"]);
//var_dump($result);
// if(gettype($result) == "boolean"){
// 	if($result){
// 		echo "ok";
// 	} else {
// 		echo "ko";
// 	}
// } else {
// 	echo $result;
// }
