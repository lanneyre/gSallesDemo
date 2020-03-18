<?php 
include("include/appTop.inc.php");

$action = array_pop($_POST);
$data = $_POST;

$cp = salle::checkParams($data);
//print_r(($cp));
if($cp === true){
	print_r(salle::insertSalle($data)) ;
	//echo "ok";
} else {
	print_r(json_encode($cp));
}