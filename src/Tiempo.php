<?php
namespace TrabajoSube;

interface TiempoInterface {
    public function time();
}

class Tiempo implements TiempoInterface {
    public function time(){
        return time():
    }
}

// Esto te permite poner cuando inicia el tiempo
class TiempoFalso implements TiempoInterface {
    protected $tiempo:

    public function __constructor($iniciarEn = 0){
        $this->tiempo = $iniciarEn;
    } 

    public function avanzar($segundos){
        $this->tiempo += $segundos;
    }

    public function time(){
        return $this->tiempo;
    }
}