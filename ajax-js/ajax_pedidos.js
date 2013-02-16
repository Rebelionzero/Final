function comenzar_ajax(array){
	ejecutar_ajax(array);
}

function crearObjetoXHR(){
	var XHR = [
  		function () {return new XMLHttpRequest()},
  		function () {return new ActiveXObject("Msxml2.XMLHTTP")},
  		function () {return new ActiveXObject("Msxml3.XMLHTTP")},
  		function () {return new ActiveXObject("Microsoft.XMLHTTP")}
  	];
	var xhttp = false;
  	for(var i=0;i<XHR.length;i++){
  		try{xhttp = XHR[i]();}
  		catch (e){continue;}
  		break;
  	}
  	return xhttp;
}

function ejecutar_ajax(valor){
  	var XHTTPRQ = crearObjetoXHR();
  	XHTTPRQ.open('POST','../controladores/pedidos.php',true);//open antes de requestheader!!!		
  	XHTTPRQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  	XHTTPRQ.onreadystatechange = function(){
  		if (XHTTPRQ.readyState==4 && XHTTPRQ.status==200){
  			devolver_elementos(XHTTPRQ.responseText,valor);
  		}
  	}
  	XHTTPRQ.send("algo=" + valor);
}

function devolver_elementos(elem,tabla){
	var respuesta = "var obj="+elem;
	eval(respuesta);	
	var array = [];
  

	if(obj[0] == false){
		tablas_ajax_vacias(obj[1]);
	}else{
		array = [obj,tabla];
		crear_lista(array);
	}
  
}

function traerCategoriaMarca(pedido){
	var XHTTPRQ = crearObjetoXHR();
  	XHTTPRQ.open('POST','../controladores/pedido_especifico.php',true);//open antes de requestheader!!!		
  	XHTTPRQ.setRequestHeader('Content-type','application/x-www-form-urlencoded');
  	XHTTPRQ.onreadystatechange = function(){
  		if (XHTTPRQ.readyState==4 && XHTTPRQ.status==200){
  			devolver(XHTTPRQ.responseText,pedido);
  		}
  	}
  	XHTTPRQ.send(null);
}

function devolver(lista,tipo){
	var respuesta = "var obj="+lista;
	eval(respuesta);
	if(tipo == 'cargar'){
	 crear_selects(obj);
  }else if(tipo == 'editar'){
    lista_editar(obj);
  }
}
