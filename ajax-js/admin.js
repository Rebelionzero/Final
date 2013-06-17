$(document).ready(function(){
	
	$(".close").on("click",function(){		
		$(this).parent().parent().children("div.alert").remove();
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
		if( $("#autor option:selected").attr('value') != 'seleccione' ){			
			$(".mail-container input[type=radio]").attr("disabled", false);
		}else{
			$(".mail-container input[type=radio]").attr("disabled", true).prop("checked",false);
			$("input#seudonimo").attr("checked",false);
		}
	});

	$('p.no-seu').ready(function(){
		generarSeudonimo(this);
		if( $("#autor option:selected").attr('value') == 'seleccione' ){
			
			if( $("p.no-seu").hasClass("in-bl") ){
				$("p.no-seu").removeClass("in-bl");
				$("p.no-seu").addClass("none");
			}
		}
	});

	/*
	//Mail
	*/

	$('input#seudonimo').change(function(){		
		if( $(this).is(":checked") ){			
			$(".mail-container input[type=radio]").attr("disabled", true).prop("checked",false);
			if( $("p.warn").hasClass("none") ){
				$("p.warn").removeClass("none");
				$("p.warn").addClass("block");
			}
		}else{
			$(".mail-container input[type=radio]").attr("disabled", false);
			if( $("p.warn").hasClass("block") ){
				$("p.warn").removeClass("block");
				$("p.warn").addClass("none");
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
		$("input#seudonimo").attr("disabled",true);
		$("p.no-seu").removeClass("in-bl");
		$("p.no-seu").addClass("none");
		if( $(".seudonimo-container div").has("p.seu") ){
			$(".seudonimo-container div").children("p.seu").remove();
		}

	});

	/* 
	// Borrar Obras
	*/

	$("a.Borrar").on("click",function( e ){
		e.preventDefault();
		
		var thiz = this;
		var ruta = $(this).parent().parent().parent().parent();
		var obra = $(ruta).children("td:first-child").html();
		var autor = $(ruta).children("td:first-child + td").html();
		$('#BorrarObrasModal').modal('show');
		$('#BorrarObrasModal .obra').html("<span>Obra</span>: " + obra);
		$('#BorrarObrasModal .autor').html("<span>Autor</span>: " + autor);
		
		$('div.modal-footer button.delete').on("click",function(){
			$(thiz).parent().parent().submit();
			$('#BorrarObrasModal').modal('hide');
		});
	});

	/* 
	// Editar Obras
	*/
	
	$("a.Editar").on("click",function( e ){
		e.preventDefault();

		$('#EditarObrasModal').modal('show');
	});

	/*
	// hover Seudonimo y mail
	*/

	$(".tooltipData").on("mouseover",function(){
		var position = $(this).offset();
		var width = $ (this).width();
		$(this).append("<div class='tooltip fade top in' style='top:"+ (position.top - 10) +"px; left:"+ ( (position.left + (width / 2)) - 20 ) +"px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'>"+ $(this).attr("data-title") +"</div></div>");
	});

	$(".tooltipData").on("mouseout",function(){
		$("div.tooltip").remove();
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
			if( $("p.no-seu").hasClass("in-bl") ){
				$("p.no-seu").removeClass("in-bl");
				$("p.no-seu").addClass("none");
			}
			if( $(".seudonimo-container div").has("p.seu") ){
				$(".seudonimo-container div").children("p.seu").remove();
			}

			// removiendo la advertencia si se cambia a un autor sin seudonimo
			if( $("p.warn").hasClass("block") ){
				$("p.warn").removeClass("block");
				$("p.warn").addClass("none");
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
				$("p.no-seu").addClass("in-bl");
			}

			// si la opcion seleccionada es la de seleccione un autor
			if( $("#autor option:selected").attr('value') == 'seleccione' ){			
				if( $("p.no-seu").hasClass("in-bl") ){
					$("p.no-seu").removeClass("in-bl");
					$("p.no-seu").addClass("none");
				}
			}

			if( $(".seudonimo-container div").has("p.seu") ){
				$(".seudonimo-container div").children("p.seu").remove();
			}
			
			// removiendo la advertencia si se cambia a un autor sin seudonimo
			if( $("p.warn").hasClass("block") ){
				$("p.warn").removeClass("block");
				$("p.warn").addClass("none");
			}

		}else{
			// activando el checkbox
			handleCheckbox(true,false);

			// agregando el tag con el seudonimo
			if( $("p.no-seu").hasClass("in-bl") ){
				$("p.no-seu").removeClass("in-bl");
				$("p.no-seu").addClass("none");
			}

			if( $(".seudonimo-container div").children().length > 3 ){
				$("p.seu").html("El autor/a seleccionado/a tiene el seudonimo <span class='label label-info'><strong>" + obj+ "</strong></span>");
			}else{				
				$(".seudonimo-container div").append("<p class='seu'> El autor/a seleccionado/a tiene el seudonimo <span class='label label-info'><strong>" + obj + "</strong></span></p>");
			}

			if( $("input#seudonimo").is(':checked') ){
				if( $("p.warn").hasClass("none") ){
					$("p.warn").removeClass("none");
					$("p.warn").addClass("block");
				}
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