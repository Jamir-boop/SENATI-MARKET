<?php

class get_tablas{
    function __construct(){
       $sql="SHOW TABLES;";

        $obj = new Conexion();
        $con = $obj->conectar();
        $query = $con->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $obj->desconectar();

        return $result;
    }
}