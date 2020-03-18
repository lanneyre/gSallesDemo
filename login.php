<?php 
	include("include/appTop.inc.php");

    if(!empty($_POST['User_email']) && !empty($_POST['User_mdp'])){
        if(!empty($_POST['remember'])){
            setcookie("user[User_email]", $_POST['User_email']);
            setcookie("user[User_mdp]", $_POST['User_mdp']);
        }
        secure::validateForm($_POST['User_email'], $_POST['User_mdp']);
    }
    
?>
<!doctype html>
<html>
    <head>
    	<?php include("include/meta.inc.php"); ?>
        <title>Gestionnaire de salle</title>
    </head>
    <body>
        <main id="wrapper">
        	<?php include("include/navLogin.inc.php"); ?>
        	<div class="container-fluid">
        		<div class="row">
        			<?php //include("include/sidebarAdmin.inc.php"); ?>

					<?php include("include/login.inc.php"); ?>        			
        		</div>
        	</div>
        </main>
    </body>
</html>