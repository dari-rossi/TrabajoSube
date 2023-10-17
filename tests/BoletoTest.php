<?php 

namespace TrabajoSube;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase{
//fecha, tipo de tarjeta, linea de colectivo, total abonado, saldo de tarjeta, id tarjeta
    public function test__construct(){
        
        $boleto = new Boleto(111 , "Tarjeta" , "Rosario", 120 , 320 , 1);
        
        $this->assertEquals($boleto->fecha, 111);
        $this->assertEquals($boleto->tipo, "Tarjeta");
        $this->assertEquals($boleto->linea, "Rosario");
        $this->assertEquals($boleto->tarifa, 120);
        $this->assertEquals($boleto->saldo, 320);
        $this->assertEquals($boleto->id, 1);
    }
}
