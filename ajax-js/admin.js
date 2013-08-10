$(document).ready(function(){

	$(".close").on("click",function(){		
		$(this).parent().parent().children("div.alert").remove();
	});


	/************************************************************************************/
	/*********************************** Obras ******************************************/
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
	// Seudonimos
	*/
	
	$("form select#autor").on("change",function(){generarSeudonimo(this);});
	$("form input#seudonimo").on("change",function(){
		if( $(this).is(":checked") ){
			if( $("p.warn").hasClass("none") ){ $("p.warn").removeClass("none").addClass("block"); }
			$("form .mail-container input").attr("disabled", true);
			$("form .mail-container #mail-museo").prop("checked", true);
		}else{
			if( $("p.warn").hasClass("block") ){ $("p.warn").removeClass("block").addClass("none"); }
			$("form .mail-container input").attr("disabled", false);
		}
	});


	/*
	// Limpiar Campos
	*/

	$("a.clear-fields, a.tab-lista").on("click",function( e ){
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

	});

	/* 
	// Borrar Obras
	*/

	$("a.Borrar").on("click",function( e ){
		e.preventDefault();
		
		var thiz = this;
		var ruta = $(this).parent().parent().parent().parent();
		var obra = $(ruta).children("td:first-child").html();
		var autor = $(ruta).children("td:first-child + td").html();
		$('#BorrarObrasModal').modal('show');
		$('#BorrarObrasModal .obra').html("<span>Obra</span>: " + obra);
		$('#BorrarObrasModal .autor').html("<span>Autor</span>: " + autor);
		
		$('div.modal-footer button.delete').on("click",function(){
			$(thiz).parent().parent().submit();
			$('#BorrarObrasModal').modal('hide');
		});
	});

	/* 
	// Editar Obras
	*/
	
	$("a.Editar").on("click",function( e ){
		e.preventDefault();
		$('#EditarObrasModal').modal('show');
	});

	

	/************************************************************************************/
	/********************************** Funciones ***************************************/
	/************************************************************************************/

	// generar Seudonimo

	function generarSeudonimo(select){
		var form = "form#" + $(select).parents("form.obras").attr("id");
		var seudonimo = $(select[select.selectedIndex]).data("seudonimo");
		if( select.selectedIndex != 0 ){
			
			if( seudonimo != undefined ){
				enableInputs(form,true);
				handleSeudonimo(form,true,seudonimo);


			}else{
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