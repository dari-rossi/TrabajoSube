<?php 

namespace TrabajoSube;

use PHPUnit\Framework\TestCase;

class FranquiciaCompletaJubiladosTest extends TestCase{
    public function testCargar_tarjeta(){
        $tarjeta = new FranquiciaCompletaJubilados(0);
        $tarjeta->cargar_tarjeta(4000);
        $this->assertEquals($tarjeta->saldo, 4000);
        $tarjeta->cargar_tarjeta(4000);
        $this->assertEquals($tarjeta->saldo, 6600);
        $this->assertEquals($tarjeta->saldo_acumulado, 1400);
        $this->assertFalse($tarjeta->cargar_tarjeta(263));
      }
      public function testAcreditar_saldo(){
        $tarjeta = new FranquiciaCompletaJubilados(6600);
        $colectivo = new Colectivo_Rosario();

        $tarjeta->cargar_tarjeta(200);

        $colectivo->pagarCon($tarjeta,0);
        $tarjeta->acreditar_saldo($this->saldo);
        $this->assertEquals($tarjeta->saldo_acumulado, 80);

        $colectivo->pagarCon($tarjeta,0);
        $tarjeta->acreditar_saldo($this->saldo);
        $this->assertEquals($tarjeta->saldo_acumulado, 0);
    
    }
    public function test__construct(){
        $tarjeta = new FranquiciaCompletaJubilados(96);
        $this->assertEquals($tarjeta->saldo, 96);
    }
}