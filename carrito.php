<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="icon" href="assets/img/icono.ico">

        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>𝘾𝙖𝙧𝙧𝙞𝙩𝙤</title>
        
        <link rel="stylesheet" href="assets/css/reset.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/contenido_index.css" />
        <link rel="stylesheet" href="assets/css/carrito.css" />
        <link rel="stylesheet" href="assets/css/notificacion.css" />

        <?php require_once('assets/php/conexion.php'); ?>
        <?php require_once('assets/php/generador_pk.php'); ?>
        <?php require_once('assets/php/pedir_datos.php'); ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
    </head>
    <body>
        <?php include('assets/php/barra_nav.php')?>

                <!-- GENERANDO ARRAY DE INDICES DE PRODUCTOS PEDIDOS -->
                <?php
                    if(isset($_COOKIE['cliente'])) {
                        $correo_cliente = ($_COOKIE['cliente']);

                        $sql = "SELECT `codigoCliente`, `nombreCliente` FROM cliente WHERE correoCliente='" . $correo_cliente . "'";

                        $conexion = conexion::conectar();
                        $query = $conexion->prepare($sql);
                        $query->execute();
                        $result_cliente = $query->fetchAll();

                        $cliente = $result_cliente[0][0];

                        $conexion = conexion::conectar();

                        $sql = "SELECT `codigoProd`, `cantidadProd` FROM carrito WHERE codigoCliente='" . $cliente . "' AND estadoCompra='1'";

                        // Se hace la peticion SQL
                        $query = $conexion->prepare($sql);
                        $query->execute();
                        $result_pedido = $query->fetchAll();

                        conexion::desconectar();

                ?>

                <!-- MUESTRA DE  PRODUCTOS PEDIDOS-->
        <div class="wrap">
            <div class="contenedor_productos_comprados">
                <div class="producto_comprado">
                    <?php
                        $total_pedido = 0;
                        $total = 0;

                        foreach($result_pedido as $row){
                            $sql = "SELECT imgMainProd, nombreProd, precioProd from producto where codigoProd='".$row[0]."'";

                            $conexion = conexion::conectar();
                            $query = $conexion->prepare($sql);
                            $query->execute();
                            $result = $query->fetchAll();

                            foreach($result as $row_producto){
                                $total_pedido = ($row_producto['precioProd'] * $row[1]);
                                $total += $total_pedido;
                    ?>
                    <div class="ctn_prod_com">
                        <img alt="" src="<?php echo $row_producto['imgMainProd']?>" />
                    </div>
                    <div class="ctn_info">
                        <h3><?php echo $row_producto['nombreProd']?></h3>
                        <p>Cantidad: <?php echo $row[1]?></p>
                        <p>Precio Unidad: s/. <?php echo $row_producto['precioProd']?></p>
                        <p>Precio Total: s/. <?php echo $total_pedido?></p>
                    </div>
                    <div class="botones_accion_comp">
                        <a href="delete.php?codigo=<?php echo $row[0];?>">Eliminar</a>
                    
                         <!-- <a href="delete.php?codigo=">Eliminar unidad</a> -->
                    </div>

                    <?php
                            }
                            conexion::desconectar();
                        }
                    ?>
                </div>
            </div>
            <!-- TOTAL -->
            <div class="contenedor_precio_total">
                <div class="precio_total">
                    <h3 class="total">total: </h3>

                    <p class="num_total">s/.<?php echo $total ?></p>
                    <a href="carrito.php?pagar">Pagar</a>
                    <?php
                        if(isset($_GET['pagar'])){

                            $conexion = conexion::conectar();

                            $sql = "UPDATE carrito SET estadoCompra='0' WHERE codigoCliente='" . $cliente."';";

                            $query = $conexion->prepare($sql);
                            $query->execute();
                            $rs = $query->fetchAll();
                            conexion::desconectar();
                            ?>
                            <br><br>
                            <p style="color: #A6E22D;font-size: 20px; font-weight: 700;">Pago exitoso a nombre de <?php echo $result_cliente[0][1]; ?></p>
                            <?php
                            if($rs){
                                header("Location: carrito.php?reload");
                            }
                        }
                    ?>
                    <!--
                    try{
                        String pagar = request.getParameter("pagar");
                        if (pagar != null){
                            if(direccionCorreo != null){
                                %>
                                <br><br>
                                <p style="color: #A6E22D;font-size: 20px; font-weight: 700;">Pago exitoso <%=direccionCorreo%></p>
                                <%

                            }else{
                                %>
                                <br><br>
                                <p style="color: #fc427b;font-size: 20px; font-weight: 700;;">Para pagar debe registrarse e iniciar sesión</p>
                                <%}
                        }

                    }
                    catch (Exception e){out.println(e);}
                    -->

            <?php }else{
                      echo "<label class='inicie-sesion'>INICIE SESIÓN PARA ACCEDER A SU CARRITO</label>";
                    } ?>
                </div>
            </div>
        </div>

        <?php include('assets/php/mas_categorias.php'); ?>


        <script src="assets/js/mas_categorias.js"></script>
        <script src="assets/js/darkmode.js"></script>

        <script>
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);

            if(urlParams.has('reload')){
                location.replace("index.php");
            }
        </script>
    </body>
</html>