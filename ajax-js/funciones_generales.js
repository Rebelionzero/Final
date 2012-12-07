/* expresiones regulares */
var email_regexp = /^[a-zA-Z0-9._-]+([+][a-zA-Z0-9._-]+){0,1}[@][a-zA-Z0-9._-]+[.][a-zA-Z]{2,6}$/;
var nombre_regexp = /^[A-Za-z\_\-\.\s\xF1\xD1]+$/;

/* funciones generales */
function get_id(id){return document.getElementById(id);}          // get element by id
function cr_elem(tag){return document.createElement(tag);}        // create element
function app_ch(hijo,padre){return padre.appendChild(hijo);}      // append child
function rem_ch(elem){return elem.parentNode.removeChild(elem);}  // remove child
function rem_all_ch(father_elem){								  // remover todos los hijos
	if(father_elem.hasChildNodes){
		while (father_elem.childNodes.length >= 1){
       		father_elem.removeChild(father_elem.firstChild);
    	}
	}
}

function validar(condicional){                                    // validar segun condicional
	var parametro = eval(condicional);
	if(parametro){
		return true;
	}else{
		return false;
	}
}

function tablas_ajax_vacias(tabla){                              // mensaje de error CAMBIAR POR EL DE ABAJO
	var elemento = filtrar_elemento(tabla);
	var mensaje_contenedor = get_id("right");
	var div = cr_elem("div");
	var mensaje = cr_elem("h2");
	mensaje.className="error";
	
	if(elemento == "producto" || elemento == "usuario"){
		mensaje.innerHTML = "No hay ningun " + elemento + " cargado en este momento";
	}else{
		mensaje.innerHTML = "No hay ninguna " + elemento + " cargada en este momento";
	}
	app_ch(mensaje,div);
	app_ch(div,mensaje_contenedor);
}

function mostrar_mensaje(mensaje,tipo){                          // mensaje de error, exito o generico
	var mensaje_contenedor = get_id("right");
	var div = cr_elem("div");
	var h3 = cr_elem("h3");
	var cerrar = cr_elem("a");
		
	h3.innerHTML = mensaje;
	cerrar.href="#";
	
	app_ch(cerrar,div);
	app_ch(h3,div);
	
	switch(tipo){
		case "error": div.className = "mensaje_error";break;
		case "exito": div.className = "mensaje_exito";break;
	}
	
	app_ch(div,mensaje_contenedor);
}

function editar_tabla(tabla,id){
	var largo_id = id.length;
	var numero_id = parseInt(id.charAt(largo_id - 1));
}
