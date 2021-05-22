<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TEST</title>
</head>
<body style="background: #262626; color: #FFF; font-size: 2rem;">
<?php
    foreach (glob("assets/php/*.php") as $archivo){
        include_once($archivo);
    }

    $cliente = 'CLI00001';

    $productos = array();
    $cantidad = array();

    $conexion = conexion::conectar();

    $sql = "SELECT `codigoProd`, `cantidadProd` FROM carrito WHERE codigoCliente='".$cliente."' AND estadoCompra='1'";

    // Se hace la peticion SQL
    $query = $conexion->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
//    echo json_encode($result);
    echo sizeOf($result);

    foreach ($result as $row){
        echo $row[0]."<br>";
        echo $row[1]."<br>";

        echo "multiplicacion".$row[0]*$row[1];
    }
?>

</body>
</html>