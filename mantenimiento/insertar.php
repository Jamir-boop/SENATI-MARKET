<?php
    include('../assets/php/conexion.php');
    include('../assets/php/generador_pk.php');
    include('../assets/php/pedir_datos.php');
    $fecha = date('Y-m-d');
    if (isset($_GET['aviso'])) {
      echo '<script>alert("Por favor ingresa datos"); </script>';
    }
    elseif(isset($_GET['tabla'])) {
        $tabla = $_GET['tabla'];
        switch ($tabla) {
            case 'boleta':
                $ultima_fila = new pedir_datos('boleta', 'codigoBoleta');
                $ultima_fila = $ultima_fila->last_row();
                $codigoBoleta = new generador_pk($ultima_fila);
                $codigoBoleta = $codigoBoleta->generar();

                $codigoCompra = $_POST['codigoCompra'];
                $nombreCliente = $_POST['nombreCliente'];
                $totalPago = $_POST['totalPago'];
                $descripcionCompra = $_POST['descripcionCompra'];

                $conexion = conexion::conectar();
                $sentencia = $conexion->prepare(
                    "INSERT INTO boleta (codigoBoleta, codigoCompra, nombreCliente, totalPago, descripcionCompra, fechaPago) VALUES (?,?,?,?,?,?)"
                );
                try {
                  $resultado = $sentencia->execute([$codigoBoleta, $codigoCompra, $nombreCliente, $totalPago, $descripcionCompra, $fecha]);
                } catch(PDOException $e) {
                  conexion::desconectar();
                  header('Location: mantenimiento_index.php?tabla='.$tabla.'&aviso');
                  break;
                }
                if($sentencia == TRUE) {
                   conexion::desconectar();
                   header('Location: mantenimiento_index.php?tabla='.$tabla);
                } else {
                   echo "Ocurrió un error";
                }
                break;

            case 'carrito':
                $ultima_fila = new pedir_datos('boleta', 'codigoBoleta');
                $ultima_fila = $ultima_fila->last_row();
                $codigoBoleta = new generador_pk($ultima_fila);
                $codigoBoleta = $codigoBoleta->generar();

                $estadoCompra = $_POST['estadoCompra'];
                $codigoCliente = $_POST['codigoCliente'];
                $codigoProd = $_POST['codigoProd'];
                $cantidadProd = $_POST['cantidadProd'];

                $conexion = conexion::conectar();
                $sentencia = $conexion->prepare(
                    "INSERT INTO boleta (codigoBoleta, estadoCompra, codigoCliente, codigoProd, cantidadProd) VALUES (?,?,?,?,?)"
                );
                try {
                  $resultado = $sentencia->execute([$codigoBoleta, $estadoCompra, $codigoCliente, $codigoProd, $cantidadProd]);
                } catch(PDOException $e) {
                  conexion::desconectar();
                  header('Location: mantenimiento_index.php?tabla='.$tabla.'&aviso');
                  break;
                }
                if($sentencia == TRUE) {
                   conexion::desconectar();
                   header('Location: mantenimiento_index.php?tabla='.$tabla);
                } else {
                   echo "Ocurrió un error";
                }
                break;

            case 'cliente':
                $ultima_fila = new pedir_datos('boleta', 'codigoBoleta');
                $ultima_fila = $ultima_fila->last_row();
                $codigoBoleta = new generador_pk($ultima_fila);
                $codigoBoleta = $codigoBoleta->generar();

                $estadoCliente = $_POST['estadoCliente'];
                $nombreCliente = $_POST['nombreCliente'];
                $correoCliente = $_POST['correoCliente'];
                $claveCliente = $_POST['claveCliente'];

                $conexion = conexion::conectar();
                $sentencia = $conexion->prepare(
                    "INSERT INTO boleta (codigoBoleta, estadoCliente, nombreCliente, correoCliente, claveCliente, fechaCliente) VALUES (?,?,?,?,?,?)"
                );
                try {
                  $resultado = $sentencia->execute([$codigoBoleta, $estadoCompra, $codigoCliente, $codigoProd, $cantidadProd]);
                } catch(PDOException $e) {
                  conexion::desconectar();
                  header('Location: mantenimiento_index.php?tabla='.$tabla.'&aviso');
                  break;
                }
                if($sentencia == TRUE) {
                   conexion::desconectar();
                   header('Location: mantenimiento_index.php?tabla='.$tabla);
                } else {
                   echo "Ocurrió un error";
                }
                break;
            case 'producto':
                $ultima_fila = new pedir_datos('boleta', 'codigoBoleta');
                $ultima_fila = $ultima_fila->last_row();
                $codigoBoleta = new generador_pk($ultima_fila);
                $codigoBoleta = $codigoBoleta->generar();

                $categoriaProd = $_POST['categoriaProd'];
                $nombreProd = $_POST['nombreProd'];
                $precioProd = $_POST['precioProd'];
                $descripcionProd = $_POST['descripcionProd'];
                $unidadesProd = $_POST['unidadesProd'];

                $conexion = conexion::conectar();
                $sentencia = $conexion->prepare(
                    "INSERT INTO boleta (codigoBoleta, categoriaProd, nombreProd, precioProd, descripcionProd, unidadesProd) VALUES (?,?,?,?,?,?)"
                );
                try {
                  $resultado = $sentencia->execute([$codigoBoleta, $estadoCompra, $codigoCliente, $codigoProd, $cantidadProd]);
                } catch(PDOException $e) {
                  conexion::desconectar();
                  header('Location: mantenimiento_index.php?tabla='.$tabla.'&aviso');
                  break;
                }
                if($sentencia == TRUE) {
                   conexion::desconectar();
                   header('Location: mantenimiento_index.php?tabla='.$tabla);
                } else {
                   echo "Ocurrió un error";
                }
                break;
            default:
                echo "error";
        }

    }
