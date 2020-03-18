<?php 
/**
 * 
 */
class reservation
{
	static function getAllReservation()
	{
		# code...
		return database::selectAll("reservation");
	}
	
	static function getReservationsByDate($dates){
		return database::selectResaByDate($dates);
	}

	static function getReservationsByDateFormat($dates, $id=null){
		if(empty($id)){
			$allDate = database::selectResaByDate($dates);	
		} else {
			$allDate = database::selectResaByDateAndSalle($dates, $id);
		}
		
		//$id = "j".$days[$j-1]."-h".$i."-00";
		//$return = [];
		for ($i=0; $i < sizeof($allDate) ; $i++) { 
			# code...
			$day = explode("-", $allDate[$i]["Reservation_date"])[2];
			$allDate[$i]["id"] = "j".(($day <10) ? substr($day, 1):$day)."-h".str_replace(":", "-", (substr(substr($allDate[$i]["Reservation_heure"],0, -3),0,1) == "0" ? substr(substr($allDate[$i]["Reservation_heure"],0, -3),1) : substr($allDate[$i]["Reservation_heure"],0, -3)));
		}
		return $allDate;
	}

	static function doReservation($Params, $admin){
		if(database::checkResa($Params)){
			//echo "insert";
			return database::insert("reservation", $Params);
		} else {
			//return ($userInLine);
			if($admin == 1){
				return database::deleteResa($Params);
			} else {
				return "pas admin";
			}
			
			//return false;
		}
		
	}
}