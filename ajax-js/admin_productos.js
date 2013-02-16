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
				
				crear_boton(opcion);
				detenido = false;
			}
		}
	}
	
	if(get_id("cerrar_error_msg")){
		get_id("cerrar_error_msg").onclick = function(){
			rem_ch(this.parentNode);
		}
	}
	
	
	if(get_id("carga_exitosa_msg")){
		get_id("carga_exitosa_msg").onclick = function(){
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
			var div_6 = cr_elem("div");
			var div_group1 = cr_elem("div");
			var div_group2 = cr_elem("div");
			var div_group3 = cr_elem("div");
			
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

			form.action = "controladores/procesar.php";
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
			div_5.className = "select_div";
			div_6.className = "submit_div";
			div_group1.className = "group_1";
			div_group2.className = "group_2";
			div_group3.className = "group_3";
			
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
			
			submit.value = "Cargar producto";
			submit.className = "btn btn-primary";

			select_categoria.id = "select_categoria";
			select_marca.id = "select_marca";
			cerrar.id = "cerrar_prod_form";
			cerrar.className = "btn";

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
			app_ch(div_1,div_group1);
			
			app_ch(label_precio,div_2);
			app_ch(input_precio,div_2);
			app_ch(div_2,div_group1);
			app_ch(div_group1,form);
			
			app_ch(label_descripcion,div_3);
			app_ch(textarea,div_3);
			app_ch(div_3,div_group2);
			
			app_ch(label_img,div_4);
			app_ch(img,div_4);
			app_ch(div_4,div_group2);
			app_ch(div_group2,form);
			
			app_ch(select_categoria,div_5);
			app_ch(select_marca,div_5);
			
			app_ch(submit,div_6);
			app_ch(cerrar,div_6);
			app_ch(div_5,div_group3);
			app_ch(div_6,div_group3);
			app_ch(div_group3,form);
			
			app_ch(form,div);
			app_ch(div,get_id("right"));
			
			cerrar_prod_form.onclick = function(){
				rem_ch(div);
			}
		}
	}
	
	function lista_editar(array){
		var categoria = get_id('select_categoria');
		var marca = get_id('select_marca');
		var option;

		for(var i = 0; i< array[0].length; i++){
			option = cr_elem("option");
			option.text = array[0][i]['nombre'];
			option.value = array[0][i]['id'];
			app_ch(option,categoria);
		}
			
		for(var j = 0; j< array[1].length; j++){
			option = cr_elem("option");
			option.text = array[1][j]['nombre'];
			option.value = array[1][j]['id'];
			app_ch(option,marca);
		}
	}

	function crear_lista(array){
		var panel_derecho = get_id("right");
		var div = cr_elem("div");
		var tabla = cr_elem("table");
		var tbody = cr_elem("tbody");
		var div_container = cr_elem("div");
		var nav_bar_inner = cr_elem("div");
		var ul_titulo = cr_elem("ul");
		var tr;
		var td;
		var img;
		var li_nombre;
		var li_opciones;
		var td_editar_borrar;
		var editar;
		var borrar;
		
		li_nombre = cr_elem("li");
		li_opciones = cr_elem("li");
		li_nombre.innerHTML = "Nombre";
		li_opciones.innerHTML = "Opciones";
		li_opciones.className = "li_opciones";
		div_container.className = "contenedor";

		app_ch(li_nombre,ul_titulo);
		
		if(array[1] == 'productos'){
			var li_precio = cr_elem("li");
			var li_descripcion = cr_elem("li");
			var li_imagen_nombre = cr_elem("li");
			var li_imagen = cr_elem("li");
			var li_categoria = cr_elem("li");
			var li_marca = cr_elem("li");
			
			li_precio.innerHTML = 'Precio';
			li_descripcion.innerHTML = 'Descripcion';
			li_imagen_nombre.innerHTML = 'Nombre de la imagen';
			li_imagen.innerHTML = 'Imagen';
			li_categoria.innerHTML = 'Categoria';
			li_marca.innerHTML = 'Marca';
			
			li_imagen_nombre.className = "ndli";
			li_descripcion.className = "descripcion";

			app_ch(li_precio,ul_titulo);
			app_ch(li_descripcion,ul_titulo);
			app_ch(li_imagen_nombre,ul_titulo);
			app_ch(li_imagen,ul_titulo);
			app_ch(li_categoria,ul_titulo);
			app_ch(li_marca,ul_titulo);
			
			ul_titulo.className = "titulo_productos nav";
			tabla.className = "table table-striped lista_prods";
			
		}else if(array[1] == 'categorias' || array[1] == 'marcas'){
			var fecha = cr_elem("li");
			fecha.innerHTML = 'Fecha de creacion';
			
			ul_titulo.className = "titulo_marcas_categorias nav";
			tabla.className = "table table-striped lista_cats_mars";
			app_ch(fecha,ul_titulo);
		}
		
		app_ch(li_opciones,ul_titulo);
		
		for(var i = 0;i< array[0].length;i++){
			tr = cr_elem("tr");
			tr.id = array[1]+"_"+array[0][i]['id'];
			for(var j in array[0][i]){
				if(j == "id"){continue;
				}else{
					td = cr_elem("td");
					td.className = "td_prod_"+j;
					if(array[1] == 'productos'){
						if(j == "src"){
							img	= cr_elem("img");
							img.src = 'Prod_images/'+ array[0][i][j];
							app_ch(img,td);
						}else{
							td.innerHTML = array[0][i][j];
						}
					}else{
						td.innerHTML = array[0][i][j];
					}
					app_ch(td,tr);
				}
			}
			
			
			
			td_editar_borrar = cr_elem("td");
			td_editar_borrar.className = "td_editar_borrar";
			editar = cr_elem("a");
			borrar = cr_elem("a");			
			editar.innerHTML = "Editar";
			borrar.innerHTML = "Borrar";
			editar.className = "btn";
			borrar.className = "btn btn-danger"; 
			
			nav_bar_inner.className = 'navbar-inner';
						
			app_ch(editar,td_editar_borrar);
			app_ch(borrar,td_editar_borrar);
			app_ch(td_editar_borrar,tr);
			app_ch(tr,tbody);
			app_ch(tbody,tabla);
			app_ch(ul_titulo,nav_bar_inner);
			app_ch(nav_bar_inner,div_container);
			app_ch(tabla,div_container);
			
			editar.onclick= function(){editar_tabla(array[1],this.parentNode.parentNode.id);}
			borrar.onclick= function(){borrar_tabla(array[1],this.parentNode.parentNode.id,this.parentNode.parentNode.firstChild.innerHTML);}
		}
		app_ch(div_container,div);
		app_ch(div,panel_derecho);
	}
	
	/* expresiones regulares */
var email_regexp = /^[a-zA-Z0-9._-]+([+][a-zA-Z0-9._-]+){0,1}[@][a-zA-Z0-9._-]+[.][a-zA-Z]{2,6}$/;

// NO FUNCIONA NINGUNA DE LAS 2 EXPRESIONES REGULARES DE ABAJO
var nombre_regexp = /^[A-Za-z\_\-\.\s\xF1\xD1]+$/;
//var nuevo_nombre_regexp = /\bt[a-z]+\b/;

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
	
	if(elemento == "producto"){
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
	var nav = cr_elem("div");
		
	h3.innerHTML = mensaje;
	cerrar.href="#";
	cerrar.innerHTML = "x";
	cerrar.className = "close";	

	app_ch(cerrar,nav);
	app_ch(h3,nav);
	
	switch(tipo){
		case "error": div.className = "mensaje_error alert alert-error container";break;
		case "exito": div.className = "mensaje_exito alert alert-success container";break;
	}
	
	cerrar.onclick = function(){
		rem_ch(div);
	}

	app_ch(nav,div);
	app_ch(div,mensaje_contenedor);
}

function editar_tabla(tabla,id){
	var numero_id = parseInt(id.substr( (id.lastIndexOf("_"))+1 , id.length) ); // devuelve en number el numero de id del elemento
	var info = [tabla,numero_id,"editar"];	
	open_modal(info);
}

function borrar_tabla(tabla,id,nombre){
	var numero_id = parseInt(id.substr( (id.lastIndexOf("_"))+1 , id.length) ); // devuelve en number el numero de id del elemento	
	var info = [tabla,numero_id,"borrar",nombre];
	open_modal(info);
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
	
	function open_modal(modal){
		var navegador = window.navigator.appName; // Navegador
		var version =window.navigator.appVersion; // Version
		var back_div = cr_elem('div');
		var front_div= cr_elem('div');
		
		var form = cr_elem('form');
		var field = cr_elem('fieldset');
		var label_nombre = cr_elem('label');
		var titulo = cr_elem('h2');
		var input_nombre = cr_elem('input');
		var submit = cr_elem('input');
		var cancel = cr_elem('input');

		back_div.className = 'background_modal';
		back_div.id = 'background_modal';
		front_div.id = 'front_modal';
		front_div.className = 'dropdown-menu';
		back_div.style.opacity = 0;
		back_div.style.filter = "alpha(opacity=00)";
		
		form.className = 'edit_form';
		form.method = 'post';
		form.id = 'edit_form';

		submit.type = "submit";
		submit.value = "Enviar";
		
		cancel.type = "button";
		cancel.value = "Cancelar";

		if(modal[2] == 'editar'){
			submit.value = "Editar";
			if(modal[0] == 'marcas' || modal[0] == 'categorias'){				
				form.enctype = 'application/x-www-form-urlencoded';
				titulo.innerHTML = "Editar " + modal[0].replace("s","");
				label_nombre.innerHTML = 'Nombre de la '+ modal[0].replace("s","")+ ": ";
				
				form.action = 'controladores/editar.php';
				form.className = "Editar_CM";
				submit.className = "Editar_CM";
				submit.className = "Editar_CM btn btn-success";
				cancel.className = "Editar_CM btn btn-danger";

				input_nombre.type = "text";
				input_nombre.name = "nombre";
				
				submit.onclick = function(e){
					e.preventDefault();
	         		e.returnValue=false;
	         		
	         		modal.push(input_nombre.value);
	         		var validador = input_nombre.value.match(nombre_regexp); // valido si es un string, si es distinto a null llama a la funcion ajax        		         		
	         		if(validador != null){
	         			if(input_nombre.value.length > 30){
	         				alert("el nombre cargado es muy largo");
	         				rem_ch(back_div);
		         		}else{
	    	     			cargar_marca_categoria(modal,modal[0].replace("s",""),"../controladores/editar");
	    	     			rem_ch(back_div);
	         			}
	         		}else{
	         			alert("no puede ingresar numeros, caracteres extraños o espacios en blanco");
	         			rem_ch(back_div);
	         		}
				}
				
				
				app_ch(titulo,form);
				app_ch(label_nombre,field);
				app_ch(input_nombre,field);
				app_ch(submit,field);
				app_ch(cancel,field);
				app_ch(field,form);
				app_ch(form,front_div);
				
			}else if(modal[0] == 'productos'){
				
				var label_precio = cr_elem('label');
				var precio = cr_elem('input');
				var textarea = cr_elem('textarea');
				var label_textarea = cr_elem('label');
				var imagen = cr_elem('input');
				var label_imagen = cr_elem('label');
				var select_categoria = cr_elem('select');
				var select_marca = cr_elem('select');
				var hidden = cr_elem('input');
				var option;

				form.enctype ="multipart/form-data";
				form.action = "../controladores/editar_productos.php";
				form.className = "editar_productos";
				
				label_nombre.innerHTML = "Nombre del producto";
				label_precio.innerHTML = "Precio en pesos";
				label_textarea.innerHTML = "Descripcion del producto";
				label_imagen.innerHTML = "Imagen";
				titulo.innerHTML = 'Editar producto';
				
				label_nombre.className = "label_nombre_prod";
				label_precio.className = "label_precio_prod";
				input_nombre.className = "nombre_prd";
				precio.className = "precio_prd";
				textarea.className = "descripcion";
				label_textarea.className = "label_desc_prod";
				label_imagen.className = "label_img";
				cancel.className = "btn";
				
				input_nombre.type = "text";
				precio.type = "text";
				imagen.type = "file";
				submit.type = "submit";
				hidden.type = "hidden";

				input_nombre.name = "producto";
				precio.name = "precio";
				select_categoria.name = "categoria";
				select_marca.name = "marca";
				textarea.name = 'descripcion';
				imagen.name = "imagen";
				hidden.name = "hidden";

				submit.value = "Editar producto";
				submit.className = "btn btn-primary";
				hidden.value = modal[1];

				select_categoria.id = "select_categoria";
				select_marca.id = "select_marca";
				
				option = cr_elem("option");
				option.text = 'seleccione una categoria';
				option.value = 'seleccionar';
				app_ch(option,select_categoria);
				
				option = cr_elem("option");
				option.text = 'seleccione una marca';
				option.value = 'seleccionar';
				app_ch(option,select_marca);

				app_ch(titulo,field);
				app_ch(label_nombre,field);
				app_ch(input_nombre,field);
				app_ch(label_precio,field);
				app_ch(precio,field);
				app_ch(label_textarea,field);
				app_ch(textarea,field);
				app_ch(label_imagen,field);
				app_ch(imagen,field);
				app_ch(select_categoria,field);
				app_ch(select_marca,field);

				app_ch(submit,field);
				app_ch(cancel,field);
				app_ch(hidden,field);
				app_ch(field,form);
				app_ch(form,front_div);
				traerCategoriaMarca('editar');

			}
			
		}else if(modal[2] == 'borrar'){
			var titulo = cr_elem('h2');
			var aceptar = cr_elem('input');
			var cancel = cr_elem('input');
			
			titulo.innerHTML = '¿Esta seguro que desea borrar el elemento <span>' + modal[3] + '</span> de la tabla <span>' + modal[0] + '</span>?';
			
			aceptar.type = 'button';
			aceptar.className = 'aceptar btn btn-danger btn-large';
			aceptar.value = 'aceptar';
			
			cancel.type = 'button';
			cancel.className = 'cancelar btn btn-large';
			cancel.value = 'cancelar';
			
			aceptar.onclick = function(){
				borrar_db(modal,'../controladores/borrar_db');
				fadeOut(back_div,aceptar,navegador,version);
			}
			cancel.onclick = function(){fadeOut(back_div,cancel,navegador,version);}
			
			app_ch(titulo,front_div);
			app_ch(aceptar,front_div);
			app_ch(cancel,front_div);
		}
		cancel.onclick = function(){fadeOut(back_div,cancel,navegador,version);}
		app_ch(back_div,document.body);
		app_ch(front_div,back_div);
		
		fadeIn(back_div,navegador,version);
		
	}


	function fadeIn(obj,navegador,version){ // hace fadeIn
		var interval = setInterval (opacity,10);
		function opacity(){
			if(navegador == "Microsoft Internet Explorer" && version.indexOf("9.0") == -1){
				var sty = parseInt(obj.filters.alpha.opacity);
				sty += parseInt(10);
				obj.style.filter = "alpha(opacity="+sty+")";
				if(sty >= 100){clearInterval(interval);obj.style.opacity = 100;}
			}else{
				var sty= parseFloat(obj.style.opacity);
				sty += 0.1; 
				sty = sty.toFixed( 1 );// ARREGLA EL PROBLEMA DE SUMATORIA DE DECIMALES EL CUAL AGREGA 0.000000000000001!!!!
				obj.style.opacity = sty;
				if(sty >= 1){clearInterval(interval);obj.style.opacity = 1.0;}
			}
		}
	}
	
	function fadeOut(obj,elem,navegador,version){
		elem.onclick = function (){return false; }
		var timer = setInterval(close,10);
		function close(){
			if(navegador == "Microsoft Internet Explorer" && version.indexOf("9.0") == -1){
				var sty = parseInt(obj.filters.alpha.opacity);
				sty -= 10;					
				obj.style.filter = "alpha(opacity="+sty+")";
				if(sty < 0){clearInterval(timer);rem_ch(obj,obj.parentNode);}
			}else{
				var sty= parseFloat(obj.style.opacity);				
				sty = (Math.round (100 * sty)) / 100; // arregla el problema de la diferencia en la resta de los numeros a continuacion no siendo exactamente 0.2
				sty -= 0.1;
				obj.style.opacity = sty;				
				if(sty <= 0){clearInterval(timer);rem_ch(obj,obj.parentNode);}
			}
		}
	}