<!-- PANTALLA DE CARGA -->
        <div>
            <img alt="" src="assets/img/gif.gif" id="load-video">
            <script src="assets/js/loader.js"></script>
        </div>
    <?php
        // REVISAR COOKIES
        $ocultar = "display: none;";
        $register_state = "";

        if(isset($_COOKIE['cliente'])){
            //get datos de cookie
            $correo_cliente = $_COOKIE['cliente'];

            //ocultar botones
            $ocultar = "";
            $register_state = "display: none;";
        }

        if(isset($_GET['sesion'])){
            setcookie('cliente', null, -1, '/');
        }
    ?>

        <!-- ==================================== Bloque 1 ==================================== -->
        <div class="contenedor_barra_navegacion">
            <header class="cabecera">
                <article class="contenedor_logo flex">

                    <img src="assets/img/logo2.png" id="logotpf" alt="logo de la tienda" width="250px"/>
                    <script>
                        document.getElementById( "logotpf" ).onclick=function(){
                            window.location.href = "index.php";
                            console.log("click");
                        };
                    </script>
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

                            if(isset($correo_cliente)){
                                $sql = "SELECT `codigoCliente` FROM `cliente` WHERE `correoCliente`= '".$correo_cliente."'";

                                $conexion = conexion::conectar();
                                $query = $conexion->prepare($sql); $query->execute();
                                $result = $query->fetch();

                                conexion::desconectar();
                                $conexion = conexion::conectar();

                                $sql = 'SELECT COUNT(codigoCompra) FROM `carrito` WHERE `estadoCompra` = 1 AND `codigoCliente` ="'.$result[0].'"';

                                $query = $conexion->prepare($sql);
                                $query->execute();
                                $result = $query->fetch();

                                if($result[0] != "0"){
                                    $estado = "";
                                }
                            }
                        ?>

                        <span class="badge" style="<?php echo $estado; ?>">
                            <?php echo $result[0]; ?>
                        </span>
                        <?php conexion::desconectar(); ?>

                    </a>

                    <a href="index.php?sesion&reload" class="botones_usuario" style="<?php echo $ocultar; ?>">cerrar sesión</a>

                    <a href="login.php" class="botones_usuario" style="<?php echo $register_state; ?>">iniciar sesión</a>
                    <a href="register.php" class="botones_usuario" style="<?php echo $register_state; ?>">registrarse</a>

                    <div style="<?php echo $ocultar; ?>">
                        <img class="botones_usuario" src="assets/img/sesion_male.png" style="margin-left: 24%;" alt="imagen de sesion"/>
                        <p style="color: #fc427b;"><?php echo $correo_cliente; ?></p>
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
