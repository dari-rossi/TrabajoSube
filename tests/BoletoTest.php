<?php 

namespace TrabajoSube;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase{

    public function test__construct(){
        $boleto = new Boleto(250);
        $this->assertEquals($boleto->tarifa, 250);
    }
}
