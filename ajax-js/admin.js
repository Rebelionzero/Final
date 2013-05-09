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
	/******** On change ***********/
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
          	  			console.log( jQuery.parseJSON( jqXHR.responseText ) );

          	  			//appendSeudonimo( seudonimo );
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

	function appendSeudonimo(obj){
    	if( $(".seudonimo-container").has("p") ){
	    	$(".seudonimo-container").children("p").remove();
	        $(".seudonimo-container").append('<p>'+obj+'</p>');
	    }else{
	    	$(".seudonimo-container").append("<p>"+obj+"</p>");
	    }
    }

});