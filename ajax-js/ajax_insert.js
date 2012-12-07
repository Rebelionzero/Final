function cargar_marca_categoria(nombre,tabla,url){
	ajax_insercion(nombre,tabla,url);
}

function ajax_insercion(valor,tabla,url){
  	var XHTTPRQ = crearObjetoXHR();
  	XHTTPRQ.open('POST',url+'.php',true);//open antes de requestheader!!!
  	XHTTPRQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  	XHTTPRQ.onreadystatechange = function(){
  		if (XHTTPRQ.readyState==4 && XHTTPRQ.status==200){
  			rem_all_ch(get_id("right"));
  			comenzar_ajax(tabla+"s");
  			crear_boton(tabla);
  			devolver_respuesta(XHTTPRQ.responseText);
  		}
  	}
	XHTTPRQ.send("valor=" + valor + "&tabla="+tabla);  	
}

function devolver_respuesta(response){
  if(response.lastIndexOf("Error") != -1){
  	// hay error
  	mostrar_mensaje(response,"error");
  }else{
  	// no hay error
  	mostrar_mensaje(response,"exito");
  }
  
}

