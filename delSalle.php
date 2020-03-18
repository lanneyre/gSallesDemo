<?php 
include("include/appTop.inc.php");
$action = array_pop($_POST);
$data = $_POST;
echo salle::deleteSalle($data);