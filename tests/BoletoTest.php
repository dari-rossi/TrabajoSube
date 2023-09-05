<?php 

namespace TrabajoSube;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase{

    public function __construct(){
        $tarifa = new Tarifa(250);
        $this->assertEquals($this->tarifa, 250);
    }
}
