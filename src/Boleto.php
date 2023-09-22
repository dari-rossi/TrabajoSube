<?php
namespace TrabajoSube;
class Boleto{
    public $tarifa;
    public $saldo;

    public function __construct($tarifa , $saldo){
        $this->tarifa = $tarifa;
        $this->saldo = $saldo;
    }
}