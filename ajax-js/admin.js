$(document).ready(function(){
	
	$(".close").on("click",function(){

		$("div.mensaje_error").parent().children("div.mensaje_error").remove();
	});

	/* obras */

	/******************************/
	/*********** Tabs *************/
	/******************************/
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

	/******************************/
	/******** Seudonimos **********/
	/******************************/

	$('#autor').change(function(){

		if( this.selectedIndex != 0 ){
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
          	  			//console.log(typeof(seudonimo));
          	  			//console.log( jQuery.parseJSON( jqXHR.responseText ) );
          	  			if(seudonimo == false){
          	  				noSeudonimo();
          	  			}else{
          	  				appendSeudonimo( seudonimo );
          	  			}
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
		}

	});

	function noSeudonimo(){
		if(  $("#seudonimo").attr("disabled") == false ){
			$("#seudonimo").attr("disabled", true);
		}
	}

	function appendSeudonimo(obj){
		if( $(".seudonimo-container").has("label") && $(".seudonimo-container").has("input") ){
			$(".seudonimo-container").children("label").remove();
			$(".seudonimo-container").children("input").remove();

			$(".seudonimo-container").append('<label class="seudonimo" for="seudonimo">Este autor tiene el seudonimo '+obj+', desea que esta obra se muestre con ese seudonimo?</label>');
	        $(".seudonimo-container").append('<input type="checkbox" id="seudonimo" name="seudonimo">');
		}else{
			$(".seudonimo-container").append('<label class="seudonimo" for="seudonimo">Este autor tiene el seudonimo '+obj+', desea que esta obra se muestre con ese seudonimo?</label>');
	        $(".seudonimo-container").append('<input type="checkbox" id="seudonimo" name="seudonimo">');
		}
    }

});