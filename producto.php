<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="icon" href="assets/img/icono.ico">

        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Document</title>
        
        <link rel="stylesheet" href="assets/css/reset.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/contenido_index.css" />
        <link rel="stylesheet" href="assets/css/producto.css" />
        <link rel="stylesheet" href="assets/css/notificacion.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="assets/js/actualizarProducto.js"></script>
        <?php require_once('assets/php/conexion.php'); ?>
        <?php require_once('assets/php/get_last_row.php'); ?>
        <?php require_once('assets/php/generador_pk.php'); ?>
    </head>
    <body>
        <!-- LOADING SCR -->
        <div>
            <img alt="" src="assets/img/gif.gif" id="load-video">
            <script src="assets/js/loader.js"></script>
        </div>

        <?php
            $codigo_producto = $_GET["producto"];
        ?>

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

                            try{                                //Guardo objeto que retorna el metodo conectar
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





        <div class="wrap">
            <!-- ========================== Bloque de imagenes de muestra ========================== -->
            <section class="contenedor_muestra">
                <!-- ============= Tarjeta de imagen secundarias ============= -->

                <?php
                    $sql = 'SELECT `imgSecProd` FROM producto WHERE `codigoProd`= :cod;';

                    conexion::conectar();
                    $query = $conexion->prepare($sql);
                    $query->bindValue(":cod", $codigo_producto);
                    $query->execute();
                    $result = $query->fetch();
                    $str_imagenes = explode("+", $result[0]);
                    foreach($str_imagenes as $img){
                ?>
                    <img alt="" src="<?php echo $img;?>" id="imagenSec">
                <?php
                    }
                    conexion::desconectar();
                ?>
                <!-- ======================================================== -->
            </section>
            <!-- =================================================================================== -->





            <?php
                $sql = 'SELECT * FROM producto WHERE `codigoProd`= :cod;';
                $conexion = conexion::conectar();
                $query = $conexion->prepare($sql);
                $query->bindValue(":cod", $codigo_producto);
                $query->execute();
                $result = $query->fetchAll();

                foreach($result as $row){
            ?>
            <div class="contenedor_general">
                <!-- ========================== Bloque MAIN ========================== -->
                <section class="informacion_extra">
                    <article class="imagen_mostrar">
                        <img alt="" src="<?php echo $row["imgMainProd"];?>" class="img_mostrada" id="imagenMain"/>
                    </article>


                    <article class="contenedor_descripcion">
                        <h2 class="titulo_descripcion">descripcion</h2>

                        <p>
                            <?php echo $row["descripcionProd"];?>
                        </p>
                    </article> 
                </section>
                <!-- =================================================================================== -->



                <!-- ========================== Bloque de imagenes de muestra ========================== -->
                <section class="contenedor_precio">
                    <div class="precio">
                        <h2 class="titulo_producto"><?php echo $row["nombreProd"];?></h2>
                        <h4 class="precio_producto">S/.<?php echo $row["precioProd"];?></h4>
                        <hr>

                        <div class="botonera">
                            <!-- <input value="Unidades:" readonly></input><input type="number" name="unidades" value="1"/> -->
                            <a href="producto.php?producto=<?php echo $codigo_producto;?>&btn_agregar&unidades=1" id="btn_agregar" >Agregar al carrito</a>
                            <!-- <a href="#">Comprar</a> -->
                            <?php
                            if(isset($_GET["btn_agregar"])){
                                $item = $_GET["btn_agregar"];
                                ?>
                                <a href="delete.php?codigo1=<?php echo $codigo_producto;?>">Eliminar del carrito</a>
                                <script>
                                    // alert("Ya añadió el producto al carrito");
                                    document.getElementById("btn_agregar").style.display = "none";
                                </script>

                                <?php
                                }
                            ?>
                        </div>
                    </div>
                </section>
                <?php
                    }
                conexion::desconectar();
                ?>

                <!-- =================================================================================== -->
            </div>
        </div>
            <!--
                if(request.getParameter("btn_agregar") != null){
                    String cantidadProd = request.getParameter("unidades");
                    try{

                        Class.forName("com.mysql.jdbc.Driver");
                        connection = DriverManager.getConnection("jdbc:mysql://localhost/pathfindingdbs?user=root&password");

                        state = connection.createStatement();
                        state.executeUpdate("insert into carrito values  ('"+nombre+"','"+cantidadProd+"')");

                        //redirecciona
                        request.getRequestDispatcher("index.jsp").forward(request, response);

                        }catch (Exception e){
                            out.println(e);
                        }
                    }
            -->
            <?php
            // ========================= AGREGAR AL CARRITO =========================
            if(isset($_GET["btn_agregar"])) {
                //ultima fila del carrito
                $ultima_fila = new get_last_row("carrito", "codigoCompra");
                $ultima_fila = $ultima_fila->last_row();
                $codigo_compra = new generador_pk($ultima_fila);
                $codigo_compra = $codigo_compra->generar();

                //pidiendo codigo de cliente
                $codigo_cliente = new pedir_datos("cliente", "CLI00001", "codigoCliente");
                $codigo_cliente = $codigo_cliente->get_datos();

                // producto
                $cantidad = $_GET["unidades"];
                $codigo_producto = $_GET["producto"];
                
                $sql = "INSERT INTO `carrito`(codigoCompra, codigoCliente, codigoProd, cantidadProd) 
                        VALUES (:codigoCompra, :codigoCliente, :codigoProd, :cantidadProd)";

                $conexion = conexion::conectar();
                $query = $conexion->prepare($sql);
                $query->bindValue(":codigoCompra", $codigo_compra);
                $query->bindValue(":codigoCliente", $codigo_cliente[0][0]);
                $query->bindValue(":codigoProd", $codigo_producto);
                $query->bindValue(":cantidadProd", $cantidad);

                $rs = $query->execute();
                if(!$rs){
                    echo "<script>alert('se produjo un error');</script>";
                }
            }
            ?>







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