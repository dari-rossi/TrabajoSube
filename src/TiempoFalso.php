<?php
namespace TrabajoSube;

class TiempoFalso implements TiempoInterface {
    protected $tiempo;

    public function __constructor($iniciarEn = 0){
        $this->tiempo = $iniciarEn;
    } 

    public function avanzar($segundos){
        $this->tiempo += $segundos;
    }

    public function time(){
        return $this->tiempo;
    }

    private function horario_franquicias(){
        $diaSemana = date('N', $this->tiempo);
        $hora = date('H', $this->tiempo);
        if ($diaSemana >= 1 && $diaSemana <= 5 && $hora >= 6 && $hora < 22) {
            return true;
        }
        else{
            return false;
        }
    }

}
