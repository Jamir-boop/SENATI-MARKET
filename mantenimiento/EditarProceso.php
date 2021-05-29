<?php
    include('../assets/php/conexion.php');
    $conexion = conexion::conectar();
    $tabla = $_POST['tabla'];
    $query = $conexion->prepare('SELECT * FROM '.$tabla);
    $query->execute();
    $result = $query->fetchAll();
    $input_1 = $_POST['01'];
    $input_2 = $_POST['02'];
    $input_3 = $_POST['03'];
    $input_4 = $_POST['04'];

    switch ($tabla) {
      case 'boleta':
        $sentencia = $conexion->prepare('UPDATE boleta SET nombreCliente=?, totalPago=?, descripcionCompra=? WHERE codigoBoleta=?;');
        $resultado = $sentencia->execute([$input_2, $input_3, $input_4, $input_1]);
        break;
      case 'carrito':
        $sentencia = $conexion->prepare('UPDATE carrito SET codigoCliente=?, codigoProd=?, cantidadProd=? WHERE codigoCompra=?;');
        $resultado = $sentencia->execute([$input_2, $input_3, $input_4, $input_1]);
        break;
      case 'cliente':
        $sentencia = $conexion->prepare('UPDATE cliente SET nombreCliente=?, correoCliente=?, claveCliente=? WHERE codigoCliente=?;');
        $resultado = $sentencia->execute([$input_2, $input_3, $input_4, $input_1]);
        break;
      case 'producto':
        $input_5 = $_POST['05'];
        $sentencia = $conexion->prepare('UPDATE producto SET categoriaProd=?, nombreProd=?, precioProd=?, unidadesProd=? WHERE codigoProd=?;');
        $resultado = $sentencia->execute([$input_2, $input_3, $input_4, $input_5, $input_1]);
        break;
    }if($resultado == TRUE) {
        header('Location: mantenimiento_index.php?tabla='.$tabla);
    } else {
        echo "Error";
    }

?>
