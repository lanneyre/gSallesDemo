$(function(){
	$('#usersTable').DataTable();

	$("#insertUser").click(function(e){
		e.preventDefault();
		var data = $("#ModalAdd input, #ModalAdd select");
		$.ajax({
			  method: "POST",
			  url: "insertUser.php",
			  data: data

			}).done(function(msg) {
			  	if(msg == "1"){
			  		$('#ModalAdd').on('hidden.bs.modal', function () {
						window.location.reload(true);
					});
					$('#ModalAdd').modal('hide');
			  	} else {
			  		console.log(msg);
			  		var erreur = JSON.parse(msg);
			  		if(erreur.nom == "vide") {
			  			$("#User_nom").addClass("inputError");
			  		}
			  		if(erreur.prenom == "vide") {
			  			$("#User_prenom").addClass("inputError");
			  		}
			  		if(erreur.email == "vide") {
			  			$("#User_email").addClass("inputError");
			  		}
			  		if(erreur.mdp == "vide") {
			  			$("#User_mdp").addClass("inputError");
			  		}
			  		if(erreur.emailFormat == "mal formation") {
			  			$("#User_email").addClass("inputError");
			  		}
			  		//console.log(erreur);
			  	}
			  
			 
			}).fail(function(jqXHR, textStatus){
				 alert( "Request failed: " + textStatus );
			});
	});

	$(".delete").click(function(e){
		e.preventDefault();
		//var data = [];
		if(confirm("Êtes vous sûre de vouloir le supprimer ?\nToute suppression est définitive"))
		var data = { User_id: $(this).attr('user'), action:"delete"};

		$.ajax({
			  method: "POST",
			  url: "insertUser.php",
			  data: data

			}).done(function(msg) {
				if(msg == 1){
					window.location.href= "users.php?del=true";
				}
			  	//console.log(msg);		 
			}).fail(function(jqXHR, textStatus){
				alert( "Request failed: " + textStatus );
			});
	});

	$(".editButton").click(function(e){
		e.preventDefault();
		var id = $(this).parent().children().filter("#User_id").val();

		var data = $("#ModalEdit"+id+" input, #ModalEdit"+id+" select")
		$.ajax({
			  method: "POST",
			  url: "insertUser.php",
			  data: data

			}).done(function(msg) {
			  	if(msg == "1"){
			  		$("#ModalEdit"+id).on('hidden.bs.modal', function () {
						window.location.reload(true);
					});
					$("#ModalEdit"+id).modal('hide');
			  	} else {
			  		//console.log(msg);
			  		var erreur = JSON.parse(msg);
			  		if(erreur.nom == "vide") {
			  			$("#ModalEdit"+id + " #User_nom").addClass("inputError");
			  		}
			  		if(erreur.prenom == "vide") {
			  			$("#ModalEdit"+id + " #User_prenom").addClass("inputError");
			  		}
			  		if(erreur.email == "vide") {
			  			$("#ModalEdit"+id + " #User_email").addClass("inputError");
			  		}
			  		if(erreur.mdp == "vide") {
			  			$("#ModalEdit"+id + " #User_mdp").addClass("inputError");
			  		}
			  		if(erreur.emailFormat == "mal formation") {
			  			$("#ModalEdit"+id + " #User_email").addClass("inputError");
			  		}
			  		//console.log(erreur);
			  	}			 
			}).fail(function(jqXHR, textStatus){
				 alert( "Request failed: " + textStatus );
			});

	});
});