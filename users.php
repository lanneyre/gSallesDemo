<?php 
	include("include/appTop.inc.php");

	secure::checkAdmin($userInLine);
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
        			<?php //include("include/sidebarAdmin.inc.php"); ?>

					<?php include("include/users.inc.php"); ?>        			
        		</div>
        	</div>
        </main>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>
        <script type="text/javascript" src="js/admin.js"></script>
    </body>
</html>