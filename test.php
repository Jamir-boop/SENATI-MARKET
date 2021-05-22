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
        $correo_cliente = ($_COOKIE['cliente']);

        $sql = "SELECT `codigoCliente` FROM cliente WHERE correoCliente='" . $correo_cliente . "'";

        $conexion = conexion::conectar();
        $query = $conexion->prepare($sql);
        $query->execute();
        $result_pedido = $query->fetch();

        echo $result_pedido[0];
?>

</body>
</html>