$(document).ready(function(){
	
	$(".close").on("click",function(){

		$("div.mensaje_error").parent().children("div.mensaje_error").remove();
	});

	/* obras */

	$(".tab-cargar").on("click",function(){
		if( $("div.cargar").css("display") == "none" ){
			$("div.lista").css("display","none");
			$("div.cargar").css("display","block");
		}

	});	

	$(".tab-lista").on("click",function(){
		if( $("div.lista").css("display") == "none" ){
			$("div.cargar").css("display","none");
			$("div.lista").css("display","block");
		}

	});	

});