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

        $obj = new Conexion();
        $con = $obj->conectar();
        $query = $con->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        $obj->desconectar();

        return $result[0];
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
    }
}