<?php 

namespace TrabajoSube;

use PHPUnit\Framework\TestCase;

class ColectivoInterUTest extends TestCase{

    public function testPagarCon(){
        $colectivo = new Colectivo_InterU();

        $tarjeta = new Tarjeta(184);
        $colectivo->pagarCon($tarjeta,1535563577);
        $this->assertEquals($tarjeta->saldo,0);
    }
}