<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="icon" href="assets/img/icono.ico">

        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <?php require_once('assets/php/conexion.php'); ?>

        <title>Eliminar</title>
    </head>
    <body>
    <?php
        if(isset($_GET["codigo1"])) {
            $codigo_producto = $_GET["codigo1"];
            $vuelta = "Location: producto.php?producto=".$codigo_producto;
        }else{
            $codigo_producto = $_GET["codigo"];
            $vuelta = "Location: carrito.php";
        }

        try{
            $sql = "UPDATE `carrito` SET `estadoCompra`='0' WHERE `codigoProd`= :codigo ;";

            $objeto = new conexion();
            $conexion = $objeto->conectar();
            $query = $conexion->prepare($sql);
            $query->bindValue(":codigo", $codigo_producto);

            $rs = $query->execute();
            if($rs){
                header($vuelta);
            }
        }catch(Exception $e){die($e->getMessage());}
    ?>
    </body>
</html>