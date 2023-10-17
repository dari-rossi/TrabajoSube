<?php 

namespace TrabajoSube;

use PHPUnit\Framework\TestCase;

class FranquiciaParcialMBEyUTest extends TestCase{
  
    public function test__construct(){
        $tarjeta = new FranquiciaParcialMBEyU(120);
        $dia_actual_test = date ("j F Y");
        $this->assertEquals($tarjeta->saldo, 120);
        $this->assertEquals($dia_actual_test, $tarjeta->dia_actual);
    }

    public function testActualizar_dia(){
        $tarjeta = new FranquiciaParcialMBEyU(120);
        $colectivo = new Colectivo_Rosario();
        $dia_actual_test = date("j F Y");
        
        $colectivo->pagarCon($tarjeta, $tiempo);
        $this->assertEqual($tarjeta->usos_por_dia, 1);

        $colectivo->pagarCon($tarjeta, 0);
        $this->assertEqual($tarjeta->usos_por_dia, 0);
    }

}