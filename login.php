<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Inicia Sesión</title>
        
        <link type="text/css" rel="stylesheet" href="assets/css/reset.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/formulario.css" />

        <?php require_once('assets/php/conexion.php'); ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>

        <div class="fondo">

            <!-- LOADING SCR -->
            <div>
                <img alt="" src="assets/img/gif.gif" id="load-video">
                <script src="assets/js/loader.js"></script>
            </div>

            <!-- VIDEO DE FONDO -->
            <div>
                <video autoplay muted loop id="bg-video" >
                    <source src="assets/img/video.mp4" type="video/mp4">
                </video>
            </div>

            <div style="position: relative">
                <section class="general">
                    <article class="banner">
                        <img alt="" src="assets/img/delivery.png" />
                    </article>

                    <article class="formulario">
                        <h2 style="text-align: center; width: 100%">inicia sesión</h2>

                        <label style="text-align: center; width: 100%; color: red; font-size: 14px;" id="advice"></label>

                        <form action="" method="POST">
                            <div class="campo">
                                <label for="">correo electrónico</label>
                                <input type="mail" name="correoCliente" />
                            </div>


                            <div class="campo">
                                <label for="">contraseña</label>
                                <input type="password" name="claveCliente" />    
                            </div>


                            <button type="submit" name="login" >inicia sesión</button>
                        </form>
                    </article>
                </section>
            </div>
        </div>



        <script src="assets/js/formulario.js"></script>
        <?php

            if(isset($_POST["login"]) != null){
                //post
                $correo = $_POST["correoCliente"];
                $pass = $_POST["claveCliente"];

                //INSTANCIA
                $objeto = new conexion();

                //Guardo objeto que retorna el metodo conectar
                $conexion = $objeto->conectar();

                $sql = "SELECT * FROM cliente WHERE `correoCliente`='".$correo."' AND `claveCliente`='".$pass."'AND `estadoCliente`='1'";

                // Se hace la peticion SQL
                $query = $conexion->prepare($sql);
                $query->execute();
                $result = $query->fetch();

                if($result){
                    //redirecciona
                    header("Location: index.php");
                }else{
                    echo "<script src='assets/js/loginFailed.js'></script>";
                }
                    //CREACION DE COOKIES
//                    Cookie usuario_activo = new Cookie("correoCliente", request.getParameter("correoCliente"));
//                    response.addCookie( usuario_activo );
            }
        ?>
    </body>
</html>