<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="icon" href="assets/img/icono.ico">

        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>𝙈𝙖𝙧𝙠𝙚𝙩 𝙋𝙖𝙩𝙝 𝙁𝙞𝙣𝙙𝙞𝙣𝙜</title>
        
        <link rel="stylesheet" href="assets/css/reset.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/contenido_index.css" />
        <link rel="stylesheet" href="assets/css/notificacion.css" />

        <script>
            localStorage.setItem("dark-mode", "true");
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    </head>
    <body>
        <?php require_once('assets/php/conexion.php'); ?>
        <?php include('assets/php/barra_nav.php')?>


        <!-- ==================================== Slider ==================================== -->
        <div class="pantalla">
            <div class="contenedor_carrusel">
                <ul class="contenedor_diapositivas">
                    <li class="diapositiva"><img alt="" src="https://senati.blackboard.com/bbcswebdav/xid-22627_1" width="100%"></li>

                    <li class="diapositiva"><img alt="" src="https://multimediapc.nl/wp-content/uploads/2019/07/webshop-fulfilment-bedrijf-fulfilment.jpg" width="100%"></li>

                    <li class="diapositiva"><img alt="" src="https://images.pexels.com/photos/546819/pexels-photo-546819.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" width="100%"></li>

                    <li class="diapositiva"><img alt="" src="https://www.4addictic.com/wp-content/uploads/2020/03/7546-scaled.jpg" width="100%"></li>
                </ul>
            </div>

            <div class="boton_izquierda">
                <img src="assets/img/izquierda.svg" alt="izquierda" class="icon" />
            </div>
            <div class="boton_derecha">
                <img src="assets/img/izquierda.svg" alt="izquierda" class="icon" />
            </div>
        </div>
        <!-- ================================================================================ -->


        <!-- CATEGORIA SELECCION -->
        <?php
            $cat = "";
            $catt = "display: none;";
            $categoria_selector = "";

            if(isset($_GET["cat"])){
                $categoria_selector = $_GET["cat"];
                $cat = "display: none;";
                $catt = "";
            }
        ?>
        <script>
            document.getElementById("catDefault").style.display = "none";
        </script>

        <section class="bloque_seccion" id="catSelection" style="<?php echo $catt; ?>">
            <div class="wrap">
                <h2 class="titulo_seccion"><?php echo $categoria_selector; ?></h2>

                <div class="contenedor_productos">
                    <!-- ========================= Producto ========================= -->
                    <?php
                        try{
                            //INSTANCIA
                            $conexion = conexion::conectar();
                            $sql = "SELECT * FROM producto WHERE `categoriaProd`='".$categoria_selector."';";

                            // Se hace la peticion SQL
                            $query = $conexion->prepare($sql);
                            $query->execute();
                            $result = $query->fetchAll();

                            foreach ($result as $fila){
                                $descuento = $fila['precioProd'];
                                $porcentaje = $descuento*(10.0/100.0);
                                $descuento += $porcentaje;
                    ?>
                        <div class="producto">
                            <div class="contenedor_img_prod">
                                <img src="<?php echo $fila['imgMainProd']; ?>" alt="imagen principal" class="img_prod" />
                            </div>

                            <div class="informacion_producto">
                                <h5 class="nombre_prod"><?php echo $fila['nombreProd']; ?></h5>
                                <h6 class="extra_prod"><?php echo $fila['categoriaProd']; ?></h6>
                                <p class="precio_prod">S/.<?php echo $fila['precioProd']; ?></p>
                                <p class="precio_desc">S/.<?php echo $descuento; ?></p>
                            </div>
                            
                            <div class="envio_prod">
                                <img src="assets/img/tienda.svg" alt="" class="lugar_prod icon" />
                                <img src="assets/img/carrito.svg" alt="" class="delivery_prod icon" />
                            </div>
                            
                            <a href="producto.php?producto=<?php echo $fila['codigoProd']; ?>" class="boton_agregar">ver</a>
                        </div>
                    <?php

                            }
                            conexion::desconectar();
                        }catch(Exception $e){die($e->getMessage());}
                    ?>
                    <!-- ============================================================ -->
                </div>     
                </div>
        </section>                           
        </div>
        <!-- ============================== Bloque categoria Default ============================== -->
        <section class="bloque_seccion" id="catDefault" style="<?php echo $cat;?>">
            <div class="wrap">
                <h2 class="titulo_seccion">Laptops</h2>

                <div class="contenedor_productos">
                    <!-- ========================= Producto ========================= -->
                    <?php
                        try{
                            //INSTANCIA
                            $conexion = conexion::conectar();
                            $sql = "SELECT * FROM producto WHERE `categoriaProd`='Laptops' LIMIT 10;";

                            // Se hace la peticion SQL
                            $query = $conexion->prepare($sql);
                            $query->execute();
                            $result = $query->fetchAll();

                        foreach ($result as $fila){
                                $descuento = $fila['precioProd'];
                                $porcentaje = $descuento*(10.0/100.0);
                                $descuento += $porcentaje;
                    ?>
                        <div class="producto">
                            <div class="contenedor_img_prod">
                                <img src="<?php echo $fila['imgMainProd']; ?>" alt="" class="img_prod" />
                            </div>
                            
                            
                            <div class="informacion_producto">
                                <h5 class="nombre_prod"><?php echo $fila['nombreProd']; ?></h5>
                                <h6 class="extra_prod"><?php echo $fila['categoriaProd']; ?></h6>
                                <p class="precio_prod">S/.<?php echo $fila['precioProd']; ?></p>
                                <p class="precio_desc">S/.<?php echo $descuento; ?></p>
                            </div>
                            
                            <div class="envio_prod">
                                <img src="assets/img/tienda.svg" alt="" class="lugar_prod icon" />
                                <img src="assets/img/carrito.svg" alt="" class="delivery_prod icon" />
                            </div>
                            
                            <a href="producto.php?producto=<?php echo $fila['codigoProd']; ?>" class="boton_agregar">ver</a>
                        </div>
                    <?php
                            }
                            conexion::desconectar();
                        }catch (Exception $e){die($e->getMessage());}
                    ?>
                    <!-- ============================================================ -->
                </div>
            </div>
            <br><br><br><br>
            <div class="wrap">
                <h2 class="titulo_seccion">Para el hogar</h2>


                <div class="contenedor_productos">
                    <!-- ========================= Producto ========================= -->
                    <?php
                        try{
                            //INSTANCIA
                            $conexion = conexion::conectar();
                            $sql = "SELECT * FROM producto WHERE `categoriaProd`='Hogar' LIMIT 10;";

                            // Se hace la peticion SQL
                            $query = $conexion->prepare($sql);
                            $query->execute();
                            $result = $query->fetchAll();

                            foreach ($result as $fila){
                                    $descuento = $fila['precioProd'];
                                    $porcentaje = $descuento*(10.0/100.0);
                                    $descuento += $porcentaje;
                    ?>
                        <div class="producto">
                            <div class="contenedor_img_prod">
                                <img src="<?php echo $fila['imgMainProd']; ?>" alt="" class="img_prod" />
                            </div>


                            <div class="informacion_producto">
                                <h5 class="nombre_prod"><?php echo $fila['nombreProd']; ?></h5>
                                <h6 class="extra_prod"><?php echo $fila['categoriaProd']; ?></h6>
                                <p class="precio_prod">S/.<?php echo $fila['precioProd']; ?></p>
                                <p class="precio_desc">S/.<?php echo $descuento; ?></p>
                            </div>

                            <div class="envio_prod">
                                <img src="assets/img/tienda.svg" alt="" class="lugar_prod icon" />
                                <img src="assets/img/carrito.svg" alt="" class="delivery_prod icon" />
                            </div>

                            <a href="producto.php?producto=<?php echo $fila['codigoProd']; ?>" class="boton_agregar">ver</a>
                        </div>
                    <?php
                            }
                            conexion::desconectar();
                        }catch (Exception $e){die($e->getMessage());}
                    ?>
                    <!-- ============================================================ -->
                </div>
            </div>
        </section>
        <!-- ================================================================================ -->


        <?php include('assets/php/mas_categorias.php'); ?>

        
        <script>
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);

            if(urlParams.has('reload')){
                location.replace("index.php");
            }
        </script>
        <script src="assets/js/darkmode.js"></script>
        <script src="assets/js/slider.js"></script>
        <script src="assets/js/mas_categorias.js"></script>
    </body>
</html>