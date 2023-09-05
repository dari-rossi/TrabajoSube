<?php 

namespace TrabajoSube;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase{

    public function testPagarCon(){
        $cole = new Colectivo();
        $tarjeta = new Tarjeta(120);
        $cole->pagarCon($tarjeta);
        $this->assertEquals($tarjeta->saldo, 0);
    }
}
