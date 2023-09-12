<?php 

namespace TrabajoSube;

use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase{

    public function testCargar_tarjeta(){
      $tarjeta = new Tarjeta(0);
      $tarjeta->cargar_tarjeta(263);
      $tarjeta->cargar_tarjeta(4000);
      $tarjeta->cargar_tarjeta(4000);
      $this->assertEquals($tarjeta->saldo, 6600);
    }

    public function test__construct(){
        $tarjeta = new Tarjeta(96);
        $this->assertEquals($tarjeta->saldo, 96);
    }
}
