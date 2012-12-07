window.onload = function(){
//////////////////////////////////////////////// Declaraciones ////////////////////////////////////////////////
	
	//****************************   Variables  ****************************\\
	
	var body = get_id('body').childNodes; // cuerpo del sitio con los hijos
	var body_parts = clean_text_elements(body);	//obtener los 3 hijos sin nodos de texto vacios
	var navegador = window.navigator.appName; // Navegador
	var version =window.navigator.appVersion; // Version
	
	
	//parte izquierda
	var left_categories = get_tag(body_parts[0],'a') // los tags a del menu izquierdo
	
	// contenedores de productos - zona central
	var list;
	var special_offer_div;
	var special_offer_product;
	var products_div;
	var product_div_top;
	var product_div_bottom;
	var products_container ;
	var products_img ;
	var div_boton_precio;
	var titulo_categoria;
	var titulo_producto;
	var precio_boton;
	var precio;
	var boton;
	
	// arrays de info de productos
	var mouses=["Mouse","Mouses",80];
	var teclados=["Teclado","Teclados",135];
	var memorias_usb=["Usb","Memorias Usb",45];
	var tablet_pc=["Tablet","Tablet Pc",3000];
	var smartphones=["Smartphone","Smartphones",1500];
	var auriculares=["Auriculares","Auriculares",90];
	var consolas=["Consola","consolas",2500];
	var lcds=["Lcd","Pantallas Lcd",3500];
	var dvds=["Dvd","Reproductores Dvd",750];
	var altavoces=["Altavoz","Altavoces",350];
	
	// Formulario de compra
	var form;
	var input;
	var label;
	var submit;
	var cancel;	
	
	// Carrito
	var cart=[];	
	var checkout = get_id('checkout'); // cantidad de productos
	var cantidad_del_producto;
	var existe_en_carrito;
	var datos_del_producto;
	var span_cantidad = get_id("cantidad"); //span que almacena el numero de productos en borde sueprior derecho
	var cuenta = get_id("total"); //span que almacena el total de productos en borde sueprior derecho
	var suma = 0; // sumador de cantidades
	var total = 0; // sumador de precios
	
	
	//**********************   Funciones reutilizables **********************\\
	
	// create element
	function cr_elm(tag){
		var elem = document.createElement(tag);
		return elem;
	}	
	
	// get by id
	function get_id(id){
		var elem = document.getElementById(id);
		return elem;
	}
	
	// get by tagName
	function get_tag(parent,tag){
		var elem = parent.getElementsByTagName(tag);
		return elem;
	}
	
	//append child
	function app_ch(el,parent){
		return parent.appendChild(el);
	}
	
	//remove child
	function rem_ch(el,parent){
		return parent.removeChild(el);
	}
	
	function open_modal(modal_type){//abre la modal
		var back_div = cr_elm('div');
		var front_div= cr_elm('div');
		back_div.className = 'background_modal';
		back_div.id = 'background_modal';
		front_div.id = 'front_modal';
		back_div.style.opacity = 0; // para efecto fadeIn		
		back_div.style.filter = "alpha(opacity=00)";  // para efecto fadeIn en explorer
		
		app_ch(back_div,document.body);		
		app_ch(front_div,back_div);
		
		if(modal_type["tipo"]=="compra"){modal_compra(modal_type);}
		if(modal_type["tipo"]=="checkout"){modal_checkout(modal_type);}
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
		
	function blink(obj){ // parpadeo
		obj.style.visibility = "visible";
		var espera = setTimeout(intervalo,100);		
		function intervalo(){
			var interval = setInterval(cambio_visibilidad,500);
			var fin = setTimeout(cortar,10000);
			function cambio_visibilidad(){
				if(obj.style.visibility == "visible"){
					obj.style.visibility= "hidden";
				}else{
					obj.style.visibility = "visible";
				}
			}
			function cortar(){
				clearInterval(interval);
				if(obj.style.visibility == "hidden"){
				obj.style.visibility = "visible";
				}
			}
		}		
	}
	
	function vacio(padre){ // mensaje por si el carrito de compras esta vacio
			var vacio = cr_elm("p");
			 vacio.innerHTML = "Su carrito esta vacio";
			 vacio.className="vacio";
			 app_ch(vacio,padre);
	}
	
	function create_body(array){//creamos el cuerpo y lo llenamos	
		//contenedor hijo de class="central_body"
		list=cr_elm("div");
		list.id = "list-"+array[0];
		list.className="list";
		list.style.opacity = 0; // para efecto fadeIn
		list.style.filter = "alpha(opacity=00)";  // para efecto fadeIn en explorer
		
		// titulo de la categoria
		titulo_categoria=cr_elm("h3");
		titulo_categoria.className="category_title";
		titulo_categoria.innerHTML=array[1];
		
		// contenedor e imagen de oferta especial
		special_offer_div=cr_elm("div");
		special_offer_div.className="special_offer";
		special_offer_product=cr_elm("img");
		special_offer_product.src="Iconos/productos/"+ array[1] +"/oferta_"+ array[0] +".png" ;
		
		// contenedor de los productos		
		product_div_top=cr_elm("div");
		product_div_top.className="product_div_top";
		product_div_bottom=cr_elm("div");
		product_div_bottom.className="product_div_bottom";
		
		
		// creamos los divs para almacenar las imagenes, botones, titulos y precios de los productos
		for(var i=0; i<4;i++){
			
			// producto contenedor + id
			products_container=cr_elm("div"); 
			products_container.id="product"+i;
			
			// titulo, imagen, precio, boton y contenedor de estos ultimos dos
			titulo_producto=cr_elm("h4");
			products_img=cr_elm("img");
			products_img.src="Iconos/productos/" + array[1] +"/" +array[0]+(i+2)+".png";
			
			precio_boton=cr_elm("div");
			precio=cr_elm("p");
			precio.innerHTML="$"+ parseInt(array[2]  + ((i+1)*45) );
			boton=cr_elm("a");
			boton.href="#";
			boton.className="detalles";			
			boton.innerHTML="detalles";
			
			app_ch(precio,precio_boton);
			app_ch(boton,precio_boton);
			
			app_ch(titulo_producto,products_container)
			app_ch(products_img,products_container);
			app_ch(precio_boton,products_container);
			switch(i){
				case 0:
					titulo_producto.innerHTML=array[0]  + " Apollo";
					app_ch(products_container,product_div_top);
					break;					
				case 1: 
					titulo_producto.innerHTML=array[0]  + " Spiral";
					app_ch(products_container,product_div_top);
					break;						
				case 2:
					titulo_producto.innerHTML=array[0]  + " Axis";
					app_ch(products_container,product_div_bottom);
					break;					
				case 3: 
					titulo_producto.innerHTML=array[0]  + " Softek";
					app_ch(products_container,product_div_bottom);
					break;
			}
			var array_datos_producto=[];
			boton.onclick = function(){
				array_datos_producto["nombre"]=this.parentNode.previousSibling.previousSibling.innerHTML;
				array_datos_producto["imagen"]=this.parentNode.previousSibling.src;
				array_datos_producto["precio"]=this.parentNode.childNodes[0].innerHTML;
				array_datos_producto["tipo"]="compra";
				pantalla_compra(array_datos_producto);
			}			
		}
		
		// agregando contenedores y productos		
		app_ch(special_offer_product,special_offer_div);
		app_ch(titulo_categoria,list);
		app_ch(special_offer_div,list);
		app_ch(product_div_top,list);
		app_ch(product_div_bottom,list);
		app_ch(list,body_parts[1]);	
		
		fadeIn(list);
		blink(special_offer_product);
	}
	
	function modal_compra(producto){
		var quitar_signo_pesos = producto["precio"].replace("$","");
		producto["precio"] = parseInt(quitar_signo_pesos);		
		var padre=get_id("front_modal");		
		padre.parentNode.style.opacity = 0; // para efecto fadeIn
		padre.parentNode.style.filter = "alpha(opacity=0)";  // para efecto fadeIn en explorer
		var titulo_cerrar=cr_elm("div");
		var titulo=cr_elm("h3");
		var imagen=cr_elm("img");
		var descripcion=cr_elm("p");
		var contenedor = cr_elm("div");
		var precio_por_unidad = cr_elm("p");
		var signo_pesos = cr_elm("p");
		var precio=cr_elm("p");
		var comprar=cr_elm("a");
		var cerrar=cr_elm("a");
		cerrar.innerHTML="cerrar";
		cerrar.className="cerrar";
		comprar.innerHTML="Comprar";
		imagen.src=producto["imagen"];
		precio_por_unidad.className = "precio_unitario";
		precio_por_unidad.innerHTML = "Precio por unidad:";
		signo_pesos.className = "signo";
		signo_pesos.innerHTML = " $"
		precio.innerHTML=producto["precio"];
		
		descripcion.innerHTML="Lorem Ipsum dolor gardec Namestris seneacta ut nefrit aslocnum safip.Lorem Ipsum dolor gardec Namestris seneacta ut nefrit aslocnum safip.Lorem Ipsum dolor gardec Namestris seneacta ut nefrit aslocnum safip.Lorem Ipsum dolor gardec Namestris seneacta ut nefrit aslocnum safip.Lorem Ipsum dolor gardec Namestris seneacta ut nefrit aslocnum safip.Lorem Ipsum dolor gardec Namestris seneacta ut nefrit aslocnum safip.";
		descripcion.className="descripcion_producto";
		titulo.innerHTML =producto["nombre"];
		contenedor.className="precio_comprar";		
		
		app_ch(titulo,titulo_cerrar);
		app_ch(cerrar,titulo_cerrar);
		app_ch(titulo_cerrar,padre)
		app_ch(imagen,padre);
		app_ch(descripcion,padre);		
		app_ch(precio_por_unidad,contenedor);
		app_ch(signo_pesos,contenedor);
		app_ch(precio,contenedor);
		app_ch(comprar,contenedor);		
		app_ch(contenedor,padre);
		
		fadeIn(padre.parentNode);
		
		cerrar.onclick=function(){ //boton cerrar modal
			fadeOut(padre.parentNode,cerrar);
		}
		
		comprar.onclick=function(){// boton comprar, se crea el formulario y las funciones de cada elemento
			var producto_en_carrito=[];
			var check;
			comprar.className="display_none";
			form = cr_elm('form');
			input = cr_elm('input');
			label = cr_elm('label');
			submit = cr_elm('a');
			cancel= cr_elm('a');
			
			form.className="formulario_compra";
			form.action="";
			input.type="text";			
			label.innerHTML="cantidad:";			
			submit.innerHTML="ok";
			submit.className = "boton_comprar";
			cancel.innerHTML="cancelar";
			cancel.className = "boton_cancelar";
			
			producto_en_carrito.length= 0;
			producto_en_carrito.push(producto["nombre"]);
			producto_en_carrito.push(producto["imagen"]);			
			producto_en_carrito.push(producto["precio"]);
			
			app_ch(label,form);
			app_ch(input,form);
			app_ch(submit,form);
			app_ch(cancel,form);
			app_ch(form,contenedor);
		
			cancel.onclick=function(){ //boton cancelar
				input.value ="";
				rem_ch(this.parentNode,this.parentNode.parentNode);
				comprar.className="display_block";
			}
			submit.onclick= function(){
				existe_en_carrito = revisar_si_esta_en_carrito(); // revisa si el producto ya existe en el carrito
				cantidad_del_producto = caracter_vacio(); // busca si el si ingreso un numero en el input del formulario
				if(cantidad_del_producto != false){
					if(typeof(existe_en_carrito) == "boolean"){ // pregunto el tipo de dato, porque al preguntar si es false entra en el if aunque no sea false
						check = cantidad_del_producto;					
						producto_en_carrito.push(check);
						add_to_cart(producto_en_carrito);
						alert(cantidad_del_producto + " unidades de " + producto["nombre"] + " han sido adheridas al carrito");
						fadeOut(padre.parentNode,submit);
						suma += check;
						total += (producto_en_carrito[2] * check);
						span_cantidad.innerHTML = suma;
						cuenta.innerHTML = total;
					}else if(typeof(existe_en_carrito) == "number"){
						check = cantidad_del_producto;					
						cart[existe_en_carrito][3] += check;						
						alert("El producto " + producto["nombre"] + " ya existe en el carrito, " + cantidad_del_producto + " unidades han sido adheridas");
						fadeOut(padre.parentNode,submit);
						suma += check;
						total += (producto_en_carrito[2] * check);
						span_cantidad.innerHTML = suma;
						cuenta.innerHTML = total;
					}
				}else{
					input.value = "";
				}
			}
			function caracter_vacio(){
				var valor = input.value;
				var codeat;				
				var numeric;
				
				if(valor != ""){// revisamos que hayan colocado algo y no solo apretado el boton Ok
					for(var i=0; i< valor.length;i++){//revisamos que solo hayan ingresado numeros positivos enteros
						codeat = valor.charCodeAt(i)
						if(codeat >47 && codeat < 58){							
							continue;
						}else{
							alert("solo se deben ingresar numeros positivos enteros");
							return false;
						}
					}
					numeric = parseInt(valor);
					return numeric;
				}else{alert("debes ingresar algo");return false;}
			}
			function revisar_si_esta_en_carrito(){// REVISA QUE EL PRODUCTO NO SE REPITA EN LA LISTA!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
				var nombre = producto_en_carrito[0];
				var retorno;
				for(var i = 0; i< cart.length;i++){
					if(cart[i][0] == nombre){
						retorno = i;
						return retorno;
					}else{continue;}
				}
				return false;
			}
		}
	}
	
	function modal_checkout(parametros){
		var padre=get_id("front_modal"); //obtengo el div blanco y le doy estilos
		padre.style.height = "auto";
		padre.style.width = "800px";
		
		//variables para los elementos
		var div_top = cr_elm("div");
		var titulo = cr_elm("h3");
		var cerrar = cr_elm("a");	
		var vaciar_carrito = cr_elm("a");
		var terminar_compra = cr_elm("a");
		
		// asignacion de valores y atributos		
		titulo.innerHTML = "Lista de productos y checkout";
		cerrar.className = "cerrar";
		cerrar.innerHTML = "cerrar";
		
		// append childs
		app_ch(titulo,div_top);
		app_ch(cerrar,div_top);
		app_ch(div_top,padre);
		
		if(parametros["carrito"].length < 1){ // si el carrito esta vacio
			vacio(padre);			 
		}else if(parametros["carrito"].length >=1){ // si hay al menos 1 producto
			
			// declaracion de variables
			var contenedor_principal = cr_elm("div"); //div principal
			var header = cr_elm("div"); // header con titulo y boton vaciar
			var tabla = cr_elm("table"); // tabla con los productos del carrito
			var footer = cr_elm("div"); // footer de la modal con precio, cantidad de productos y boton terminar compra
			
			// para header
			var titulo_carrito = cr_elm("h4");	
			
			// para footer
			var cantidad_total = cr_elm("p");
			var precio_total = cr_elm("p");			
			
			// para carrito
			var tr_head = cr_elm("tr");;
			var tr;
			
			var th_img = cr_elm("th");
			var th_titulo = cr_elm("th");
			var th_cantidad = cr_elm("th");
			var th_sumar_restar = cr_elm("th");
			var th_precio = cr_elm("th");
			var th_total = cr_elm("th");
			var th_eliminar = cr_elm("th");
			
			var td_img;
			var td_titulo;
			var td_cantidad;
			var td_sumar_restar;
			var td_precio;
			var td_total;
			var td_eliminar;
			
			var img_prod;
			var p;
			var cantidad;
			var sumar;
			var restar;
			var precio_unitario;
			var total_precio_por_cantidad;
			var borrar_producto;
			
			// variables para sumas, restas y borrados
			var valor_i;
			var thiz_padre;
			var suma_cantidad;
			var resta_cantidad;
			var precio_producto;
			var total_de_producto;
			
			var parsear_cantidad;
			var parsear_precio;
			var borrar_cantidad;
			var borrar_precio;
			var tr_modificar_id;
			
			th_img.innerHTML = "Imagen";
			th_titulo.innerHTML = "Producto";
			th_cantidad.innerHTML = "Cantidad";
			th_sumar_restar.innerHTML = "Agregar - Quitar";
			th_precio.innerHTML = "Precio";
			th_total.innerHTML = "Total";
			th_eliminar.innerHTML = "Borrar Producto";
			
			app_ch(th_img,tr_head);
			app_ch(th_titulo,tr_head);
			app_ch(th_cantidad,tr_head);
			app_ch(th_sumar_restar,tr_head);
			app_ch(th_precio,tr_head);
			app_ch(th_total,tr_head);
			app_ch(th_eliminar,tr_head);
			app_ch(tr_head,tabla);
			
			
			// recorro el carrito y lleno la tabla
			for(var i = 0;i< parametros["carrito"].length; i++){
			
				// creo los elementos
				tr = cr_elm("tr");
				tr.id = i;
				td_img = cr_elm("td");
				td_titulo = cr_elm("td");
				td_cantidad = cr_elm("td");
				td_sumar_restar = cr_elm("td");
				td_precio = cr_elm("td");
				td_total = cr_elm("td");
				td_eliminar = cr_elm("td");
				
				// Imagen
				img_prod = cr_elm("img");
				img_prod.src = parametros["carrito"][i][1];
				img_prod.alt = parametros["carrito"][i][0];
				
				// Titulo
				p = cr_elm("p");
				p.innerHTML = parametros["carrito"][i][0];
				
				// Cantidad
				cantidad = cr_elm("p");
				cantidad.innerHTML = parametros["carrito"][i][3];
				
				// Sumar y restar productos
				sumar = cr_elm("a");
				restar = cr_elm("a");
				sumar.innerHTML = "sumar";
				restar.innerHTML = "restar";
				sumar.className = "sumar";
				restar.className = "restar";
				
				// precio
				precio_unitario = cr_elm("p");
				precio_unitario.innerHTML = parametros["carrito"][i][2];
				
				// precio total de cantidad * precio unitario
				total_precio_por_cantidad = cr_elm("p");
				total_precio_por_cantidad.innerHTML = (parseInt(parametros["carrito"][i][2]) * parseInt(parametros["carrito"][i][3]));
				
				// borrar producto
				borrar_producto = cr_elm("a");
				borrar_producto.innerHTML = "Borrar";
				borrar_producto.className = "borrar_producto";
				
				// lleno los elementos
				app_ch(img_prod,td_img); // imagen
				app_ch(p,td_titulo); // titulo
				app_ch(cantidad,td_cantidad); //cantidad
				app_ch(sumar,td_sumar_restar); // boton sumar producto
				app_ch(restar,td_sumar_restar); // boton restar producto
				app_ch(precio_unitario,td_precio); // precio por unidad
				app_ch(total_precio_por_cantidad,td_total); // total de precio por unidad
				app_ch(borrar_producto,td_eliminar); // borrar producto
				
				app_ch(td_img,tr);
				app_ch(td_titulo,tr);
				app_ch(td_cantidad,tr);
				app_ch(td_sumar_restar,tr);
				app_ch(td_precio,tr);
				app_ch(td_total,tr);
				app_ch(td_eliminar,tr);
				app_ch(tr,tabla);
				
				sumar.onclick = function(){
					thiz_padre = this.parentNode;
					valor_i = parseInt(thiz_padre.parentNode.id);
					suma_cantidad = thiz_padre.previousSibling.firstChild;
					precio_producto = thiz_padre.nextSibling.firstChild;
					total_de_producto = thiz_padre.nextSibling.nextSibling.firstChild;
					
					parsear_cantidad = parseInt(suma_cantidad.innerHTML);
					parsear_precio = parseInt(precio_producto.innerHTML);
					
					parsear_cantidad += 1;
					parametros["cantidad"] += 1;
					parametros["carrito"][valor_i][3] = parsear_cantidad;
					parametros["subtotal"] += parsear_precio;
					
					suma_cantidad.innerHTML = parsear_cantidad;
					total_de_producto.innerHTML = parsear_precio * parsear_cantidad;
					
					cantidad_total.innerHTML = "Total de productos:" + " <span>" + parametros["cantidad"] + "</span>";
					precio_total.innerHTML = "Total de la compra:"  + " <span>$ " + parametros["subtotal"] + "</span>";
					
				}
				
				restar.onclick = function(){
					thiz_padre = this.parentNode;
					valor_i = parseInt(thiz_padre.parentNode.id);
					resta_cantidad = thiz_padre.previousSibling.firstChild;
					precio_producto = thiz_padre.nextSibling.firstChild;
					total_de_producto = thiz_padre.nextSibling.nextSibling.firstChild;
					
					parsear_cantidad = parseInt(resta_cantidad.innerHTML);
					parsear_precio = parseInt(precio_producto.innerHTML);
					
					if(parsear_cantidad >= 2){
					
						parsear_cantidad -= 1;
						parametros["cantidad"] -= 1;
						parametros["carrito"][valor_i][3] = parsear_cantidad;
						parametros["subtotal"] -= parsear_precio;
						
						resta_cantidad.innerHTML = parsear_cantidad;
						total_de_producto.innerHTML = parsear_precio * parsear_cantidad;
						
						cantidad_total.innerHTML = "Total de productos:" + " <span>" + parametros["cantidad"] + "</span>";
						precio_total.innerHTML = "Total de la compra:"  + " <span>$ " + parametros["subtotal"] + "</span>";
					
					}
				}
				
				borrar_producto.onclick = function(){
					var nuevo_id;
					thiz_padre = this.parentNode;
					valor_i = parseInt(thiz_padre.parentNode.id);					
					borrar_cantidad = parametros["carrito"][valor_i][3];
					borrar_precio = parametros["carrito"][valor_i][2];
					parametros["cantidad"] -= borrar_cantidad;
					parametros["subtotal"] -= borrar_cantidad * borrar_precio;
					
					
					cantidad_total.innerHTML = "Total de productos:" + " <span>" + parametros["cantidad"] + "</span>";
					precio_total.innerHTML = "Total de la compra:"  + " <span>$ " + parametros["subtotal"] + "</span>";
					
					//alert("se quitara " + parametros["carrito"][valor_i][0]);					
					parametros["carrito"].splice(valor_i,1);
					
					for(var j = valor_i; j < parametros["carrito"].length; valor_i++){ // cambia los ids de los tr
						if(valor_i < parametros["carrito"].length){ // revisa que valor_i no sea igual a el largo del array para que no tire error
							tr_modificar_id = get_id(valor_i +1);
							nuevo_id = parseInt(tr_modificar_id.id);
							tr_modificar_id.id = nuevo_id -1;
						}else{break;}
					}
					
					rem_ch(this.parentNode.parentNode,this.parentNode.parentNode.parentNode);
					if(tabla.childNodes.length == 1){
						vaciar(parametros);
					}
				}
			}
			
			
			// asignacion de valores y atributos
			contenedor_principal.className = "contenedor_principal_carrito";
			titulo_carrito.innerHTML = "Lista de productos";
			vaciar_carrito.innerHTML = "Vaciar carrito";
			cantidad_total.innerHTML = "Total de productos:" + " <span>" + parametros["cantidad"] + "</span>";
			precio_total.innerHTML = "Total de la compra:"  + " <span>$ " + parametros["subtotal"] + "</span>";
			terminar_compra.innerHTML = "Terminar Compra";
			
			// append childs
			app_ch(titulo_carrito,header);
			app_ch(vaciar_carrito,header);
			app_ch(cantidad_total,footer);
			app_ch(precio_total,footer);
			app_ch(terminar_compra,footer);			
			app_ch(header,contenedor_principal);
			app_ch(tabla,contenedor_principal);
			app_ch(footer,contenedor_principal);
			app_ch(contenedor_principal,padre);
		}
		
		// reduccion de opacidad
		padre.parentNode.style.opacity = 0; // para efecto fadeIn
		padre.parentNode.style.filter = "alpha(opacity=0)";  // para efecto fadeIn en explorer
		fadeIn(padre.parentNode);
		
		// eventos
		cerrar.onclick=function(){ //boton cerrar modal
			fadeOut(padre.parentNode,cerrar);
			
			cart = parametros["carrito"];			
			total = parametros["subtotal"];			
			span_cantidad.innerHTML = parametros["cantidad"];
			cuenta.innerHTML = parametros["subtotal"];
		}
	
		vaciar_carrito.onclick = function(){
			vaciar(parametros);
		}
		
		terminar_compra.onclick = function(){
			terminar_la_compra();
		}
			
			// creacion de formulario, labels inputs. selects y botones para termino de compra
			var datos_form;
			var oblig;
			var fila_1;
			var fila_2;
			var fila_3;
			var fila_4;
			var fila_5;
			var fila_6;
			
			var label_nombre;
			var label_telefono;
			var label_mail;
			var label_entrega;
			var label_fecha;
			var label_pago;
			
			var input_nombre;
			var input_telefono;
			var input_mail;
			var input_entrega;
			var array_inputs = [];
			
			var select_dia;
			var select_mes;
			var select_anio;
			var select_metodo;
			var option;
			var efectivo;
			var tarjeta;
			
			var fin_programa;
			var volver_atras;
			var error;
		
		function terminar_la_compra(){
			datos_form = cr_elm("form");
			oblig = cr_elm("p");
			error = cr_elm("p");			
			fila_1 = cr_elm("div");
			fila_2 = cr_elm("div");
			fila_3 = cr_elm("div");
			fila_4 = cr_elm("div");
			fila_5 = cr_elm("div");
			fila_6 = cr_elm("div");
			fila_7 = cr_elm("div");
			
			label_nombre = cr_elm("label");
			label_telefono = cr_elm("label");
			label_mail = cr_elm("label");
			label_entrega = cr_elm("label");
			label_fecha = cr_elm("label");
			label_pago = cr_elm("label");
			
			input_nombre = cr_elm("input");
			input_telefono = cr_elm("input");
			input_mail = cr_elm("input");
			input_entrega = cr_elm("input");
			
			select_dia = cr_elm("select");
			select_mes = cr_elm("select");
			select_anio = cr_elm("select");
			select_metodo = cr_elm("select");	
			efectivo = cr_elm("option");
			tarjeta = cr_elm("option");
			
			fin_programa = cr_elm("a");
			volver_atras = cr_elm("a");	
			
			cerrar.style.display = "none";
			contenedor_principal.style.display = "none";
			
			for(var a =1; a<32;a++){ // lenamos los dias
				option = cr_elm("option");
				option.innerHTML = a;
				app_ch(option,select_dia);
			}
			
			for(var b =1; b<13;b++){ // lenamos los meses
				option = cr_elm("option");
				option.innerHTML = b;
				app_ch(option,select_mes);
			}
			
			for(var c =2012; c<2021;c++){ // lenamos los años
				option = cr_elm("option");
				option.innerHTML = c;
				app_ch(option,select_anio);
			}
			
			// textos
			titulo.innerHTML = "Ingrese sus datos personales";
			oblig.innerHTML = "Todos los campos son obligatorios";
			error.innerHTML = "Los campos en rojo estan vacios";			
			label_nombre.innerHTML = "Nombre:";
			label_telefono.innerHTML = "Telefono:";
			label_mail.innerHTML = "Mail:";
			label_entrega.innerHTML = "Lugar de entrega:";
			label_fecha.innerHTML = "Fecha de entrega:";
			label_pago.innerHTML = "Metodo de pago:";
			efectivo.innerHTML = "Efectivo";
			tarjeta.innerHTML = "Tarjeta de credito";
			fin_programa.innerHTML = "Terminar compra";
			volver_atras.innerHTML = "Volver atras";
			
			// atributos y clases
			datos_form.action = "";
			datos_form.className = "datos_personales";
			error.className = "error_ingreso";
			input_nombre.type = "text";
			input_telefono.type = "text";
			input_mail.type = "text";
			input_entrega.type = "text";			
			
			// appends			
			app_ch(label_nombre,fila_1);
			app_ch(input_nombre,fila_1);			
			app_ch(label_telefono,fila_2);
			app_ch(input_telefono,fila_2);			
			app_ch(label_mail,fila_3);
			app_ch(input_mail,fila_3);			
			app_ch(label_entrega,fila_4);
			app_ch(input_entrega,fila_4);			
			app_ch(label_fecha,fila_5);			
			app_ch(select_dia,fila_5);			
			app_ch(select_mes,fila_5);			
			app_ch(select_anio,fila_5);
			app_ch(label_pago,fila_6);
			app_ch(efectivo,select_metodo);
			app_ch(tarjeta,select_metodo);
			app_ch(select_metodo,fila_6);
			app_ch(fin_programa,fila_7);
			app_ch(volver_atras,fila_7);			
			app_ch(oblig,datos_form);
			app_ch(error,datos_form);
			app_ch(fila_1,datos_form);
			app_ch(fila_2,datos_form);
			app_ch(fila_3,datos_form);
			app_ch(fila_4,datos_form);
			app_ch(fila_5,datos_form);
			app_ch(fila_6,datos_form);
			app_ch(fila_7,datos_form);			
			app_ch(datos_form,get_id("front_modal"));
			
			// eventos
			array_inputs.push(input_nombre);
			array_inputs.push(input_telefono);
			array_inputs.push(input_mail);
			array_inputs.push(input_entrega);
			
			fin_programa.onclick = function(){
				for(var i = 0; i < array_inputs.length;i++){
					if(array_inputs[i].value == ""){
						error.style.display = "block";
						array_inputs[i].style.backgroundColor = "rgb(191, 43, 28)";
					}else{
						var pagina = get_id("page");
						var modal = get_id("background_modal");
						var nueva_pag = cr_elm("p");
						nueva_pag.className = "fin_de_compra";
						nueva_pag.innerHTML = "Su compra se realizo con exito!";
						rem_ch(modal,document.body);
						rem_ch(pagina,document.body);
						app_ch(nueva_pag,document.body);
					}
				}
			}
			
			for(var d = 0; d < array_inputs.length; d++){
				array_inputs[d].onfocus = function(){					
					if(this.style.backgroundColor == "rgb(191, 43, 28)"){
						error.style.display = "none";
						this.value = "";
						this.style.backgroundColor = "rgb(255, 255, 255)";
					}
				}
			}
			
			volver_atras.onclick = function(){
				datos_form.style.display = "none";
				titulo.innerHTML = "Lista de productos y checkout";
				cerrar.style.display = "inline";
				contenedor_principal.style.display = "block";
			}
		}
		
		function vaciar(parametros){
			// vaciando los 2 arrays
			parametros.length = 0;
			cart.length = 0;
			total = 0;
			suma = 0;
			get_id("cantidad").innerHTML = "0";
			get_id("total").innerHTML = "0";
			parametros["subtotal"] = 0;
			parametros["cantidad"] = 0;
			rem_ch(contenedor_principal,contenedor_principal.parentNode);
			vacio(padre);
		}
		
	}
	
	
	//**********************   Funciones particulares **********************\\
	
	// al parecer hay un error con ff y chrome que tira nodos de texto vacio (salto de linea) ademas de los 3 principales cuando pido los childNodes del id=body
	// por lo cual debo usar la siguiente funcion para almacenar en un array solo los 3 divs principales	
	function clean_text_elements(id){
		var body_parts_div = [];
		for(var i=0; i<id.length;i++){
			if(id[i].nodeName.toLowerCase() == 'div'){ body_parts_div.push( id[i]); }
		}
		return body_parts_div;
	}
	
	function find_selected_category(cat){
		var return_array;
		switch(cat){
					case "mouses": return_array=mouses; break;
					case "teclados": return_array=teclados; break;
					case "memorias usb": return_array=memorias_usb; break;
					case "tablet pc": return_array=tablet_pc; break;
					case "smartphones": return_array=smartphones; break;
					case "auriculares": return_array=auriculares; break;
					case "consolas": return_array=consolas; break;
					case "pantallas lcd": return_array=lcds; break;
					case "reproductores dvd": return_array=dvds; break;
					case "altavoces": return_array=altavoces; break;
				}
		return return_array;
	}	
	
	// Creacion de la pantalla de compra de producto
	function pantalla_compra(producto){
		open_modal(producto);
	}
	
	function add_to_cart(array){
		cart.push(array);
	}


//////////////////////////////////////////////// Llamados y Eventos ////////////////////////////////////////////////
	
	//**********************   Eventos  **********************\\
	
	/* funcion que se ejecuta sobre el carrito */	
	checkout.onclick = function(){
		var info = [];
		info["carrito"] = cart;
		info["cantidad"] = parseInt(span_cantidad.innerHTML);
		info["subtotal"] = total;
		info["tipo"] = "checkout";
		open_modal(info);
	}	
	
	//**********************   Ciclos de llamados a funciones  **********************\\
	
	/* click sobre cada categoria izquierda */
	click_categories();	
	function click_categories(){	
		var category_name;
		var selected_category;
		for(var i = 0; i<left_categories.length;i++){
			left_categories[i].onclick= function(){ // funcion que llama a otras, carga los productos, la oferta especial y construye el sector central
				
				if(body_parts[1].childNodes.length != 0){				
					rem_ch(body_parts[1].childNodes[0],body_parts[1]);					
				}
				
				category_name = this.innerHTML;	
				selected_category= find_selected_category(category_name); //busco que categoria se hizo click
				
				create_body(selected_category); //creamos el cuerpo segun la categoria				
				
			}
		}
	}
}
