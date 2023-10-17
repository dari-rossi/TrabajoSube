<?php
namespace TrabajoSube;

class FranquiciaParcialMBEyU extends Tarjeta{
  public $ultimo_boleto = 0;
  public $tipo = "TarjetaParcial";
  public $usos_por_dia = 0;
  public $id = 4;

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