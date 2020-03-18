<?php 
/**
 * 
 */
class formation
{
	static function getAllFormation()
	{
		# code...
		return database::selectAll("formation");
	}
	
	static function getFormation($id){
		return database::selectById("formation", $id);
	}
}