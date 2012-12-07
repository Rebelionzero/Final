window.onload = function(){
	var nuevo = document.getElementsByTagName("div");
	for(var n =0;n<nuevo.length;n++){
		if(nuevo[n].className == "nuevo"){
			nuevo = nuevo[n];
			break;
		}
	}
	var formu=document.getElementById("ingreso_producto");
	var button;
	nuevo.onclick = function(){
		formu.className="block";
	}
	for(var b=0;b<formu.length;b++){
		if(formu[b].type =="button"){
			button  = formu[b];
			break;
		}
	}
	button.onclick = function(){
		for(var a = 0; a<formu.length;a++){
			if(formu[a].type == "text"){
				formu[a].value = "";
			}
		}
		formu.className ="none";
	}
}