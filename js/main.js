  $( function() {
    $( "#datepicker" ).datepicker({
      showWeek: true,
      firstDay: 1,
      dateFormat: "dd/mm/yy"
    });

    function generateCalendrier(){
    	$.ajax({
		  method: "POST",
		  url: "generateCalendrier.php",
		  data: { date: $("#datepicker").val() }
		}).done(function(msg) {
		  $( "#semainier" ).html( msg );
		  $( "#semainier" ).trigger("change");
		}).fail(function(jqXHR, textStatus){
			 $( "#semainier" ).html( "Request failed: " + textStatus );
		});
    }

    function generateCalendrierSalle(Salle_id){
    	$.ajax({
		  method: "POST",
		  url: "generateCalendrierSalle.php",
		  data: { date: $("#datepicker").val(), Salle_id:Salle_id  }
		}).done(function(msg) {
		  $( "#semainier" ).html( msg );
		  $( "#semainier" ).trigger("change");
		}).fail(function(jqXHR, textStatus){
			 $( "#semainier" ).html( "Request failed: " + textStatus );
		});
    }

    $("#datepicker").change(generateCalendrier);

    generateCalendrier();

	function checkFormationPicker() {
		if($("#salleEnCours").val() == ""){
			$("#formationpicker").css("display", "none");
		} else {
			$("#formationpicker").css("display", "flex");
		}
	}
	$("#salleEnCours").on("change", checkFormationPicker);
	checkFormationPicker();

	$(".salle:not(:first)").click(function(e){
		e.preventDefault();
		$(".salle").removeClass("active");
		$(this).addClass("active");
		$("#NomSalles").html(" : salle " +$(this).text());
		$("#salleEnCours").val($(this).attr("salle"));
		$("#salleEnCours").trigger("change");

		generateCalendrierSalle($(this).attr("salle"));
		
	});
	$(".salle:first").click(function(e){
		e.preventDefault();
		$(".salle").removeClass("active");
		$(this).addClass("active");
		$("#NomSalles").html("");
		$("#salleEnCours").val($(this).attr("salle"));
		$("#salleEnCours").trigger("change");

		generateCalendrier();
		
	});
	$( "#semainier" ).change(function(){
		$("#tSalle td").click(function(){
			//alert($("#formationpicker select").val());
			//
			if($("#formationpicker select").val() == "" && $(this).children().filter(".salle").css("backgroundColor") == "rgba(0, 0, 0, 0)"){
				console.log($(this).children().filter(".salle").css("backgroundColor") == "rgba(0, 0, 0, 0)");
				$("#formationpicker select").addClass("alert-danger");
				alert("Merci de choisir une formation avant de reserver la salle");
			} else {
				// Ajax on n'envoie les données nécessaire pour reserver une salle
				//salle, Formation, date, heure, user, Reservation motif
				var cel = $(this);
				var jour = cel.attr("id").split("-", 2)[0];
				var quart1 = [jour+"-h8-30", jour+"-h9-00", jour+"-h9-30", jour+"-h10-00"];
				var quart2 = [jour+"-h10-30", jour+"-h11-00", jour+"-h11-30", jour+"-h12-00"];
				var quart3 = [jour+"-h13-30", jour+"-h14-00", jour+"-h14-30"];
				var quart4 = [jour+"-h15-00", jour+"-h15-30", jour+"-h16-00"];
				$.ajax({
				  method: "POST",
				  url: "saveResa.php",
				  data: { date: $("#datepicker").val(), heure:cel.attr("id"), formation:$("#formationpicker select").val(), salle:$(".salle.active").attr("salle")  }

				}).done(function(msg) {
					console.log(msg);
					var quart;
				  	switch(true){
				  		case (quart1.indexOf(cel.attr("id")) != -1):
				  			quart = quart1;
				  			break;
				  		case (quart2.indexOf(cel.attr("id")) != -1):
				  			quart = quart2;
				  			break;
				  		case (quart3.indexOf(cel.attr("id")) != -1):
				  			quart = quart3;
				  			break;
				  		case (quart4.indexOf(cel.attr("id")) != -1):
				  			quart = quart4;
				  			break;
				  		default:
				  			quart = [cel.attr("id")];
				  			break;
				  	}
				  if(msg == "ok"){
				  	// cel.children().filter(".salle").css("backgroundColor", $(".salle.active div.couleur").css("backgroundColor")).text($("#formationpicker select option:selected").text());
				  	//console.log($("#formationpicker select option:selected").text());
				  	for (var i = 0; i < quart.length; i++) {
				  		$("#"+quart[i]+" span").css("backgroundColor", $(".salle.active div.couleur").css("backgroundColor")).text($("#formationpicker select option:selected").text());
				  	}
				  }
				  if(msg == "deleteOk"){
				  	for (var i = 0; i < quart.length; i++) {
				  		$("#"+quart[i]+" span").css("backgroundColor", "").text("");
				  	}
				  	//cel.children().filter(".salle").css("backgroundColor", "").text("");
				  	//console.log($("#formationpicker select option:selected").text());
				  }
				  if(msg == "pas admin"){
				  	alert("Vous n'êtes pas autorisé a supprimer des réservations");
				  	//console.log($("#formationpicker select option:selected").text());
				  }
				  //console.log(msg)
				  
				}).fail(function(jqXHR, textStatus){
					 alert( "Request failed: " + textStatus );
				});
			}
		});
	});

	$("#formationpicker select").change(function(){
		if($("#formationpicker select").val() == ""){
			$("#formationpicker select").addClass("alert-danger");
		} else {
			$("#formationpicker select").removeClass("alert-danger");
		} 
	});
	

	feather.replace();

	$('#salleAdd').on('show.bs.modal', function (event) {

	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var recipient = button.attr('whatever') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this);
	  var titre = "Ajouter une salle ";
	  modal.find("#Salle_couleur").val('#'+(Math.random()*0xFFFFFF<<0).toString(16));
	  modal.find("#titreModalSalle").html( titre + recipient);
	  modal.find('.modal-body #Salle_emplacement').val(recipient)
	});

	$('#insertSalle').click(function(e){
		e.preventDefault();
		var data = $("#salleAdd input");
		console.log(data);
		$.ajax({
		  method: "POST",
		  url: "addSalle.php",
		  data: data
		}).done(function(msg) {
			console.log(msg);
		  	

			if(msg == "1"){
		  		$('#salleAdd').on('hidden.bs.modal', function () {
					window.location.reload(true);
				});
				$('#salleAdd').modal('hide');
		  	} else {
		  		//console.log(msg);
		  		var erreur = JSON.parse(msg);
		  		if(erreur.nom == "vide") {
		  			$("#salleAdd #Salle_nom").addClass("inputError");
		  		}
		  		if(erreur.capacite == "vide") {
		  			$("#salleAdd #Salle_capacite").addClass("inputError");
		  		}
		  		if(erreur.couleur == "vide") {
		  			$("#salleAdd #Salle_couleur").addClass("inputError");
		  		}
		  		//console.log(erreur);
		  	}
		}).fail(function(jqXHR, textStatus){
			console.log( "Request failed: " + textStatus );
		});
	});

	$(".deleteSalle").click(function(e){
		e.preventDefault();
		//var data = [];
		if(confirm("Êtes vous sûre de vouloir le supprimer ?\nToute suppression est définitive"))
		var data = { Salle_id: $(this).attr('salle'), action:"delete"};

		$.ajax({
			  method: "POST",
			  url: "delSalle.php",
			  data: data

			}).done(function(msg) {
				if(msg == 1){
					window.location.href= "index.php?del=true";
				}
			  	//console.log(msg);		 
			}).fail(function(jqXHR, textStatus){
				alert( "Request failed: " + textStatus );
			});
	});

  } );
