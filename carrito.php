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
        <!-- ==================================== Bloque 1 ==================================== -->
        <div class="contenedor_barra_navegacion">
            <header class="cabecera">
                <article class="contenedor_logo flex">
                    <img src="assets/img/logo2.png" id="logotpf" alt="logo de la tienda" width="250px"/>
                </article>
                <article class="buscar">
                    <form action="" method="GET">
                        <input type="search" placeholder="Buscar"/>
                        <button type="submit"><img src="assets/img/search.svg" alt="buscar" class="icon"/></button>
                    </form>
                </article>


                <article class="botones flex">
                    <a href="#" class="botones_extra"><img src="assets/img/luna.svg" alt="modo nocturno" class="icon noche"></a>

                    <!-- OCULTANDO NOTIFICACION DE CANTIDAD DE PRODUCTOS EN EL CARRITO SI ES CERO -->

                    <a href="carrito.php" class="botones_extra" id="notificacion">
                        <img src="assets/img/carrito.svg" alt="carrito de compra" class="icon">

                        <?php
                            $estado = "display: none;";

                            try{
                                $conexion = conexion::conectar();

                                $sql = 'SELECT COUNT(codigoCompra) FROM `carrito` WHERE `estadoCompra` = 1';

                                // Se hace la peticion SQL
                                $query = $conexion->prepare($sql);
                                $query->execute();
                                $result = $query->fetch();

                                if($result[0] != "0"){
                                    $estado = "";
                                }
                            }catch (Exception $e) {die($e->getMessage());}
                        ?>

                        <span class="badge" style="<?php //echo $estado; ?>">
                            <?php echo $result[0]; ?>
                        </span>
                        <?php conexion::desconectar(); ?>

                    </a>

<!--                    // REVISAR COOKIES-->
<!--                    String ocultar = "display: none;";-->
<!--                    String registerState = "";-->
<!---->
<!--                    String sesion = request.getParameter("sesion");-->
<!--                    -->
<!--                    Cookie cookie = null;-->
<!--                    Cookie[] cookies = null;-->
<!--                    String nombreCliente = null;-->
<!--                    String direccionCorreo = null;-->
<!--                    -->
<!--                    try{-->
<!--                        if(sesion != null){-->
<!--                            cookies = request.getCookies();-->
<!--                            cookie = cookies[1];-->
<!--                            cookie.setMaxAge(0);-->
<!--                            response.addCookie(cookie);-->
<!--                        }-->
<!--                    }catch (Exception e) {}-->
<!---->
<!---->
<!--                    try{-->
<!--                -->
<!--                    cookies = request.getCookies();-->
<!--                    cookie = cookies[1];-->
<!--                    -->
<!--                    nombreCliente = cookie.getName();-->
<!--                    direccionCorreo = cookie.getValue();-->
<!--                    -->
<!--                    if(nombreCliente != null){-->
<!--                        registerState = "display: none;";-->
<!--                        ocultar = "";-->
<!--                    }-->
<!--                    }catch(Exception e){}-->

                    <a href="index.php?sesion=true&reload=true" class="botones_usuario" style="">cerrar sesión</a>

                    <a href="login.php" class="botones_usuario" style="">iniciar sesión</a>
                    <a href="register.php" class="botones_usuario" style="">registrarse</a>

                    <div style="<?php //espacio para ocultar?> display: none;">
                        <img class="botones_usuario" src="https://img.icons8.com/cute-clipart/64/000000/add-user-male.png" style="margin-left: 24%;" alt="imagen de sesion"/>
                        <p style="color: #fc427b;"><?php //espacio para ocultar?>/p>
                    </div>
                </article>
            </header>


            <nav class="barra_navegacion">
                <ul>
                    <?php
                        //INSTANCIA
                        $conexion = conexion::conectar();
                        $sql = 'SELECT `categoriaProd` FROM producto GROUP BY `categoriaProd` LIMIT 8';

                        // Se hace la peticion SQL
                        $query = $conexion->prepare($sql);
                        $query->execute();
                        $result = $query->fetchAll();

                        if($result){
                            foreach($result as $row){
                    ?>
                        <li><a href="index.php?cat=<?php echo $row['categoriaProd'] ?>"><?php echo $row['categoriaProd'] ?></a></li>
                    <?php
                            }
                            conexion::desconectar();
                        }
                    ?>
                        <li><a href="#" class="mas">Más categorías</a></li>
                </ul>
            </nav>
        </div>
        <!-- ================================================================================== -->




                <!-- GENERANDO ARRAY DE INDICES DE PRODUCTOS PEDIDOS -->
                <?php
                    //todo establecer cliente
                    $cliente = 'CLI00001';

                    $productos = array();
                    $cantidad = array();

                    $conexion = conexion::conectar();

                    $sql = "SELECT `codigoProd`, `cantidadProd` FROM carrito WHERE codigoCliente='".$cliente."' AND estadoCompra='1'";

                    // Se hace la peticion SQL
                    $query = $conexion->prepare($sql);
                    $query->execute();
                    $result_pedido = $query->fetchAll();

                    foreach ($result_pedido as $row){
                        array_push($productos, $row[0]);
                        array_push($cantidad, $row[1]);
                    }

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
                    <a href="carrito.php?pagar=true">Pagar</a>
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
                </div>
            </div>
        </div>







        <!-- ================================ Más categorias ================================ -->
        <div class="mas_categorias ocultar_extra">
            <ul>
            <?php
                try{
                    //INSTANCIA
                    $conexion = conexion::conectar();
                    $sql = "SELECT * FROM producto GROUP BY `categoriaProd`";

                    // Se hace la peticion SQL
                    $query = $conexion->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll();

                    foreach ($result as $fila){
            ?>
            <li><a href="index.php?cat=<?php echo $fila['categoriaProd'];?>"><?php echo $fila['categoriaProd'];?></a></li>
            <?php
              }
                //cerrando
                conexion::desconectar();

                }catch (Exception $e){die($e->getMessage());}
            ?>

            </ul>
        </div>
        <!-- ================================================================================ -->



        <script src="assets/js/mas_categorias.js"></script>
        <script src="assets/js/darkmode.js"></script>
    </body>
</html>