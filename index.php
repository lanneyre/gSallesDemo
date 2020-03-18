<?php 
	include("include/appTop.inc.php");
?>
<!doctype html>
<html>
    <head>
    	<?php include("include/meta.inc.php"); ?>
        <title>Gestionnaire de salle</title>
    </head>
    <body>
        <main id="wrapper">
        	<?php include("include/nav.inc.php"); ?>
        	<div class="container-fluid">
        		<div class="row">
        			<?php include("include/sidebar.inc.php"); ?>
                    
                    <?php if(!empty($_GET['del'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertSuppress">
                      Suppression réussie
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <?php } ?>
					<?php include("include/main.inc.php"); ?>        			
        		</div>
        	</div>
        </main>
    </body>
</html>