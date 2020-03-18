<section role="main" class="col-12 ml-sm-auto px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Gestionnaire d'utilisateurs<button class="btn btn-outline-info addButton float-right" data-toggle="modal" data-target="#ModalAdd" id="addButton"><i class="far fa-plus-square"></i></button></h1>

		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		    	<form name="AddUser" method="POST" action="#">
			      <div class="modal-header">
			        <h4 class="modal-title" id="exampleModalLabel">Ajouter un utilisateur</h4>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			      		<label for="User_nom">Nom</label>
			      		<input type="text" name="User_nom" id="User_nom" placeholder="Nom" class="form-control">
			      		<label for="User_prenom">Prénom</label>
			      		<input type="text" name="User_prenom" id="User_prenom" placeholder="Prenom" class="form-control">
			      		<label for="User_email">Email</label>
			      		<input type="Email" name="User_email" id="User_email" placeholder="Email" class="form-control">
			      		<label for="User_mdp">Mdp</label>
			      		<input type="password" name="User_mdp" id="User_mdp" placeholder="Mot de passe" class="form-control">
			      		<label for="User_statut">Statut</label>
			      		<select name="User_statut" id="User_statut" class="form-control">
			      			<option value="0" selected="">User</option>
			      			<option value="1">Admin</option>
			      		</select>
			      </div>
			      <div class="modal-footer">
			      	<input type="hidden" name="action" value="insert">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button class="btn btn-primary" id="insertUser">Save data</button>
			      </div>
		      </form>
		    </div>
		  </div>
		</div>

	</div>
	
	<?php if(!empty($_GET['del'])) { ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertSuppress">
	  Suppression réussie
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<?php } ?>
	
	<table class="table table-striped table-hover" id="usersTable">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Email</th>
				<th>Statut</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Id</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Email</th>
				<th>Statut</th>
				<th></th>
				<th></th>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach(user::getAlluser() as $user) { ?>
			<tr>
				<td><?php echo $user['User_id']; ?></td>
				<td><?php echo $user['User_nom']; ?></td>
				<td><?php echo $user['User_prenom']; ?></td>
				<td><?php echo $user['User_email']; ?></td>
				<td><?php echo ($user['User_statut']==1)?"Admin":"User"; ?></td>
				<td>
					<button class="btn btn-outline-warning btn-block" data-toggle="modal" data-target="#ModalEdit<?php echo $user['User_id']; ?>"><i class="far fa-edit"></i></button>

					<div class="modal fade" id="ModalEdit<?php echo $user['User_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					    	<form name="EditUser" method="POST" action="#">
						      <div class="modal-header">
						        <h4 class="modal-title" id="exampleModalLabel">Editer un utilisateur</h4>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						      		<label for="User_nom">Nom</label>
						      		<input type="text" name="User_nom" id="User_nom" placeholder="Nom" class="form-control" value="<?php echo $user['User_nom']; ?>">
						      		<label for="User_prenom">Prénom</label>
						      		<input type="text" name="User_prenom" id="User_prenom" placeholder="Prenom" class="form-control" value="<?php echo $user['User_prenom']; ?>">
						      		<label for="User_email">Email</label>
						      		<input type="Email" name="User_email" id="User_email" placeholder="Email" class="form-control" value="<?php echo $user['User_email']; ?>">
						      		<label for="User_mdp">Mdp</label>
						      		<input type="password" name="User_mdp" id="User_mdp" placeholder="Mot de passe" class="form-control" value="">
						      		<label for="User_mdp">Retapez votre Mdp</label>
						      		<input type="password" name="User_mdp2" id="User_mdp2" placeholder="Mot de passe" class="form-control" value="">
						      		<label for="User_statut">Statut</label>
						      		<select name="User_statut" id="User_statut" class="form-control">
						      			<option value="0" <?php if( $user['User_statut'] == 0) echo 'selected="selected"'; ?>>User</option>
						      			<option value="1" <?php if( $user['User_statut'] == 1) echo 'selected="selected"'; ?>>Admin</option>
						      		</select>
						      </div>
						      <div class="modal-footer">
						      	<input type="hidden" name="User_id" id="User_id" value="<?php echo $user['User_id']; ?>">
						      	<input type="hidden" name="action" value="edit">
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						        <button class="btn btn-primary editButton" id="editUser<?php echo $user['User_id']; ?>">Save data</button>
						      </div>
					      </form>
					    </div>
					  </div>
					</div>
				</td>
				<td>
					<?php if($userInLine['User_id'] == $user['User_id']) {
						$dis = 'disabled="disabled"';
					} else {
						$dis = '';
					} ?>
					<button class="btn btn-outline-danger btn-block delete" user="<?php echo $user['User_id']; ?>" id="delete_<?php echo $user['User_id']; ?>" <?php echo $dis; ?>><i class="far fa-trash-alt"></i></button>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

</section>