/*
click agregar crear cookie >> a otra cookie 
objeto literal >> almacenar cookie del prod ("array")
*/

$('#add').click(function() {
	var nombre = document.getElementsByClassName("titulo_producto")[0].innerHTML
	var precio = document.getElementsByClassName("precio_producto")[0].innerHTML
	
	var size = precio.length;
	precio = precio.slice(3, size);

	if (document.cookie){
		//document.cookie = cookieAct + "nombre=" + nombre + "; "+" precio=" + res + " ;";
		document.cookie = "nombre=" + nombre + ";";
		document.cookie = "precio=" + precio + " ;";

		var nueva = document.cookie;
		console.log("cookie actualizada", nueva);

	}else{
		document.cookie = "nombre=" + nombre + "; " +"precio=" + res + ";";
		var nueva = document.cookie;
		console.log("nueva cookie", nueva);

	}
});



