<?php 

namespace TrabajoSube;

use PHPUnit\Framework\TestCase;

class TiempoFalsoTest extends TestCase{

  public function testAvanzar(){
      $tiempoFalso = new TiempoFalso(0);
      $tiempoFalso->avanzar(7);
      $this->assertEquals($tiempoFalso->tiempo, 7);
    }
  
  public function test__construct(){
    $tiempoFalso = new TiempoFalso(0);
    $this->assertEquals($tiempoFalso->tiempo,0);
  }

}
