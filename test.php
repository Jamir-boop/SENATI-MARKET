<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body style="background: #262626; color: #FFF; font-size: 3rem;">
<?php
    foreach (glob("assets/php/*.php") as $archivo){
        include_once($archivo);
    }

    $codigo_producto = "PRO00028";
    $sql = 'SELECT `imgSecProd` FROM producto WHERE `codigoProd`= :cod;';

    $objeto = new Conexion();
    $conexion = $objeto->conectar();
    $query = $conexion->prepare($sql);
    $query->bindValue(":cod", $codigo_producto);
    $query->execute();
    $result = $query->fetch();
    $str_imagenes = explode("+", $result[0]);
    foreach($str_imagenes as $img){
?>
    <img alt="" src="<?php echo $img; ?>" id="imagenSec">
<?php
    }
    $objeto->desconectar();

?>

</body>
</html>