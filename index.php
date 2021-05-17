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

        <?php require_once('assets/php/Conexion.php'); ?>

        <script>
            localStorage.setItem("dark-mode", "true");
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    </head>
    <body>
        <!-- PANTALLA DE CARGA -->
        <div>
            <img alt="" src="assets/img/gif.gif" id="load-video">
            <script src="assets/js/loader.js"></script>
        </div>


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
                                //INSTANCIA
                                $objeto = new Conexion();

                                //Guardo objeto que retorna el metodo conectar
                                $conexion = $objeto->conectar();

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
                        <?php $objeto->desconectar(); ?>

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
                        $conexion = $objeto->conectar();
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
                            $objeto->desconectar();
                        }
                    ?>
                        <li><a href="#" class="mas">Más categorías</a></li>
                </ul>
            </nav>
        </div>
        <!-- ================================================================================== -->






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
                            $conexion = $objeto->conectar();
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
                            $conexion = $objeto->conectar();
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
                            $objeto->desconectar();
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
                            $conexion = $objeto->conectar();
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
                            $objeto->desconectar();
                        }catch (Exception $e){die($e->getMessage());}
                    ?>
                    <!-- ============================================================ -->
                </div>
            </div>
        </section>
        <!-- ================================================================================ -->




        <!-- ================================ Más categorias ================================ -->
        <div class="mas_categorias ocultar_extra">
            <ul>
            <?php
                try{
                    //INSTANCIA
                    $conexion = $objeto->conectar();
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
                $objeto->desconectar();
                        
                }catch (Exception $e){die($e->getMessage());}
            ?>

            </ul>
        </div>
        <!-- ================================================================================ -->

        
        <script>
            //var reload = document.getAttribute("reload");
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);

            if(urlParams.has('reload')){
                console.log("true");
                location.replace("index.jsp");
            }
        </script>
        <script src="assets/js/darkmode.js"></script>
        <script src="assets/js/slider.js"></script>
        <script src="assets/js/mas_categorias.js"></script>
    </body>
</html>