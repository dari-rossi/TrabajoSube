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
        $colectivo = new Colectivo();
        $tarjeta->cargar_tarjeta(200);

        $colectivo->pagarCon($tarjeta);
        $tarjeta->acreditar_saldo($this->saldo);
        $this->assertEquals($tarjeta->saldo_acumulado, 80);

        $colectivo->pagarCon($tarjeta);
        $tarjeta->acreditar_saldo($this->saldo);
        $this->assertEquals($tarjeta->saldo_acumulado, 0);
    
    }
    
    public function test__construct(){
        $tarjeta = new Tarjeta(96);
        $this->assertEquals($tarjeta->saldo, 96);
    }
}