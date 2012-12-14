function cargar_marca_categoria(nombre,tabla,url){
	ajax_insercion(nombre,tabla,url);
}

function borrar_db(info,url){	
	var tabla = info[0].replace("s","");
	var valor = [info[0],info[1],'',info[3]];
	ajax_insercion(valor,tabla,url);
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
  	
  	if(typeof(valor) == "object"){
  		if(valor[0] == 'categorias' || valor[0] == 'marcas'){
  			// edicion o eliminacion de categorias o marcas
  			XHTTPRQ.send("tabla=" + valor[0] + "&id="+ valor[1] + "&nombre=" + valor[3]);
  		}else if(valor[0] == 'productos'){
  			// send para borrar productos
  		}
  	}else{
		XHTTPRQ.send("valor=" + valor + "&tabla="+tabla);
	}	
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

