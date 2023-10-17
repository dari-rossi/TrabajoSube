<?php
namespace TrabajoSube;

class FranquiciaCompletaBEG extends Tarjeta{
  public $tipo = "TarjetaBEG";
  public $usos_por_dia = 0;
  public $dia_actual;
  public $id = 3;

  public function actualizar_dia($tiempo){
    $fecha = date("j F Y", $tiempo);
    if ($this->dia_actual != $fecha){
        $this->dia_actual = $fecha;
        $this->usos_por_dia = 0;
      }
  }

  public function __construct($saldo=0){
    $this->saldo = $saldo;
    $this->dia_actual = date("j F Y");
  }
}