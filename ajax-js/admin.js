$(document).ready(function(){

	$(".close").on("click",function(){		
		$(this).parent().parent().children("div.alert").remove();
	});

	/************************************************************************************/
	/*********************************** General ****************************************/
	/************************************************************************************/

	/*
	// Tabs
	*/

	$(".tab-cargar").on("click",function(){

		if( !($(this).hasClass("focused-tab") ) ){
			$(this).addClass("focused-tab");
		}

		if($(".tab-lista").hasClass("focused-tab") ){
			$(".tab-lista").removeClass("focused-tab");
		}

		if( $("div.cargar").hasClass("none") ){

			$("div.lista").removeClass("block");
			$("div.lista").addClass("none");
			
			$("div.cargar").removeClass("none");
			$("div.cargar").addClass("block");
			
		}

	});

	$(".tab-lista").on("click",function(){

		if( !($(this).hasClass("focused-tab") ) ){
			$(this).addClass("focused-tab");
		}

		if($(".tab-cargar").hasClass("focused-tab") ){
			$(".tab-cargar").removeClass("focused-tab");
		}

		if( $("div.lista").hasClass("none")){
			$("div.cargar").removeClass("block");
			$("div.cargar").addClass("none");
			
			$("div.lista").removeClass("none");
			$("div.lista").addClass("block");
		}

	});

	/* 
	// Editar
	*/
	
	$("a.Editar").on("click",function( e ){
		e.preventDefault();
		var valuesModal = [];
		var tipoClase = this.className.split(' ')[1].split('-');
		var print;
		
		switch(tipoClase[0]){
			case 'Obra': valuesModal = ['Obra','editar-obra-modal'];break;
			case 'Categoria': valuesModal = ['Categoria','editar-categoria-modal'];break;
			case 'Autor': valuesModal = ['Autor','editar-autor-modal'];break;
			case 'Museo': valuesModal = ['Museo','editar-museo-modal'];break;
		}

		$.ajax({
			url: '../controladores/editarModalFormGenerator.php',
			type: 'GET',
			data: 'dato1='+tipoClase[0]+'&dato2='+tipoClase[1],
			success: function(res){
				$('#EditarModal .modal-body').empty();
				$('#EditarModal').removeClass();
				$('#EditarModal').addClass("modal hide fade " + valuesModal[1]);
				$('#EditarModal h3').html("Editar "+valuesModal[0]);
				$('#EditarModal .modal-body').append(res);
				$('#EditarModal').modal('show');
				res = null; // borrando el objeto
			},
			error: function(){
				print = '<p>Error al intentar editar este/a '+tipoClase[0]+'</p>';
			}
		});

	});

	/* 
	// Borrar Obras / Categorias / Autores / Museos
	*/

	$("a.Borrar").on("click",function( e ){
		e.preventDefault();
		
		var thiz = this;
		var name = thiz.nextSibling.name;
		var valuesModal = [];
		switch(name){
			case 'obra': valuesModal = ['Obra','Esta seguro de que desea borrar esta obra?'];break;
			case 'categoria': valuesModal = ['Categoria','Esta seguro de que desea borrar esta categoria?'];break;
			case 'autor' : valuesModal = ['Autor','Esta seguro de que desea borrar este autor?'];break;
			case 'museo' : valuesModal = ['Museo','Esta seguro de que desea borrar este museo?'];break;

		}

		$('#BorrarModal').modal('show');
		$('#BorrarModal #myModalLabel').html("Borrar " + valuesModal[0]);
		$('#BorrarModal .modal-body').html("<p>" + valuesModal[1] + "</p>");
		
		$('div.modal-footer button.delete').on("click",function(){
			$(thiz).parent().parent().submit();
			$('#BorrarsModal').modal('hide');
		});
	});

	$(".launch-edit").on("click",function( e ){
		e.preventDefault();
		$("#EditarModal form").submit();
	});

	/************************************************************************************/
	/*********************************** Obras ******************************************/
	/************************************************************************************/

	/*
	// Seudonimos
	*/
	$(document).on("change","form select#autor, form.edit-obras select#autor",function(){generarSeudonimo(this);});
	$(document).on("change","form input#seudonimo, form.edit-obras input#seudonimo",function(){balanceInputs(this);});


	function balanceInputs(elem){
		var clase = $(elem).parents("form")[0].className;
		if(clase.split(' ')[1] != undefined){
			// formulario de edicion
			clase = clase.split(' ')[1];
		}
		
		// habilita o deshabilita los radios segun el estado del checkbox		
		if( $("form."+ clase + " #" + elem.id ).is(":checked") ){
			if( $("form."+ clase + " p.warn").hasClass("none") ){$("form."+ clase + " p.warn").removeClass("none").addClass("block"); }
			$("form."+ clase + " .mail-container input").attr("disabled", true);
			$("form."+ clase + " .mail-container #mail-museo").prop("checked", true);
		}else{
			if( $("form."+ clase + " p.warn").hasClass("block") ){ $("form."+ clase + " p.warn").removeClass("block").addClass("none"); }
			$("form."+ clase + " .mail-container input").attr("disabled", false);
		}
		
	}

	/*
	// Limpiar Campos
	*/

	$(document).on("click","a.clear-fields, a.tab-lista",function( e ){
		e.preventDefault();
		$("input#titulo").val("");
		$("form.obras textarea").val("");
		$("form.obras select").prop("selectedIndex",0);
		$("input#imagen").val("");
		$("form.obras .opciones input").prop("checked",false).attr("disabled",true);		
		$("p.no-seu").removeClass("in-bl");
		$("p.no-seu").addClass("none");
		if( $(".seudonimo-container div").has("p.seu") ){
			$(".seudonimo-container div").children("p.seu").remove();
		}
		$("p.warn").removeClass("block").addClass("none");
		$(".content_right input[type='text'], .content_right textarea, .modal input[type='text'],.modal textarea").val("");
	});


	/************************************************************************************/
	/********************************** Funciones ***************************************/
	/************************************************************************************/

	// generar Seudonimo

	function generarSeudonimo(select){

		// obtengo el id del formulario y el atributo data de la opcion seleccionada
		var form = "form#" + $(select).parents("form.obras").attr("id");
		var seudonimo = $(select[select.selectedIndex]).data("seudonimo");
		
		if( select.selectedIndex != 0 ){
			// fixea el bug que hace que al cambiar entre autores que tienen seudonimos, el checkbox se mantenga checkeado y los radios de habiliten
			$(form+ " .opciones input[type='checkbox']").prop("checked", false);
			if( seudonimo != undefined ){
				// tiene seudonimo
				enableInputs(form,true);
				handleSeudonimo(form,true,seudonimo);
			}else{
				// no tiene seudonimo
				enableInputs(form,false);
				handleSeudonimo(form,false);
				if( $("p.warn").hasClass("block") ){ $("p.warn").removeClass("block").addClass("none"); }
				if( $(form+" input[type='checkbox']").prop("checked") == true ){ $(form+" input[type='checkbox']").prop("checked",false); }
			}
		}else{
			resetInputs(form);
		}

	}

	function resetInputs(form){
		$(form+ " .opciones input").attr("disabled", true).prop("checked",false);
		if( $("p.no-seu").hasClass("in-bl") ){ $("p.no-seu").removeClass("in-bl").addClass("none"); }
		if( $(form+" div.seudonimo-container > div").has("p.seu") ){$(form+" div.seudonimo-container > div p.seu").remove();}
		if( $("p.warn").hasClass("block") ){ $("p.warn").removeClass("block").addClass("none"); }
	}

	function enableInputs(form,checkbox){
		if(checkbox == false){
			$(form+ " .opciones input[type='radio']").attr("disabled", false);
			$(form+ " .opciones input[type='checkbox']").attr("disabled", true);
		}else{
			$(form+ " .opciones input").attr("disabled", false);
		}
	}

	function handleSeudonimo(form,booleano,seud){
		if(booleano == true){
			//ocultando la advertencia de falta de seudonimo
			if( $("p.no-seu").hasClass("in-bl") ){$("p.no-seu").removeClass("in-bl").addClass("none");}

			if( $(form+" div.seudonimo-container > div").children().length > 3 ){
				$(form+" p.seu").html("El autor/a seleccionado/a tiene el seudonimo <span class='label label-info'><strong>" + seud+ "</strong></span>");
			}else{
				$(form+" div.seudonimo-container > div").append("<p class='seu'> El autor/a seleccionado/a tiene el seudonimo <span class='label label-info'><strong>" + seud + "</strong></span></p>");
			}

		}else{
			if( $("p.no-seu").hasClass("none") ){$("p.no-seu").removeClass("none").addClass("in-bl");}
			if( $(form+" div.seudonimo-container > div").has("p.seu") ){$(form+" div.seudonimo-container > div p.seu").remove();}

		}

	}
	
});