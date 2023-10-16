<?php
namespace TrabajoSube;
class Boleto{
    public $tarifa;
    public $saldo;

    //fecha, tipo de tarjeta, linea de colectivo, total abonado, saldo de tarjeta, id tarjeta
    public function __construct($tarifa , $saldo){
        $this->tarifa = $tarifa;
        $this->saldo = $saldo;
    }
}