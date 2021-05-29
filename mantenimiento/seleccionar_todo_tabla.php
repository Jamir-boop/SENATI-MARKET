<?php
    include_once('../assets/php/clase_mantenimiento.php');
    include_once('../assets/php/conexion.php');
    //tabla selecion todo
    $conexion = conexion::conectar();
    $query = $conexion->prepare('SELECT * FROM '.$tabla);
    $query->execute();
    $result = $query->fetchAll();
    switch ($tabla) {
        case 'boleta':?>
            <table>
              <tr>
                <?php for($i=0; $i<sizeof($result_columnas); $i++) { ?>
                <td><?php echo $result_columnas[$i]; ?></td>
                <?php } ?>
              </tr>
              <?php foreach($result as $row) { ?>
              <tr>
                <td><?php echo $row[$result_columnas[0]]; ?></td>
                <td><?php echo $row[$result_columnas[1]]; ?></td>
                <td><?php echo $row[$result_columnas[2]]; ?></td>
                <td><?php echo $row[$result_columnas[3]]; ?></td>
                <td><?php echo $row[$result_columnas[4]]; ?></td>
                <td><?php echo $row[$result_columnas[5]]; ?></td>
                <td><a href="editar.php?id=<?php echo $row[$result_columnas[0]].'&tabla='.$tabla; ?>">Editar</td>
                <td><a href="eliminar.php?id=<?php echo $row[$result_columnas[0]].'&tabla='.$tabla; ?>">Eliminar</td>
              </tr>
            <?php } break; ?>
            </table>
            <?php
            case 'carrito':?>
            <table>
              <tr>
                <?php for($i=0; $i<sizeof($result_columnas); $i++) { ?>
                <td><?php echo $result_columnas[$i]; ?></td>
                <?php } ?>
              </tr>
              <?php foreach($result as $row) { ?>
              <tr>
                <td><?php echo $row[$result_columnas[0]]; ?></td>
                <td><?php echo $row[$result_columnas[1]]; ?></td>
                <td><?php echo $row[$result_columnas[2]]; ?></td>
                <td><?php echo $row[$result_columnas[3]]; ?></td>
                <td><?php echo $row[$result_columnas[4]]; ?></td>
                <td><a href="editar.php?id=<?php echo $row[$result_columnas[0]].'&tabla='.$tabla; ?>">Editar</td>
                <td><a href="eliminar.php?id=<?php echo $row[$result_columnas[0]].'&tabla='.$tabla; ?>">Eliminar</td>
              </tr>
            <?php } break; ?>
            </table>
            <?php
            case 'cliente':?>
            <table>
              <tr>
                <?php for($i=0; $i<sizeof($result_columnas); $i++) { ?>
                <td><?php echo $result_columnas[$i]; ?></td>
                <?php } ?>
              </tr>
              <?php foreach($result as $row) { ?>
              <tr>
                <td><?php echo $row[$result_columnas[0]]; ?></td>
                <td><?php echo $row[$result_columnas[1]]; ?></td>
                <td><?php echo $row[$result_columnas[2]]; ?></td>
                <td><?php echo $row[$result_columnas[3]]; ?></td>
                <td><?php echo $row[$result_columnas[4]]; ?></td>
                <td><?php echo $row[$result_columnas[5]]; ?></td>
                <td><a href="editar.php?id=<?php echo $row[$result_columnas[0]].'&tabla='.$tabla; ?>">Editar</td>
                <td><a href="eliminar.php?id=<?php echo $row[$result_columnas[0]].'&tabla='.$tabla; ?>">Eliminar</td>
              </tr>
            <?php } break; ?>
            </table>
            <?php
            case 'producto':?>
            <table>
              <tr>
                <?php for($i=0; $i<sizeof($result_columnas); $i++) { ?>
                <td><?php echo $result_columnas[$i]; ?></td>
                <?php } ?>
              </tr>
              <?php foreach($result as $row) { ?>
              <tr>
                <td><?php echo $row[$result_columnas[0]]; ?></td>
                <td><?php echo $row[$result_columnas[1]]; ?></td>
                <td><?php echo $row[$result_columnas[2]]; ?></td>
                <td><?php echo $row[$result_columnas[3]]; ?></td>
                <td><?php echo $row[$result_columnas[4]]; ?></td>
                <td><?php echo $row[$result_columnas[5]]; ?></td>
                <td><?php echo $row[$result_columnas[6]]; ?></td>
                <td><?php echo $row[$result_columnas[7]]; ?></td>
                <td><a href="editar.php?id=<?php echo $row[$result_columnas[0]].'&tabla='.$tabla; ?>">Editar</td>
                <td><a href="eliminar.php?id=<?php echo $row[$result_columnas[0]].'&tabla='.$tabla; ?>">Eliminar</td>
              </tr>
            <?php } break; ?>
            </table>
    <?php
            default:
              echo "error";
      }
