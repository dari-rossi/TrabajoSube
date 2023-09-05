<?php 

namespace TrabajoSube;

use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase{

    public function testCargar_tarjeta(){
      $tarjeta = new Tarjeta(0);
      $tarjeta->cargarTarjeta(263);
      $tarjeta->cargarTarjeta(300);
      $this->assertEquals($tarjeta->saldo, 300);
    }
}