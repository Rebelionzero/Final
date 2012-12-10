window.onload=function(){
	var listado = get_id("listado_menu").childNodes; /* pido los hijos li de la lista de la izquierda*/
	var li=limpiar_de_saltos(listado,"LI");
	var pedido;
	var detenido = false;
	
	for(var i=0;i<li.length;i++){
		li[i].onclick=function(){
			if(detenido == false){
				detenido = true;
				remover_hijo();
				var thiz = this.childNodes[0].id;
				var opcion = filtrar_elemento(thiz);				
				comenzar_ajax(thiz);
				
				if(opcion != "orden de compra" && opcion != "usuario"){crear_boton(opcion);}
				detenido = false;
			}
		}
	}
	
	if(get_id("cerrar_error_msg")){
		get_id("cerrar_error_msg").onclick = function(){
			rem_ch(this.parentNode);
		}
	}

}

	function filtrar_elemento(elemento_familia){
		var resultado;
		switch(elemento_familia){
			case "productos": resultado = "producto";break;
			case "categorias": resultado = "categoria";break;
			case "marcas": resultado = "marca";break;
			case "ordenes_de_compra": resultado = "orden de compra";break;
			case "usuarios": resultado = "usuario";break;
		}
		return resultado;
	}
	
	
	function crear_selects(array){ 
		// no me permite lanzar esta funcion desde ningun otro lugar que no sea este archivo
		if(typeof(array) == 'string'){
			var div = cr_elem("div");
			var p = cr_elem("p");
			div.className = 'falta_info_select';
			p.innerHTML = array;
			app_ch(p,div);
			app_ch(div,get_id("right"));
		}else{
			
			var div = cr_elem("div");
			var div_1 = cr_elem("div");
			var div_2 = cr_elem("div");
			var div_3 = cr_elem("div");
			var div_4 = cr_elem("div");
			var div_5 = cr_elem("div");
			
			var form = cr_elem("form");
			var label_nombre = cr_elem("label");
			var input_nombre = cr_elem("input");
					
			var label_precio = cr_elem("label");
			var input_precio = cr_elem("input");
			
			var label_descripcion = cr_elem("label");
			var textarea = cr_elem("textarea");
			
			var label_img = cr_elem("label");
			var img = cr_elem("input");
			
			var select_categoria = cr_elem("select");
			var select_marca = cr_elem("select");
			var option;
	
			var submit = cr_elem("input");
			var cerrar = cr_elem("a");
			
			form.action = "procesar.php";
			form.method = "post";
			form.enctype ="multipart/form-data";
						
			label_nombre.innerHTML = "Nombre del producto";
			label_precio.innerHTML = "Precio en pesos";
			label_descripcion.innerHTML = "Descripcion del producto";
			label_img.innerHTML = "Imagen";
			cerrar.innerHTML = "Cerrar";
			cerrar.href = "#"
			
			div.className = "formulario_nuevo_producto";
			div_1.className = "nombre_prd_div";
			div_2.className = "precio_prd_div";
			div_3.className = "descripcion_div";
			div_4.className = "img_div";
			div_5.className = "select_submit_div";
			
			label_nombre.className = "label_nombre_prod";
			label_precio.className = "label_precio_prod";
			input_nombre.className = "nombre_prd";
			input_precio.className = "precio_prd";
			textarea.className = "descripcion";
			label_descripcion.className = "label_desc_prod";
			
			input_nombre.type = "text";
			input_precio.type = "text";
			img.type = "file";
			submit.type = "submit";
			
			input_nombre.name = "producto";
			input_precio.name = "precio";
			select_categoria.name = "categoria";
			select_marca.name = "marca";
			textarea.name = 'descripcion';
			img.name = "imagen";
			
			submit.value = "cargar producto";
			select_categoria.id = "select_categoria";
			select_marca.id = "select_marca";
			cerrar.id = "cerrar_prod_form";
			
			option = cr_elem("option");
			option.text = 'seleccione una categoria';
			option.value = 'seleccionar';
			app_ch(option,select_categoria);
			
			option = cr_elem("option");
			option.text = 'seleccione una marca';
			option.value = 'seleccionar';
			app_ch(option,select_marca);
			
			for(var i = 0; i< array[0].length; i++){
				option = cr_elem("option");
				option.text = array[0][i]['nombre'];
				option.value = array[0][i]['id'];
				app_ch(option,select_categoria);
			}
			
			for(var j = 0; j< array[1].length; j++){
				option = cr_elem("option");
				option.text = array[1][j]['nombre'];
				option.value = array[1][j]['id'];
				app_ch(option,select_marca);
			}
			
			app_ch(label_nombre,div_1);
			app_ch(input_nombre,div_1);
			app_ch(div_1,form);
			
			app_ch(label_precio,div_2);
			app_ch(input_precio,div_2);
			app_ch(div_2,form);
			
			app_ch(label_descripcion,div_3);
			app_ch(textarea,div_3);
			app_ch(div_3,form);
			
			app_ch(label_img,div_4);
			app_ch(img,div_4);
			app_ch(div_4,form);
			
			app_ch(select_categoria,div_5);
			app_ch(select_marca,div_5);
			app_ch(submit,div_5);
			app_ch(div_5,form);
			
			app_ch(cerrar,form);
			
			app_ch(form,div);
			app_ch(div,get_id("right"));
			
			cerrar_prod_form.onclick = function(){
				rem_ch(div);
			}
		}
	}
	
	function crear_lista(array){
		var panel_derecho = get_id("right");
		var div = cr_elem("div");
		var tabla = cr_elem("table");
		var tr;
		var td;
		var td_editar;
		var td_borrar;
		var editar;
		var borrar;
		
		
		for(var i = 0;i< array[0].length;i++){
			tr = cr_elem("tr");
			tr.id = array[1]+"_"+array[0][i]['id'];
			for(var j in array[0][i]){
				if(j == "id"){continue;
				}else{
					td = cr_elem("td");
					td.innerHTML = array[0][i][j];
					app_ch(td,tr);
				}
			}
			td_editar = cr_elem("td");
			td_borrar = cr_elem("td");
			editar = cr_elem("a");
			borrar = cr_elem("a");
			editar.innerHTML = "Editar";
			borrar.innerHTML = "Borrar";
			
			app_ch(editar,td_editar);
			app_ch(borrar,td_borrar);
			app_ch(td_editar,tr);
			app_ch(td_borrar,tr);
			app_ch(tr,tabla);
			editar.onclick= function(){editar_tabla(array[1],this.parentNode.parentNode.id);}
			borrar.onclick= function(){borrar(array[1],this.parentNode.parentNode.id);}
		}
		app_ch(tabla,div);
		app_ch(div,panel_derecho);
	}
	
	/* expresiones regulares */
var email_regexp = /^[a-zA-Z0-9._-]+([+][a-zA-Z0-9._-]+){0,1}[@][a-zA-Z0-9._-]+[.][a-zA-Z]{2,6}$/;

// NO FUNCIONA NINGUNA DE LAS 2 EXPRESIONES REGULARES DE ABAJO
//var nombre_regexp = /^[A-Za-z\_\-\.\s\xF1\xD1]+$/;
//var nuevo_nombre_regexp = /[A-Za-z]/;

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
	alert(tabla);
	alert(id);
	alert(largo_id);
	alert(numero_id);
}

	function limpiar_de_saltos(elem,node){
		var li=[];
		for(var j=0;j<elem.length;j++){
			if(elem[j].nodeName == node){// a veces incluye los saltos de linea, por eso filtro lo que me trae para que sea solo LI's
				li.push(elem[j]);
			}
		}
		return li;
	}
	
	function remover_hijo(){
		var panel = get_id("right");
		rem_all_ch(panel);
	}
	
	function open_modal(modal_type){
		var back_div = cr_elm('div');
		var front_div= cr_elm('div');
		back_div.className = 'background_modal';
		back_div.id = 'background_modal';
		front_div.id = 'front_modal';
		back_div.style.opacity = 0;
		back_div.style.filter = "alpha(opacity=00)";
		
		app_ch(back_div,document.body);
		app_ch(front_div,back_div);
		
		//if(modal_type["tipo"]=="compra"){modal_compra(modal_type);}
		//if(modal_type["tipo"]=="checkout"){modal_checkout(modal_type);}
	}


	function fadeIn(obj){ // hace fadeIn
		var interval = setInterval (opacity,10);
		function opacity(){
			if(navegador == "Microsoft Internet Explorer" && version.indexOf("9.0") == -1){
				var sty = parseInt(obj.filters.alpha.opacity);
				sty += 20;					
				obj.style.filter = "alpha(opacity="+sty+")";
				if(sty == 100){clearInterval(interval);}
			}else{
				var sty= parseFloat(obj.style.opacity);
				sty += 0.2;
				obj.style.opacity = sty;
				if(sty == 1){clearInterval(interval);}
			}
		}
	}
	
	function fadeOut(obj,elem){
		elem.onclick = function (){return false; }
		var timer = setInterval(close,10);
		function close(){
			if(navegador == "Microsoft Internet Explorer" && version.indexOf("9.0") == -1){
				var sty = parseInt(obj.filters.alpha.opacity);
				sty -= 20;					
				obj.style.filter = "alpha(opacity="+sty+")";
				if(sty < 0){clearInterval(timer);rem_ch(obj,obj.parentNode);}
			}else{
				var sty= parseFloat(obj.style.opacity);				
				sty = (Math.round (100 * sty)) / 100; // arregla el problema de la diferencia en la resta de los numeros a continuacion no siendo exactamente 0.2
				sty -= 0.2;
				obj.style.opacity = sty;				
				if(sty <= 0){clearInterval(timer);rem_ch(obj,obj.parentNode);}
			}
		}
	}