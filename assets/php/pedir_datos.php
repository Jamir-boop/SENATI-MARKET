<?php


class pedir_datos{
    private $tabla;
    private $fila;
    private $columna;

    function __construct($tabla, $fila=null, $columna=null){
        $this->tabla = $tabla;
        $this->fila = $fila;
        $this->columna = $columna;
    }

    private function get_pk(){
        switch ($this->tabla){
            case "producto";
                return "codigoProd";
            case "cliente";
                return "codigoCliente";
            case "carrito";
                return "codigoCompra";
            case "boleta";
                return "codigoBoleta";
        }
    }


    public function get_datos(){
        $sql = "SELECT " . $this->columna . " FROM " . $this->tabla . " WHERE " . $this->get_pk() . "='" . $this->fila . "' ;";
        if ($this->columna == null) {
            $sql = "SELECT * FROM " . $this->tabla . " WHERE " . $this->get_pk() . "='" . $this->fila . "' ;";
        }

        $con = conexion::conectar();
        $query = $con->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        conexion::desconectar();
        return $result;
    }

    public function last_row(){
        $sql="SELECT `".$this->get_pk()."` FROM `".$this->tabla."` ORDER BY `".$this->get_pk()."` DESC LIMIT 1;";

        $con = conexion::conectar();
        $query = $con->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        conexion::desconectar();

        return $result[0];
    }
}