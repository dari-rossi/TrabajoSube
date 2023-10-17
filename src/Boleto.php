<?php
namespace TrabajoSube;
class Boleto{
    public $tarifa;
    public $saldo;

    //fecha, tipo de tarjeta, linea de colectivo, total abonado, saldo de tarjeta, id tarjeta
    public function __construct($fecha,$tipo_de_tarjeta,$linea,$tarifa,$saldo,$id){
        $this->fecha = $fecha;
        $this->tipo_de_tarjeta = $tipo_de_tarjeta;
        $this->linea = $linea;
        $this->tarifa = $tarifa;
        $this->saldo = $saldo;
        $this->id = $id;
    }
}