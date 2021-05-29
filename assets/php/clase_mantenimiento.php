<?php
    class mantenimiento {
        private $tabla;
        private $result;
        public function __construct($tabla_seleccion){
            $this->tabla = $tabla_seleccion;
            $this->pedir_columnas();
        }

        private function redireccion_tabla() {
            switch ($this->tabla) {
                case 'boleta':
                    return "Boleta ok";
                case 'producto':
                    return "Producto ok";
                case 'cliente':
                    return "Cliente ok";
                case 'carrito':
                    return "Carrito ok";
                default:
                    return "Tabla desconocida";
            }
        }

        private function pedir_columnas() {
            $sql = 'DESCRIBE '.$this->tabla;
            $objeto = new conexion();
            $conexion = $objeto->conectar();
            $query = $conexion->prepare($sql);
            $query->execute();
            $this->result = $query->fetchAll();
        }

        public function nombrar_columnas() {
            $array_peticion = array();
            for ($i=0; $i<count($this->result); $i++) {
                array_push($array_peticion, $this->result[$i]['Field']);
            }
            return $array_peticion;
        }
    }
