<?php

class get_last_row{
    private $tabla;
    private $columna;

    function __construct($tabla, $columna){
        $this->tabla = $tabla;
        $this->columna = $columna;
    }

    public function last_row(){
        $sql="SELECT `".$this->columna."` FROM `".$this->tabla."` ORDER BY `".$this->columna."` DESC LIMIT 1;";

        $con = conexion::conectar();
        $query = $con->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        conexion::desconectar();

        return $result;
    }

    public function get_columna(){
        switch($this->tabla){
            case "boleta";
                return "BOL";

            case "cliente";
                return "CLI";

            case "producto";
                return "PRO";

            case "carrito";
                return "COM";
        }
        return "columna indefinida";
    }
}