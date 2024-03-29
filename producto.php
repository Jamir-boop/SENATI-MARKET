<?php
    include('assets/php/conexion.php');
    include('assets/php/pedir_datos.php');

    //pidiendo el nombre del producto para mostrar en el titulo de pagina
    $codigo_producto = $_GET["producto"];
    $nombre_producto = new pedir_datos("producto", $codigo_producto, "nombreProd");
    $nombre_producto = $nombre_producto->get_datos();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="icon" href="assets/img/icono.ico">

        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title><?= $nombre_producto[0][0]?></title>
        
        <link rel="stylesheet" href="assets/css/reset.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/contenido_index.css" />
        <link rel="stylesheet" href="assets/css/producto.css" />
        <link rel="stylesheet" href="assets/css/notificacion.css" />
        <link rel="stylesheet" href="assets/css/style_footer.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="assets/js/actualizarProducto.js"></script>
        <?php require_once('assets/php/generador_pk.php'); ?>

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
                    $sql = 'SELECT `imgSecProd` FROM producto WHERE `codigoProd`= :cod;';

                    $conexion = conexion::conectar();
                    $query = $conexion->prepare($sql);
                    $query->bindValue(":cod", $codigo_producto);
                    $query->execute();
                    $result = $query->fetch();
                    $str_imagenes = explode("+", $result[0]);
                    foreach($str_imagenes as $img){
                ?>
                    <img alt="" src="<?= $img;?>" id="imagenSec">
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
                        <img alt="" src="<?= $row["imgMainProd"];?>" class="img_mostrada" id="imagenMain"/>
                    </article>


                    <article class="contenedor_descripcion">
                        <h2 class="titulo_descripcion">descripcion</h2>

                        <p>
                            <?= $row["descripcionProd"];?>
                        </p>
                    </article> 
                </section>
                <!-- =================================================================================== -->



                <!-- ========================== Bloque de imagenes de muestra ========================== -->
                <section class="contenedor_precio">
                    <div class="precio">
                        <h2 class="titulo_producto"><?=$row["nombreProd"];?></h2>
                        <h4 class="precio_producto">S/.<?=$row["precioProd"];?></h4>
                        <hr>

                        <div class="botonera">


                            <!--  Widget de stock para todos los productos  -->
                            <style>
                                #titulo_w_unidades{
                                    font-size: 20px; 
                                    color: white; 
                                    font-weight: bold;
                                }

                                .boton_unidades{
                                    display: flex;
                                    margin: 10px 0;
                                }

                                .boton_disminuir_cant, 
                                .boton_aumentar_cant{
                                    width: 20px;
                                    padding: 10px;
                                    background-color: #FF3A7A;
                                    color:  white;

                                    border-radius: 5px;

                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    cursor:  pointer;
                                    font-weight: 600;
                                }
                                .boton_aumentar_cant:hover, .boton_disminuir_cant:hover{
                                    background-color: #D3164F;
                                    transition: all 600ms ease;
                                }
                                .cantidad_cant{
                                    font-size: 20px !important;
                                    width: 20px !important;
                                    margin: 0 5px !important;
                                    padding: 10px !important;
                                    background-color: white !important;
                                    color: black !important;
                                
                                    border-radius: 5px !important;

                                    display: flex !important;
                                    justify-content: center !important;
                                    align-items: center !important;
                                    font-weight: 600 !important;
                                    text-align: center !important;


                                }
                            </style>

                            <h3 id="titulo_w_unidades"> UNIDADES: </h3>

                            <?php  $id_producto = isset($_GET['producto']) ? $_GET['producto'] : 0;  ?>
                            <?php
                                $sql = "SELECT unidadesProd FROM producto WHERE codigoProd = '$id_producto'";

                                $connect = conexion::conectar();
                                $query = $connect->prepare($sql);
                                $query->execute();

                                $cantidad_stock_producto = $query->fetch();
                                $cantidad_stock_producto = (int) $cantidad_stock_producto[0];
                            ?>

                            <form>
                                <div class="boton_unidades">
                                    <div class="boton_disminuir_cant">-</div>
                                    <input type="text" name="unidades" class="cantidad_cant" value="1">
                                    <div class="boton_aumentar_cant">+</div>
                                </div>


                                <script>
                                    let cantidad_stock = <?= $cantidad_stock_producto ?>;

                                    const disminuir_btn = document.querySelector('.boton_disminuir_cant');
                                    const aumentar_btn = document.querySelector('.boton_aumentar_cant');
                                    let num_cantidad_stock = document.querySelector('.cantidad_cant');


                                    disminuir_btn.addEventListener('click', () => {
                                        if(num_cantidad_stock.innerHTML <= 0){
                                            num_cantidad_stock.value = 0;
                                        }else{
                                            num_cantidad_stock.value = parseInt(num_cantidad_stock.value) - 1;
                                        }
                                    });

                                    aumentar_btn.addEventListener('click', () => {
                                        if(num_cantidad_stock.value >= cantidad_stock){
                                            num_cantidad_stock.value = cantidad_stock;
                                        }else{
                                            num_cantidad_stock.value = parseInt(num_cantidad_stock.value) + 1;
                                        }
                                    });
                                </script>
                            <!--  ........................................  -->

                                <input type="hidden" name="producto" value="<?=$codigo_producto?>"/>
                                <input type="submit" name="btn_agregar" id="btn_agregar" value="Agregar al carrito"/>
                            </form>
                            <!-- <a href="#">Comprar</a> -->
                            <?php
                            if(isset($codigo_cliente)) {
                                $sql = "SELECT estadoCompra FROM carrito WHERE codigoProd='" . $codigo_producto . "' AND codigoCliente='" . $codigo_cliente[0][0] . "';";
                            }
                            $conexion = conexion::conectar();
                            $query = $conexion->prepare($sql);
                            $query->execute();
                            $check_producto = $query->fetch();
                            conexion::desconectar();



                            if($check_producto){
                            if ($check_producto[0] == 1){
                            ?>
                                <a href="delete.php?codigo1=<?=$codigo_producto;?>">Eliminar del carrito</a>
                                <script>
                                    // alert("Ya añadió el producto al carrito");
                                    document.getElementById("btn_agregar").style.display = "none";
                                </script>
                            <?php }} ?>
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
                    }
            }
            ?>

        <?php include('assets/php/mas_categorias.php'); ?>
        <?php include('assets/php/footer.php'); ?>
        <script src="assets/js/mas_categorias.js"></script>
        <script src="assets/js/darkmode.js"></script>
    </body>
</html>