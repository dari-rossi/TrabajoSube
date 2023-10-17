<?php 

namespace TrabajoSube;

use PHPUnit\Framework\TestCase;

class ColectivoRosarioTest extends TestCase{

    public function testHorario_franquicias(){
        $colectivo = new Colectivo_Rosario();

        $this->assertTrue($colectivo->horario_franquicias(1535563577));
        $this->assertFalse($colectivo->horario_franquicias(0));
    }

    public function testPagarCon(){
        $colectivo = new Colectivo_Rosario();

        $tarjeta = new Tarjeta(240);
        $tarjeta->usos_por_mes = 10;
        $colectivo->pagarCon($tarjeta,1535563577);
        $this->assertEquals($tarjeta->usos_por_mes, 11);
        $this->assertEquals($tarjeta->saldo, 120);
        $tarjeta->usos_por_mes = 34;
        $colectivo->pagarCon($tarjeta,1535563577);
        $this->assertEquals($tarjeta->usos_por_mes, 35);
        $this->assertEquals($tarjeta->saldo, 24);
        $tarjeta->usos_por_mes = 81;
        $colectivo->pagarCon($tarjeta,1535563577);
        $this->assertEquals($tarjeta->usos_por_mes, 82);
        $this->assertEquals($tarjeta->saldo, -66);

        $tarjeta = new FranquiciaCompletaJubilados(120);
        $colectivo->pagarCon($tarjeta,1535563577);
        $this->assertEquals($tarjeta->saldo, 120);
        $colectivo->pagarCon($tarjeta,1535563577);
        $this->assertEquals($tarjeta->saldo, 120);

        $tarjeta = new FranquiciaCompletaBEG(120);
        $tarjeta->usos_por_dia = 1;
        $colectivo->pagarCon($tarjeta,1535563577);
        $this->assertEquals($tarjeta->usos_por_dia, 2);
        $this->assertEquals($tarjeta->saldo, 120);
        $colectivo->pagarCon($tarjeta,1535563577);
        $this->assertEquals($tarjeta->saldo, 0);

        $tarjeta = new FranquiciaParcialMBEyU(120);
        $tarjeta->usos_por_dia = 2;
        $colectivo->pagarCon($tarjeta,1535563577);
        $this->assertEquals($tarjeta->usos_por_dia, 3);
        $this->assertEquals($tarjeta->saldo, 60);
        $this->assertFalse($colectivo->pagarCon($tarjeta,1535563577));
        $colectivo->pagarCon($tarjeta,1535563890);
        $this->assertEquals($tarjeta->usos_por_dia, 4);
        $this->assertEquals($tarjeta->saldo, 0);

    }

    public function testComprobar_tarjeta(){
        $colectivo = new Colectivo_Rosario();

        $tarjeta = new Tarjeta(120);
        $colectivo->comprobar_tarjeta($tarjeta,1535563577);
        $this->assertEquals($colectivo->tipo_tarjeta, 1);

        $tarjeta = new FranquiciaCompletaJubilados(120);
        $colectivo->comprobar_tarjeta($tarjeta,1535563577);
        $this->assertEquals($colectivo->tipo_tarjeta, 2);

        $tarjeta = new FranquiciaCompletaBEG(120);
        $tarjeta->usos_por_dia = 1;
        $colectivo->comprobar_tarjeta($tarjeta,1535563577);
        $this->assertEquals($colectivo->tipo_tarjeta, 3);
        $tarjeta->usos_por_dia = 3;
        $colectivo->comprobar_tarjeta($tarjeta,1535563577);
        $this->assertEquals($colectivo->tipo_tarjeta, 1);

        $tarjeta = new FranquiciaParcialMBEyU(120);
        $tarjeta->usos_por_dia = 1;
        $colectivo->comprobar_tarjeta($tarjeta,1535563577);
        $this->assertEquals($colectivo->tipo_tarjeta, 4);
        $tarjeta->usos_por_dia = 5;
        $colectivo->comprobar_tarjeta($tarjeta,1535563577);
        $this->assertEquals($colectivo->tipo_tarjeta, 1);
        
        $tarjeta = new FranquiciaCompletaJubilados(120);
        $colectivo->comprobar_tarjeta($tarjeta,0);
        $this->assertEquals($colectivo->tipo_tarjeta, 1);

    }
    public function testPagar_comun(){
        $colectivo = new Colectivo_Rosario();
        
        $tarjeta = new Tarjeta(120);
        $colectivo->pagar_comun($tarjeta,0);
        $this->assertEquals($tarjeta->saldo,0);
        $colectivo->pagar_comun($tarjeta,0);
        $this->assertEquals($tarjeta->saldo,-120);
        $this->assertFalse($colectivo->pagar_comun($tarjeta,0));

    }
    public function testPagar_jubilado(){
        $colectivo = new Colectivo_Rosario();
        
        $tarjeta = new Tarjeta(120);
        $colectivo->pagar_jubilado($tarjeta,0);
        $this->assertEquals($tarjeta->saldo,120);
        $colectivo->pagar_jubilado($tarjeta,0);
        $this->assertEquals($tarjeta->saldo,120);
    }
    public function testPagar_beg(){
        $colectivo = new Colectivo_Rosario();
        
        $tarjeta = new Tarjeta(120);
        $colectivo->pagar_beg($tarjeta,0);
        $this->assertEquals($tarjeta->saldo,120);
        $colectivo->pagar_beg($tarjeta,0);
        $this->assertEquals($tarjeta->saldo,120);
    }
    public function testPagar_parcial(){
        $colectivo = new Colectivo_Rosario();
        
        $tarjeta = new Tarjeta(120);
        $colectivo->pagar_parcial($tarjeta,0);
        $this->assertEquals($tarjeta->saldo,60);
        $colectivo->pagar_parcial($tarjeta,0);
        $this->assertEquals($tarjeta->saldo,0);
        $colectivo->pagar_parcial($tarjeta,0);
        $colectivo->pagar_parcial($tarjeta,0);
        $colectivo->pagar_parcial($tarjeta,0);
        $this->assertFalse($colectivo->pagar_parcial($tarjeta,0));
    }
}