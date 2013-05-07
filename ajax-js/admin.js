$(document).ready(function(){
	
	$(".close").on("click",function(){

		$("div.mensaje_error").parent().children("div.mensaje_error").remove();
	});

	/* obras */

	$(".tab-cargar").on("click",function(){
		if( $("div.cargar").hasClass("none") ){

			$("div.lista").removeClass("block");
			$("div.lista").addClass("none");
			
			$("div.cargar").removeClass("none");
			$("div.cargar").addClass("block");
			
		}

	});	

	$(".tab-lista").on("click",function(){

		if( $("div.lista").hasClass("none")){
			$("div.cargar").removeClass("block");
			$("div.cargar").addClass("none");
			
			$("div.lista").removeClass("none");
			$("div.lista").addClass("block");
		}

	});	

});