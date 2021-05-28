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
        <?php require_once('assets/php/generador_pk.php'); ?>
        <?php require_once('assets/php/pedir_datos.php'); ?>
    </head>
    <body>
        <?php include('assets/php/barra_nav.php');
            //revisar cookie
            if(isset($_COOKIE['cliente'])){
                $correo_cliente = ($_COOKIE['cliente']);

                $sql = "SELECT `codigoCliente` FROM cliente WHERE correoCliente='" . $correo_cliente . "'";

                $conexion = conexion::conectar();
                $query = $conexion->prepare($sql);
                $query->execute();
                $codigo_cliente = $query->fetchAll();
                conexion::desconectar();
            }

        ?>


        <div class="wrap">
            <!-- ========================== Bloque de imagenes de muestra ========================== -->
            <section class="contenedor_muestra">
                <!-- ============= Tarjeta de imagen secundarias ============= -->

                <?php
                    $codigo_producto = $_GET["producto"];

                    $sql = 'SELECT `imgSecProd` FROM producto WHERE `codigoProd`= :cod;';

                    $conexion = conexion::conectar();
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
                            $sql = "SELECT estadoCompra FROM carrito WHERE codigoProd='". $codigo_producto."' AND codigoCliente='".$codigo_cliente[0][0]."';";
                            $conexion = conexion::conectar();
                            $query = $conexion->prepare($sql);
                            $query->execute();
                            $check_producto = $query->fetch();
                            conexion::desconectar();

                            if ($check_producto[0] == 1) {
                            ?>
                                <a href="delete.php?codigo1=<?php echo $codigo_producto;?>">Eliminar del carrito</a>
                                <script>
                                    // alert("Ya añadió el producto al carrito");
                                    document.getElementById("btn_agregar").style.display = "none";
                                </script>
                            <?php } ?>
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
            <?php
            // ========================= AGREGAR AL CARRITO =========================
            if(isset($_GET["btn_agregar"])) {
                //ultima fila del carrito
                $ultima_fila = new pedir_datos("carrito");
                $ultima_fila = $ultima_fila->last_row();
                $codigo_compra = new generador_pk($ultima_fila);
                $codigo_compra = $codigo_compra->generar();

                    //pidiendo codigo de cliente
                    if(isset($_COOKIE['cliente'])){
                        // agregando producto al carrito
                        $cantidad = $_GET["unidades"];

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
                    }else{
                        echo "<script>alert('Debe Iniciar Sesion Para Agregar Productos Al Carrito');</script>";
                        header('Location: producto.php');
                    }
            }
            ?>

        <?php include('assets/php/mas_categorias.php'); ?>
        <script src="assets/js/mas_categorias.js"></script>
        <script src="assets/js/darkmode.js"></script>
    </body>
</html>