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
    
    public function testAcreditar_saldo(){
    
        $tarjeta = new Tarjeta(6600);
        $tarjeta->cargar_tarjeta(1000);
        $tarjeta->acreditar_saldo(6500);
        $this->assertEquals($tarjeta->saldo_acumulado, 900);
        
        $tarjeta->cargar_tarjeta(1000);
        $tarjeta->acreditar_saldo(5600);
        $this->assertEquals($tarjeta->saldo_acumulado, 0);
    
    }
    
    public function test__construct(){
        $tarjeta = new Tarjeta(96);
        $this->assertEquals($tarjeta->saldo, 96);
    }
}
