<?php
namespace TrabajoSube;
class Tarjeta{
    protected $saldo;
    
    public function __construct($saldo=0){
        $this->saldo = $saldo;
    }
}
