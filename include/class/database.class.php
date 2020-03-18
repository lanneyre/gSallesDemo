<?php 
/**
 * 
 */
class database
{
	private static $_host = "localhost";
	private static $_user = "root"; //id12806562_gestionnairesallesics
	private static $_mdp = "";//tXJ8DcItu6aACULc!OIz
	private static $_bdd = "gestionnairesalles"; //id12806562_gestionnairesalles

	public static $_conn;

	public static function createConnexion(){
		self::$_conn = new pdo("mysql:host=".self::$_host.";dbname=".self::$_bdd.";charset=UTF8", self::$_user, self::$_mdp);
	}

	public static function selectAll($table, $comportement = PDO::FETCH_ASSOC){
		$sql = "SELECT * FROM `$table`";
		$req = self::$_conn->query($sql);
		if($comportement == PDO::FETCH_CLASS){
			$req->setFetchMode(PDO::FETCH_CLASS, $table);
			return $req->fetchAll();
		}
		return $req->fetchAll($comportement);
	}

	public static function selectById($table, $id, $comportement = PDO::FETCH_ASSOC){
		$sql = "SELECT * FROM `$table` WHERE `".Ucfirst($table)."_id` = ? LIMIT 1;";
		$req = self::$_conn->prepare($sql);
		$req->execute([$id]);
		if($comportement == PDO::FETCH_CLASS){
			$req->setFetchMode(PDO::FETCH_CLASS, $table);
			return $req->fetch();
		}
		return $req->fetch($comportement);
	}

	public static function selectByType( $type, $comportement = PDO::FETCH_ASSOC){
		$sql = "SELECT * FROM `salle` WHERE `Salle_emplacement` = ?";
		$req = self::$_conn->prepare($sql);
		$req->execute([$type]);
		if($comportement == PDO::FETCH_CLASS){
			$req->setFetchMode(PDO::FETCH_CLASS, $table);
			return $req->fetchAll();
		}
		return $req->fetchAll($comportement);
	}

	public static function selectUser($User_email, $comportement = PDO::FETCH_ASSOC){
		$sql = "SELECT * FROM `user` WHERE `User_email` = :User_email LIMIT 1;";
		$req = self::$_conn->prepare($sql);
		$req->execute([":User_email" => $User_email]);
		
		if($comportement == PDO::FETCH_CLASS){
			$req->setFetchMode(PDO::FETCH_CLASS, 'user');
			return $req->fetch();
		} 
		return $req->fetch($comportement);

	}

	public static function selectResaByDate($dates, $comportement = PDO::FETCH_ASSOC){
		$resa = [];
		foreach ($dates as $date) {
			# code...
			$resa[] = " `Reservation_date` = ".self::$_conn->quote($date)." ";
		}
		$sql = "SELECT * FROM `reservation` WHERE ". implode(" OR ", $resa);
		$req = self::$_conn->query($sql);
		if($comportement == PDO::FETCH_CLASS){
			$req->setFetchMode(PDO::FETCH_CLASS, $table);
			return $req->fetchAll();
		}
		return $req->fetchAll($comportement);
	}

	public static function checkResa($Params){
		$paramTOCheck = [":Salle_id", ":Reservation_date", ":Reservation_heure"];
		$sql = "SELECT * from `reservation` WHERE `Salle_id` = :Salle_id AND `Reservation_date` = :Reservation_date AND `Reservation_heure` = :Reservation_heure";
		$req = self::$_conn->prepare($sql);
		foreach ($paramTOCheck as $champ) {
			# code...
			$req->bindValue($champ, $Params[$champ]);
		}
		$req->execute();
		//echo $req->rowCount();
		if($req->rowCount() == 1)
			return false;
		else 
			return true;
	}
	public static function deleteResa($Params){
		$paramTOCheck = [":Salle_id", ":Reservation_date", ":Reservation_heure"];
		//print_r($Params);
		$sql = "SELECT * from `reservation` WHERE `Salle_id` = :Salle_id AND `Reservation_date` = :Reservation_date AND `Reservation_heure` = :Reservation_heure";
		$req = self::$_conn->prepare($sql);
		foreach ($paramTOCheck as $champ) {
			# code...
			$req->bindValue($champ, $Params[$champ]);
		}
		$req->execute();
		if($req->rowCount() == 1){
			$data = $req->fetch();
			//return ($data);
			if(self::delete("reservation", [":Reservation_id" => $data['Reservation_id']]))
				return "deleteOk";
			else 
				return false;
		}
		else 
			return true;
	}

	public static function selectResaByDateAndSalle($dates, $id, $comportement = PDO::FETCH_ASSOC){
		$resa = [];
		foreach ($dates as $date) {
			# code...
			$resa[] = " `Reservation_date` = ".self::$_conn->quote($date)." ";
		}
		$sql = "SELECT * FROM `reservation` WHERE `Salle_id` = ? AND (". implode(" OR ", $resa).")";
		$req = self::$_conn->prepare($sql);
		$req->execute([$id]);
		if($comportement == PDO::FETCH_CLASS){
			$req->setFetchMode(PDO::FETCH_CLASS, $table);
			return $req->fetchAll();
		}
		return $req->fetchAll($comportement);
	}

	public static function makeResa($Params){
		$sql = 'INSERT INTO `reservation` (`Reservation_id`, `Salle_id`, `Formation_id`, `Reservation_date`, `Reservation_heure`, `User_id`, `Reservation_motif`, `Reservation_creation`, `Reservation_update`) VALUES (NULL, :Salle_id, :Formation_id, :Reservation_date, :Reservation_heure, :User_id, :Reservation_motif, :Reservation_creation, NULL)';
		$req = self::$_conn->prepare($sql);
		foreach ($Params as $champ => $valeur) {
			# code...
			$req->bindValue($champ, $valeur);
		}
		return $req->execute();
	}

	public static function insert($table, $Params){
		//print_r($Params);
		switch ($table) {
			case 'reservation':
				# code...
				$sql = 'INSERT INTO `reservation` (`Reservation_id`, `Salle_id`, `Formation_id`, `Reservation_date`, `Reservation_heure`, `User_id`, `Reservation_motif`, `Reservation_creation`, `Reservation_update`) VALUES (NULL, :Salle_id, :Formation_id, :Reservation_date, :Reservation_heure, :User_id, :Reservation_motif, :Reservation_creation, NULL)';
				break;
			case 'user':
				$sql = 'INSERT INTO `user` (`User_id`, `User_nom`, `User_prenom`, `User_email`, `User_mdp`, `User_statut`) VALUES (NULL, :User_nom, :User_prenom, :User_email, :User_mdp, :User_statut)';
				$Params[":User_mdp"] = password_hash($Params[":User_mdp"], PASSWORD_DEFAULT);
				break;
			case 'salle':
				$sql = 'INSERT INTO `salle` (`Salle_id`, `Salle_nom`, `Salle_capacite`, `Salle_couleur`, `Salle_emplacement`) VALUES (NULL, :Salle_nom, :Salle_capacite, :Salle_couleur, :Salle_emplacement)';
				break;
			default:
				# code...
				break;
		}
		$req = self::$_conn->prepare($sql);
		//print_r($Params);
		foreach ($Params as $champ => $valeur) {
			# code...
			$req->bindValue($champ, $valeur);
		}
		return $req->execute();

	}

	public static function update($table, $Params){
		switch ($table) {
			case 'reservation':
				# code...
				$sql = 'INSERT INTO `reservation` (`Reservation_id`, `Salle_id`, `Formation_id`, `Reservation_date`, `Reservation_heure`, `User_id`, `Reservation_motif`, `Reservation_creation`, `Reservation_update`) VALUES (NULL, :Salle_id, :Formation_id, :Reservation_date, :Reservation_heure, :User_id, :Reservation_motif, :Reservation_creation, NULL)';
				break;
			case 'user':
				//var_dump($Params);
				if(!empty($Params[':User_mdp']) && !empty($Params[':User_mdp2']) && $Params[':User_mdp'] == $Params[':User_mdp2']){
					$sql = "UPDATE `user` SET `User_nom` = :User_nom, `User_prenom` = :User_prenom, `User_email` = :User_email, `User_statut` = :User_statut, `User_mdp` = :User_mdp WHERE `user`.`User_id` = :User_id ";
					$p = [":User_nom", ":User_prenom", ":User_email", ":User_statut", ":User_id", ":User_mdp"];
					$Params[":User_mdp"] = password_hash($Params[":User_mdp"], PASSWORD_DEFAULT);
					//echo "test";
				} else {
					$sql = "UPDATE `user` SET `User_nom` = :User_nom, `User_prenom` = :User_prenom, `User_email` = :User_email, `User_statut` = :User_statut WHERE `user`.`User_id` = :User_id ";
					$p = [":User_nom", ":User_prenom", ":User_email", ":User_statut", ":User_id"];
				}
				
			default:
				# code...
				break;
		}
		
		$req = self::$_conn->prepare($sql);
		foreach ($p as $champ) {
			# code...
			$req->bindValue($champ, $Params[$champ]);
		}
		return $req->execute();

	}

	public static function delete($table, $Params){
		$sql = 'DELETE FROM `'.$table.'` WHERE `'.Ucfirst($table).'_id` = :'.Ucfirst($table).'_id LIMIT 1';
		$req = self::$_conn->prepare($sql);
		foreach ($Params as $champ => $valeur) {
			# code...
			$req->bindValue($champ, $valeur);
		}
		return $req->execute();

	}
}