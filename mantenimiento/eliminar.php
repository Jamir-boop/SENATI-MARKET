<?php
    include('../assets/php/conexion.php');
    $codigo = $_GET['id'];
    $tabla = $_GET['tabla'];
    
    switch ($tabla) {
      case 'boleta':
        $sql = 'DELETE FROM boleta WHERE codigoBoleta=?';
        break;
      case 'carrito':
        $sql = 'UPDATE carrito SET estadoCompra=0 WHERE codigoCompra=?';
        break;
      case 'cliente':
        $sql = 'UPDATE cliente SET estadoCliente=0 WHERE codigoCliente=?';
        break;
      case 'producto':
        $sql = 'UPDATE producto SET unidadesProd=0 WHERE codigoProd=?';
        break;
    }
    $conexion = conexion::conectar();
    $sentencia = $conexion->prepare($sql);
    $resultado = $sentencia->execute([$codigo]);
    if($resultado == TRUE) {
        header('Location: mantenimiento_index.php?tabla='.$tabla);
    } else {
        echo "Error";
    }
?>
