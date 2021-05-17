<?php
class generador_pk{
    private $cod_entrada;
    private $tabla;

    function __construct($entrada=NULL){
        $this->cod_entrada = $entrada;
        $this->tabla = substr($this->cod_entrada, 0, 3);
    }

    private function check_validez() {
        if($this->cod_entrada == NULL){
            $this->cod_entrada = "DEF00000";
            $this->tabla = substr($this->cod_entrada, 0, 3);
        }
        if(!strlen($this->cod_entrada) == 8){return false;}
        if(!1 === preg_match('~[0-9]~', $this->cod_entrada)){return false;}
        if(1 === preg_match('~[0-9]~', $this->tabla)){return false;}
        return true;
    }

    private function suma(){
        $numero = str_replace($this->tabla, "", $this->cod_entrada);
        $numero++;
        return $numero;

    }

    private function contador_ceros(){
        $contador = 0;

        $numero = str_replace($this->tabla, "", $this->cod_entrada);
        $array_numero = str_split($numero);

        //compara cada uno de los caracteres de la entrada
        foreach($array_numero as $item){
            if($item=="0"){$contador++;}
            else{break;}
        }

        //recojo suma
        if($this->suma() == 1 OR $this->suma() == 10 OR $this->suma() == 100 OR $this->suma() == 1000 OR $this->suma() == 10000){
            $contador--;
        }

        //retorna un string con la cantidad total de ceros a usar
        return str_repeat("0", $contador);
    }

    public function generar(){
        if($this->check_validez()) {
            return $this->tabla . $this->contador_ceros() . $this->suma();
        }else{
            return "codigo ingresado invalido";
        }
    }
}