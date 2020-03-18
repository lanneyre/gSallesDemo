<?php include("include/appTop.inc.php"); 

$d = explode("/", $_POST['date']);

try {
    $date = new DateTime($d[2].'-'.$d[1].'-'.$d[0]);
} catch (Exception $e) {
    echo $e->getMessage();
    exit(1);
}
$weekDay = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
$day = [];
$date->modify("-".($date->format('N')-1)." day");
$searchDays = [];
for ($i=0; $i < sizeof($weekDay); $i++) { 
	# code...
	$day[$weekDay[$i]] = $date->format('d/m/Y');
	$days[] = $date->format('d');
	$searchDays[] = $date->format('Y-m-d');
	$date->modify("+1 day");
}
//print_r($day);

$resa = reservation::getReservationsByDateFormat($searchDays, $_POST['Salle_id']);
//print_r($resa);
?>

<table class="table table-striped" id="tSalle">
				<thead class="thead-dark">
					<tr>
						<th></th>
						<?php 	foreach ($day as $key => $value) {
							# code...
							echo "<th>".$key."<br>".$value."</th>";
						}  ?>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php 
						
						//echo sizeof($salles);
						for ($i=7; $i < 20; $i++) { ?>
					<tr>
						<?php for ($j=0; $j < 9 ; $j++) { ?>
							<?php if($j == 0 || $j == 8){ echo "<td class='heure'>".$i.":00</td>"; } else { 
								$x = ($days[$j-1] < 10) ? substr($days[$j-1], 1):$days[$j-1];
								$id = "j".$x."-h".$i."-00";
								?>
							<td id="<?php echo $id; ?>">
								<?php 

								echo generateCelluleSalle($id, $resa, $_POST['Salle_id']); ?>
							</td>
							<?php } ?>
							<?php } ?>
					</tr>
					<tr>
						<?php for ($j=0; $j < 9 ; $j++) { ?>
							<?php if($j == 0 || $j == 8){ echo "<td class='heure'>".$i.":30</td>"; } else { 
								$x = ($days[$j-1] < 10) ? substr($days[$j-1], 1):$days[$j-1];
								$id = "j".$x."-h".$i."-30";?>
							<td id="<?php echo $id; ?>">
								<?php echo generateCelluleSalle($id, $resa, $_POST['Salle_id']); ?>
							</td>
							<?php } ?>
							<?php } ?>
					</tr>
							<?php } ?>
				</tbody>
			</table>