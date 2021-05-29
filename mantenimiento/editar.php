<?php
    include('../assets/php/conexion.php');
    $id = $_GET['id'];
    $tabla = $_GET['tabla'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="EditarProceso.php" method="POST">
      <?php
        switch($tabla){
          case 'boleta':
            $conexion = conexion::conectar();
            $sent = $conexion->prepare("SELECT * FROM boleta WHERE codigoBoleta=?");
            $sent->execute([$id]);
            $clint = $sent->fetch();
            ?>
            <table>
                <tr>
                    <td>Código de Boleta</td>
                    <td><input type="text" name="01" value="<?php echo $clint["codigoBoleta"]; ?>"></td>
                    <td><input type="text" name="tabla" value="<?php echo $tabla; ?>" hidden readonly></td>
                </tr>
                <tr>
                    <td>Nombre del cliente</td>
                    <td><input type="text" name="02" value="<?php echo $clint["nombreCliente"]; ?>"></td>
                </tr>
                <tr>
                    <td>Total de Pago</td>
                    <td><input type="text" name="03" value="<?php echo $clint["totalPago"]; ?>"></td>
                </tr>
                <tr>
                    <td>Descripción de Producto</td>
                    <td><input type="text" name="04" value="<?php echo $clint["descripcionCompra"]; ?>"></td>
                </tr>
                <tr>
                    <td><a href='mantenimiento_index.php?tabla=boleta'>Cancelar</a></td>
                    <td><input type="submit" value="Editar"></td>
                </tr>
            </table>
            <?php
            break;
          case 'carrito':
            $conexion = conexion::conectar();
            $sent = $conexion->prepare("SELECT * FROM carrito WHERE codigoCompra=?");
            $sent->execute([$id]);
            $clint = $sent->fetch();
            ?>
            <table>
                <tr>
                    <td>Código de Compra</td>
                    <td><input type="text" name="01" value="<?php echo $clint["codigoCompra"]; ?>"></td>
                    <td><input type="text" name="tabla" value="<?php echo $tabla; ?>" hidden readonly></td>
                </tr>
                <tr>
                    <td>Código de Cliente</td>
                    <td><input type="text" name="02" value="<?php echo $clint["codigoCliente"]; ?>"></td>
                </tr>
                <tr>
                    <td>Código de Producto</td>
                    <td><input type="text" name="03" value="<?php echo $clint["codigoProd"]; ?>"></td>
                </tr>
                <tr>
                    <td>Cantidad de Producto</td>
                    <td><input type="text" name="04" value="<?php echo $clint["cantidadProd"]; ?>"></td>
                </tr>
                <tr>
                    <td><a href='mantenimiento_index.php?tabla=carrito'>Canelar</a></td>
                    <td><input type="submit" value="Editar"></td>
                </tr>
            </table>
            <?php
            break;
          case 'cliente':
            $conexion = conexion::conectar();
            $sent = $conexion->prepare("SELECT * FROM cliente WHERE codigoCliente=?");
            $sent->execute([$id]);
            $clint = $sent->fetch();
            ?>
            <table>
                <tr>
                    <td>Código de Cliente</td>
                    <td><input type="text" name="01" value="<?php echo $clint["codigoCliente"]; ?>"></td>
                    <td><input type="text" name="tabla" value="<?php echo $tabla; ?>" hidden readonly></td>
                </tr>
                <tr>
                    <td>Nombre de Cliente</td>
                    <td><input type="text" name="02" value="<?php echo $clint["nombreCliente"]; ?>"></td>
                </tr>
                <tr>
                    <td>Correo Electrónico</td>
                    <td><input type="text" name="03" value="<?php echo $clint["correoCliente"]; ?>"></td>
                </tr>
                <tr>
                    <td>Contraseña </td>
                    <td><input type="text" name="04" value="<?php echo $clint["claveCliente"]; ?>"></td>
                </tr>
                <tr>
                    <td><a href='mantenimiento_index.php?tabla=cliente'>Canelar</a></td>
                    <td><input type="submit" value="Editar"></td>
                </tr>
            </table>
            <?php
            break;
          case 'producto':
          $conexion = conexion::conectar();
          $sent = $conexion->prepare("SELECT * FROM producto WHERE codigoProd=?");
          $sent->execute([$id]);
          $clint = $sent->fetch();
            ?>
            <table>
                <tr>
                    <td>Código </td>
                    <td><input type="text" name="01" value="<?php echo $clint["codigoProd"]; ?>"></td>
                    <td><input type="text" name="tabla" value="<?php echo $tabla; ?>" hidden readonly></td>
                </tr>
                <tr>
                    <td>Categoría </td>
                    <td><input type="text" name="02" value="<?php echo $clint["categoriaProd"]; ?>"></td>
                </tr>
                <tr>
                    <td>Nombre </td>
                    <td><input type="text" name="03" value="<?php echo $clint["nombreProd"]; ?>"></td>
                </tr>
                <tr>
                    <td>Precio </td>
                    <td><input type="text" name="04" value="<?php echo $clint["precioProd"]; ?>"></td>
                </tr>
                <tr>
                    <td>Cantidad </td>
                    <td><input type="text" name="05" value="<?php echo $clint["unidadesProd"]; ?>"></td>
                </tr>
                <tr>
                    <td><a href='mantenimiento_index.php?tabla=producto'>Canelar</a></td>
                    <td><input type="submit" value="Editar"></td>
                </tr>
            </table>
            <?php
            break;
        }
      ?>
    </form>
</body>
</html>
