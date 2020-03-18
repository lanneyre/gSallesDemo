<section role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Gestionnaire de salles <span id="NomSalles"></span></h1>
	</div>

	<form action="#" id="AffichageSalles" class="AffichagesSalles" method="POST">
		<div class="inputCalendrier">
			<div class="input-group mb-3 col-md-4">
			  <input type="text" name="date" id="datepicker" value="<?php echo date("d/m/Y");?>" class="form-control" aria-describedby="calendar">
			  <div class="input-group-prepend">
			    <span class="input-group-text  ui-state-default" ><span class="ui-icon ui-icon-note"></span></span>
			  </div>
			</div>
			
			<div class="input-group mb-3 col-md-4" id="formationpicker">
			  <select name="formation" class="custom-select">
			  	<option value="" selected="">-- Choisir une formation --</option>
			  	<?php foreach (formation::getAllFormation() as $formation) {
			  		# code...
			  		echo '<option value="'.$formation['Formation_id'].'">'.$formation['Formation_nomCourt'].'</option>';
			  	} ?>
			  </select>

			  <div class="input-group-prepend">
			    <label class="input-group-text ui-state-default" aria-describedby="formationpicker" ><span class="ui-icon ui-icon-key"></span></label>
			  </div>
			</div>
		</div>
		

		<section id="semainier">
			
		</section>
	</form>
</section>