<!-- sidebar -->
<input type="hidden" id="salleEnCours" value="">
  <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column" id="side-menu">
            <li class="nav-item">
                <a class="salle nav-link d-flex align-items-center justify-content-between active" salle="" href="#">Vue globale
                </a>
            </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Salles</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new salle" data-toggle="modal" data-target="#salleAdd" whatever="Numerique">
              <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column" id="side-menu">
            <?php 
            foreach(salle::getSalleByType() as $salleNum) {
            ?>
            <li class="nav-item d-flex justify-content-between align-items-center">
                <a class="salle nav-link d-flex align-items-center justify-content-between" salle="<?php echo $salleNum['Salle_id']; ?>" href="#">
                  <?php echo $salleNum['Salle_nom']; ?>
                  <div class="couleur" style="background-color: <?php echo $salleNum['Salle_couleur']; ?>;"></div>
                </a>
                <?php if($userInLine["User_statut"] == 1) { ?>
                <a class="d-flex align-items-center text-muted deleteSalle" href="#" salle="<?php echo $salleNum['Salle_id']; ?>">
                  <span data-feather="trash-2"></span>
                </a>
              <?php } ?>
            </li>
          <?php } ?>
        </ul>
       <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Autres</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new salle autre" data-toggle="modal" data-target="#salleAdd" whatever="Autre">
              <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column" id="side-menu">
            <?php 
            foreach(salle::getSalleByType("Autre") as $salleNum) {
            ?>
            <li class="nav-item d-flex justify-content-between align-items-center">
                <a class="salle nav-link d-flex align-items-center justify-content-between"<?php echo $salleNum['Salle_id']; ?> href="#" salle="<?php echo $salleNum['Salle_id']; ?>">
                  <?php echo $salleNum['Salle_nom']; ?>
                  <div class="couleur" style="background-color: <?php echo $salleNum['Salle_couleur']; ?>;"></div>
                </a>
                <?php if($userInLine["User_statut"] == 1) { ?>
                <a class="d-flex align-items-center text-muted deleteSalle" href="#" salle="<?php echo $salleNum['Salle_id']; ?>">
                  <span data-feather="trash-2"></span>
                </a>
              <?php } ?>
            </li>
          <?php } ?>
        </ul>
  </div>
</nav>

<?php if($userInLine["User_statut"] == 1) { ?>
        <div class="modal fade" id="salleAdd" tabindex="-1" role="dialog" aria-labelledby="titreModalSalle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form name="AddSalle" method="POST" action="#">
                <div class="modal-header">
                  <h4 class="modal-title" id="titreModalSalle">Ajouter une Salle </h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <label for="Salle_nom">Salle</label>
                    <input type="text" name="Salle_nom" id="Salle_nom" placeholder="Nom" class="form-control">
                    <label for="Salle_capacite">Capacité</label>
                    <input type="number" name="Salle_capacite" id="Salle_capacite" placeholder="Salle_couleur" class="form-control">
                    <label for="Salle_couleur">Couleur de salle</label>
                    <input type="color" name="Salle_couleur" id="Salle_couleur" placeholder="Email" class="form-control">
                    <input type="hidden" name="Salle_emplacement" id="Salle_emplacement" value="">
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="action" value="insert">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary" id="insertSalle">Save data</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>