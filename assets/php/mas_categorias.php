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
