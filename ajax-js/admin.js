$(document).ready(function(){
	
	$(".close").on("click",function(){

		$("div.mensaje_error").parent().children("div.mensaje_error").remove();
	});

});