$(document).ready(function(){
	var geturl;

	$(".lista a").each(function(a,i){

		$(this).on("click",function( e ){
			switch( $(this).parent()[0].className){
				case "filtro_autores": geturl = '../controladores/getAutores.php';
				case "filtro_museos": break;
				case "filtro_categorias": break;
				case "filtro_obras": break;
			}
		});

		$.ajax({
			url: geturl,
			type: 'GET',
			success: function(res){
				console.log(res);
			},
			error: function(){
				print = '<p>Error</p>';
			}
		});

	});
});