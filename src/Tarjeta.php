<?php
namespace TrabajoSube;
class Tarjeta{
    protected $saldo;
    
    public function __construct($linea){
        $this->linea = $linea;
    }
    
    //    Funcion de ejemplo para test
    public function getLinea(){
        return $this->linea;
    }
}
