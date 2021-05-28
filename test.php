<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="assets/img/icono.ico">

    <meta charset="UTF-8">
    <title>TEST</title>
</head>
<body style="background: #262626; color: #FFF; font-size: 2rem;">
<?php
    include_once("assets/php/conexion.php");
    include_once("assets/php/pedir_datos.php");


    $sql = "SELECT `codigoProd`, `cantidadProd` FROM carrito WHERE codigoCliente='CLI00001' AND estadoCompra='1'";

    $conexion = conexion::conectar();
    $query = $conexion->prepare($sql);
    $query->execute();
    $result_pedido = $query->fetchAll();

    $br = "<br>";

    $prod = array("PRO00003", "34");


    for($i=0; $i<sizeof($prod); $i++){
        echo $prod[$i];
    }

    foreach ($prod as $sal){
       echo $sal;
    }
?>

</body>
</html>