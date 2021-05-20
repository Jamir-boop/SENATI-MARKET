<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TEST</title>
</head>
<body style="background: #262626; color: #FFF; font-size: 2rem;">
<?php
    foreach (glob("assets/php/*.php") as $archivo){
        include_once($archivo);
    }

    $ob = new pedir_datos("cliente", "CLI00018" );
    $ob = $ob->get_datos();

    echo $ob[0][2];
?>

</body>
</html>