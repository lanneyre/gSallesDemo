<!-- Image and text -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark justify-content-end">
  <a class="navbar-brand" href="/"><img src="img/Logo-ICS-CCI-blanc.png" alt="Logo ICS CCI"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop" aria-controls="navbarTop" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse flew-grow-0" id="navbarTop">
    <ul class="navbar-nav text-right ml-auto mr-1">
      <li class="nav-item nav-link text-white">
        Bonjour <?php echo $userInLine['User_prenom'] ?>
      </li>
      <?php if($userInLine['User_statut'] == 1) { ?>
      <li class="nav-item active">
        <a class="nav-link" href="users.php">Administration <span class="sr-only">Admin</span></a>
      </li>
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link" href="deco.php">Deconnexion</a>
      </li>
    </ul>
  </div>


</nav>

