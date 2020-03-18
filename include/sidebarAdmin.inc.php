<!-- sidebar -->
<input type="hidden" id="salleEnCours" value="">
  <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
    <div class="sidebar-sticky">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Administration</span>
        </h6>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Utilisateurs</span>
        </h6>
        <ul class="nav flex-column" id="side-menu">
            <li class="nav-item">
                <a class="salle nav-link d-flex align-items-center justify-content-between" href="#">
                  Liste des utilisateurs
                </a>
            </li>
        </ul>
       <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Autres</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new salle autre">
              <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column" id="side-menu">
            <?php 
            foreach(salle::getSalleByType("Autre") as $salleNum) {
            ?>
            <li class="nav-item">
                <a class="salle nav-link d-flex align-items-center justify-content-between"<?php echo $salleNum['Salle_id']; ?> href="#">
                  <?php echo $salleNum['Salle_nom']; ?>
                  <div class="couleur" style="background-color: <?php echo $salleNum['Salle_couleur']; ?>;"></div>
                </a>
            </li>
          <?php } ?>
        </ul>
  </div>
</nav>