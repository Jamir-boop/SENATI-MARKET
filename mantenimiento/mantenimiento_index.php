<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/sty_mantenimiento.css" />
    <?php
    include_once('../assets/php/conexion.php');
    include_once('../assets/php/clase_mantenimiento.php');
    ?>
    <title>Mantenimiento</title>
</head>
<body>
    <div class="contenedor">
        <div class="contenedor_botones">
    <?php
      //REVISAR AVISOS
      if (isset($_GET['aviso'])) {
        echo '<script>alert("Agregar más datos a carrito"); </script>';
      }

      //MOSTRAR TABLAS
        $sql = 'SHOW TABLES;';
        $conexion = conexion::conectar();
        $query = $conexion->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();

        for($i=0; $i<sizeof($result); $i++) {
            ?>
            <div class="crud">
                <a class="<?= $result[$i]['Tables_in_senatimarketdbs']; ?>" href="mantenimiento_index.php?tabla=<?= $result[$i]['Tables_in_senatimarketdbs']; ?>"><?= $result[$i]['Tables_in_senatimarketdbs']; ?></a><br>
            </div>
            <?php
        } ?>
            <div>
                <img class="img_crud" src="../assets/css/crudmantenimiento.jpg" alt="">
            </div>
        </div>
    </div>
        <?php
        if(isset($_GET['tabla'])) {
            $tabla = $_GET['tabla'];
            $objeto_tabla = new mantenimiento($tabla);
            $result_columnas = $objeto_tabla->nombrar_columnas();
            //echo json_encode($result);
    ?>
    <form action="insertar.php?tabla=<?php echo $tabla; ?>" method="POST">
        <table>
            <tr>
            <?php
            //Primera Fila
            for($i=0; $i <sizeof($result_columnas); $i++) {
            ?>
                <td><?php echo $result_columnas[$i]; ?></td>
                <?php
            }
            ?>
            </tr>
            <tr>
            <?php
            //Cuadros de Input
            for($i=0; $i <sizeof($result_columnas); $i++) {
                ?>
                <td><input type="text" name="<?php echo $result_columnas[$i]; ?>"></td>
                <?php
            }
            ?>
            </tr>
            <tr>
                <td><input type="submit" value="Agregar"></td>
            </tr>
            <?php
            conexion::desconectar();
            require_once('seleccionar_todo_tabla.php');
        }
        ?>
        </table>
    </form>
</body>
</html>
