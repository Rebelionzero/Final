$(document).ready(function(){
	
	$(".close").on("click",function(){		
		$("div.mensaje_error").parent().children("div.mensaje_error").remove();
	});

	/************************************************************************************/
	/*********************************** Obras ******************************************/
	/************************************************************************************/

	/*
	// Tabs
	*/

	$(".tab-cargar").on("click",function(){

		if( !($(this).hasClass("focused-tab") ) ){
			$(this).addClass("focused-tab");
		}

		if($(".tab-lista").hasClass("focused-tab") ){
			$(".tab-lista").removeClass("focused-tab");
		}

		if( $("div.cargar").hasClass("none") ){

			$("div.lista").removeClass("block");
			$("div.lista").addClass("none");
			
			$("div.cargar").removeClass("none");
			$("div.cargar").addClass("block");
			
		}

	});	

	$(".tab-lista").on("click",function(){

		if( !($(this).hasClass("focused-tab") ) ){
			$(this).addClass("focused-tab");
		}

		if($(".tab-cargar").hasClass("focused-tab") ){
			$(".tab-cargar").removeClass("focused-tab");
		}

		if( $("div.lista").hasClass("none")){
			$("div.cargar").removeClass("block");
			$("div.cargar").addClass("none");
			
			$("div.lista").removeClass("none");
			$("div.lista").addClass("block");
		}

	});

	/*
	// Seudonimos
	*/

	$('#autor').change(function(){
		generarSeudonimo(this);
	});

	$('p.no-seu').ready(function(){
		generarSeudonimo(this);
		if( $("#autor option:selected").attr('value') == 'seleccione' ){
			
			if( $("p.no-seu").hasClass("block") ){
				$("p.no-seu").removeClass("block");
				$("p.no-seu").addClass("none");
			}
		}
	});

	/*
	// Limpiar Campos
	*/

	$("a.clear-fields").on("click",function(){
		$("input#titulo").val("");
		$("#obras-form textarea").val("");
		$("#obras-form select").prop("selectedIndex",0);
		$("input#imagen").val("");
		$("input#seudonimo").attr("checked",false);
		$("p.no-seu").removeClass("block");
		$("p.no-seu").addClass("none");
		if( $(".seudonimo-container").has("p.seu") ){
			$(".seudonimo-container").children("p.seu").remove();
		}
	});


	/************************************************************************************/
	/********************************** Funciones ***************************************/
	/************************************************************************************/

	// generar Seudonimo
	function generarSeudonimo(select){
		if( select.selectedIndex != 0 ){
			// ajax de consulta
			var autor = $("#autor option:selected").val();

			/* das-ax-00  <-------- No borrar */
			$.ajax({
   				type: "POST",   				
      			url: "../controladores/seudonimos.php",
      			complete: function(jqXHR, textStatus){            		
          	  		if(textStatus=="success"){
          	  			// se completo con exito
          	  			var seudonimo = jQuery.parseJSON( jqXHR.responseText );          	  			
          	  			appendSeudonimo( seudonimo );          	  			
            		}else{
            			// error
            			alert("mal");
            			/*console.log("text status: " + textStatus);
            			console.log("*****");
            			console.log(jqXHR);
            			console.log(jqXHR.readyState);*/

            			// Lanzar un error en la clase Error
            		}
        		},
        		error: function(objeto, quepaso, otroobj){
					alert("Estas viendo esto por que fallé");
            		console.log("Pasó lo siguiente: "+quepaso);
            		console.log(quepaso);
            		console.log("este es el objeto: "+objeto);
            		console.log(objeto);
            		console.log("este es el OTRO objeto: "+otroobj);
            		console.log(otroobj);

            		// Lanzar un error en la clase Error
        		},
      			data:"seudonimo="+autor,
      			dataType: "json",
      			//beforeSend: function(){alert("enviando");},
      			async:true      			
			});
		}else{
			// desactivando el checkbox si esta activo
			handleCheckbox(false,true);
			if( $("p.no-seu").hasClass("block") ){
				$("p.no-seu").removeClass("block");
				$("p.no-seu").addClass("none");
			}
			if( $(".seudonimo-container").has("p.seu") ){
				$(".seudonimo-container").children("p.seu").remove();
			}
		}
	}	


	// agregar Seudonimo
	function appendSeudonimo(obj){
		if(obj == false){			
			// desactivando el checkbox
			handleCheckbox(false,true);

			// removiendo el tag del seudonimo
			if( $("p.no-seu").hasClass("none") ){
				$("p.no-seu").removeClass("none");
				$("p.no-seu").addClass("block");
			}
			if( $("#autor option:selected").attr('value') == 'seleccione' ){
			
				if( $("p.no-seu").hasClass("block") ){
					$("p.no-seu").removeClass("block");
					$("p.no-seu").addClass("none");
				}
			}
			if( $(".seudonimo-container").has("p.seu") ){
				$(".seudonimo-container").children("p.seu").remove();
			}
		}else{
			// activando el checkbox
			handleCheckbox(true,false);

			// agregando el tag con el seudonimo
			if( $("p.no-seu").hasClass("block") ){
				$("p.no-seu").removeClass("block");
				$("p.no-seu").addClass("none");
			}

			if( $(".seudonimo-container").children().length > 3 ){
				$("p.seu").html("El autor/a tiene el seudonimo <strong>" + obj+ "</strong>");
			}else{				
				$(".seudonimo-container").append("<p class='seu'>El autor/a tiene el seudonimo <strong>" + obj + "</strong></p>");
			}
		}
	}

	// activador/desactivador de checkbox del seudonimo
	function handleCheckbox(bool1,bool2){
		if( $("input#seudonimo").prop('disabled') == bool1 ){
			$("input#seudonimo").prop('disabled', bool2);
		}
	}
	
		
});