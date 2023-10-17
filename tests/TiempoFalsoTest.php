<?php 

namespace TrabajoSube;

use PHPUnit\Framework\TestCase;

class TiempoFalsoTest extends TestCase{

  public function testAvanzar(){
      $tiempoFalso = new TiempoFalso(0);
      $tiempoFalso->avanzar(7);
      $this->assertEquals($tiempoFalso->time(), 7);
    }
}
