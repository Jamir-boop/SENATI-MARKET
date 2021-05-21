<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Registrar usuario</title>
        
        <link type="text/css" rel="stylesheet" href="assets/css/reset.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/formulario.css" />

        <?php require_once('assets/php/conexion.php'); ?>
        <?php require_once('assets/php/generador_pk.php'); ?>
        <?php require_once('assets/php/pedir_datos.php'); ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
        <div class="fondo">

            <!-- LOADING SCREEN -->
            <div>
                <img src="assets/img/gif.gif" id="load-video">
                <script src="assets/js/loader.js"></script>
            </div>
            
            <!-- INTENTO DE FONDO DE VIDEO -->
            <div>
                <video autoplay muted loop id="bg-video">
                    <source src="assets/img/video.mp4" type="video/mp4">
                </video>
            </div>
            <div style="position: relative">
                <section class="general">
                <article class="banner">
                    <img src="assets/img/tienda.png" />
                </article>

                <article class="formulario">
                    <h2>únete a path finding market</h2>

                        <form action="register.php" method="POST">
                        <div class="campo">
                            <label for="">nombre</label>
                            <input type="text" name="nombreCliente" placeholder="" required />    
                        </div>


                        <div class="campo">
                            <label for="">correo electrónico</label>
                            <input type="text" name="correoCliente" required/>    
                        </div>


                        <div class="campo">
                            <label for="">contraseña</label>
                            <input type="password" name="claveCliente" required/> 
                        </div>


                        <button type="submit" name="btnregistrar">registrar</button>
                    </form>
                </article>
                </section>
            </div>
        </div>
        <script src="assets/js/formulario.js"></script>
        <?php
            if(isset($_POST["btnregistrar"])) {
                //fecha
                $fecha = date("Y-m-d");

                // se obtiene ultima fila y se genera al ultimo cliente
                $ultima_fila = new pedir_datos("cliente");
                $ultima_fila = $ultima_fila->last_row();
                $codigo = new generador_pk($ultima_fila);
                $codigo = $codigo->generar();

                // OBTENCION DE VALORES
                $nombre = $_POST["nombreCliente"];
                $correo = $_POST["correoCliente"];
                $clave = $_POST["claveCliente"];

                try {
                    //INSTANCIA
                    $objeto = new conexion();

                    //Guardo objeto que retorna el metodo conectar
                    $conexion = conexion::conectar();

                    // Se hace la peticion SQL
                    $sql = "INSERT INTO cliente (codigoCliente, nombreCliente, correoCliente, claveCliente, fechaCliente)
                            VALUES (:codigo, :nombre, :correo, :clave, :fecha);";

                    $query = $conexion->prepare($sql);
                    $query->bindValue(":codigo", $codigo);
                    $query->bindValue(":nombre", $nombre);
                    $query->bindValue(":correo", $correo);
                    $query->bindValue(":clave", $clave);
                    $query->bindValue(":fecha", $fecha);
                    $rs = $query->execute();

                    if($rs){
                        conexion::desconectar();
                        header("Location: index.php");
                    }else{
                        echo "<script>alert('se produjo un error');</script>";
                    }

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
        ?>
    </body>
</html>