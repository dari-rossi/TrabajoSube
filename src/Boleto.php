<?php
namespace TrabajoSube;
class Boleto{
    protected $tarifa;
    
    public function __construct($linea){
        $this->linea = $linea;
    }
    
    //    Funcion de ejemplo para test
    public function getLinea(){
        return $this->linea;
    }
}
