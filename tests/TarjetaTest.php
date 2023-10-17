<?php 

namespace TrabajoSube;

use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase{

    public function testCargar_tarjeta(){
      $tarjeta = new Tarjeta(0);
      $tarjeta->cargar_tarjeta(4000);
      $this->assertEquals($tarjeta->saldo, 4000);
      $tarjeta->cargar_tarjeta(4000);
      $this->assertEquals($tarjeta->saldo, 6600);
      $this->assertEquals($tarjeta->saldo_acumulado, 1400);
      $this->assertFalse($tarjeta->cargar_tarjeta(263));
    }
    
    public function testAcreditar_saldo(){
    
        $tarjeta = new Tarjeta(6600);
        $colectivo = new Colectivo_Rosario();
        $tarjeta->cargar_tarjeta(200);

        $colectivo->pagarCon($tarjeta,0);
        $tarjeta->acreditar_saldo($this->saldo);
        $this->assertEquals($tarjeta->saldo_acumulado, 80);

        $colectivo->pagarCon($tarjeta,0);
        $tarjeta->acreditar_saldo($this->saldo);
        $this->assertEquals($tarjeta->saldo_acumulado, 0);
    
    }

    public function testActualizar_mes(){
        $tarjeta = new FranquiciaCompletaBEG(120);
        $colectivo = new Colectivo_Rosario();
        $mes_actual_test = date("F Y");
        
        $colectivo->pagarCon($tarjeta, $tiempo);
        $this->assertEqual(usos_por_mes, 1);

        $colectivo->pagarCon($tarjeta, 0);
        $this->assertEqual(usos_por_mes, 0);
    }
    
    public function test__construct(){
        $tarjeta = new Tarjeta(96);
        $this->assertEquals($tarjeta->saldo, 96);
    }
}