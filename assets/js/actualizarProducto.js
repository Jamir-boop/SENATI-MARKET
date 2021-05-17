// var imagen = $('#imagenSec');
var imagen = $('#imagenSec').attr('src');


$('#imagenSec').click(function() {
    $('#imagenMain').atrr('src', '"'+ imagen +'"');
    alert(imagen);
});