<?php
namespace TrabajoSube;
class Boleto{
    public $tarifa;
    
    public function __construct($tarifa){
        $this->tarifa = $tarifa;
    }
}

