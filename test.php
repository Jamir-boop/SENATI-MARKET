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
    $sql = "SELECT estadoCompra FROM carrito WHERE codigoProd='PRO00100' AND codigoCliente='CLI00001';";
    $conexion = conexion::conectar();
    $query = $conexion->prepare($sql);
    $query->execute();
    $check_producto = $query->fetch();
    conexion::desconectar();

    echo $check_producto[0];


    if ($check_producto[0] == 1) {
?>
        <a href="delete.php?codigo1=#">Eliminar del carrito</a>
        <script>
            // alert("Ya añadió el producto al carrito");
            document.getElementById("btn_agregar").style.display = "none";
        </script>

<?php
        }else{
        echo "no hay";
    }
?>

</body>
</html>