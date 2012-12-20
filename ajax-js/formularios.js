function crear_boton(opcion){	                                        // Creacion de los botones para ingreso de nuevo elemento
	var panel_der = get_id("right");
	var div = cr_elem("DIV");
	var btn = cr_elem("A");
	
	div.id= "nuevo_"+opcion;
	btn.href="#";
	btn.className="crear_elemento btn btn-primary";
	app_ch(btn,div);
	app_ch(div,panel_der);
	
	if(opcion == "producto"){
		btn.innerHTML = "Nuevo " + opcion;
		nuevo_producto_btn(btn,opcion);
	}
	
	if(opcion == "categoria" || opcion == "marca"){
		btn.innerHTML = "Nueva " + opcion;
		nueva_categoria_marca_btn(btn,opcion);
	}
}

function nuevo_producto_btn(prod,opcion){
	prod.onclick = function(){
		rem_ch(prod.parentNode);
		traerCategoriaMarca('cargar');
	}
}

function nueva_categoria_marca_btn(cat,opcion){
	cat.onclick = function(){
		rem_ch(cat.parentNode);
				
		var div = cr_elem("div");
		var form = cr_elem("form");
		var label = cr_elem("label");
		var input = cr_elem("input");
		var submit = cr_elem("input");
		var cerrar = cr_elem("a");
		var div_opciones = cr_elem("div");

		form.className = "formulario";
		form.method = "POST";
		label.innerHTML = "Nombre de la " + opcion;
		input.type = "text";
		input.name = opcion;
		submit.type = "submit";
		submit.value = "Cargar";
		submit.className = "btn btn-primary";
		cerrar.href="#";
		cerrar.innerHTML = "Cerrar";
		cerrar.className = "btn";
		div_opciones.className = "cargar_cerrar";
		
		app_ch(label,form);
		app_ch(input,form);
		app_ch(submit,div_opciones);
		app_ch(cerrar,div_opciones);
		app_ch(div_opciones,form);
		app_ch(form,div);
		app_ch(div,get_id("right"));
		
		submit.onclick = function(e){
			e.preventDefault(); // para FF standard
         	e.returnValue=false; // para IE
         	         	
         	var validador = input.value.match(nombre_regexp); // valido si es un string, si es distinto a null llama a la funcion ajax
         	if(validador != null){
         		if(input.value.length > 30){
         			alert("el nombre cargado es muy largo");
         		}else{
         			cargar_marca_categoria(input.value,opcion,"categoria_marca");
         		}
         	}else{
         		alert("no puede ingresar numeros, caracteres extraños o espacios en blanco");
         	}
		}
		
		cerrar.onclick = function(e){
			e.preventDefault(); // para FF standard
         	e.returnValue=false; // para IE
			
			/* Este codigo se ejecuta si el usuario cierra la opcion de crear un nuevo elemento */            
            rem_ch(div);
            crear_boton(opcion);
		}
	}
}