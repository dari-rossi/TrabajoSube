<?php
namespace TrabajoSube;
class Tarjeta{
    public $cargas_aceptadas = [150, 200, 250, 300, 350, 400, 450, 500, 600, 700, 800, 900, 1000, 1100, 1200, 1300, 1400, 1500, 2000, 2500, 3000, 3500, 4000];
    private $limite_saldo = 6600;
    public $saldo_acumulado = 0;
    public $saldo;
    public $usos_por_mes;
    public $id;

    public function cargar_tarjeta($nueva_carga){
        if(in_array($nueva_carga , $this->cargas_aceptadas)){
            if(($this->saldo + $nueva_carga) <= $this->limite_saldo){
            echo "Su saldo se ha cargado correctamente ";
            echo "Su nuevo saldo es de " . $this->saldo;
            $this->saldo += $nueva_carga;
            }
            else{
                $this->saldo_acumulado += $this->saldo + $nueva_carga - $this->limite_saldo;
                $this->saldo = $this->limite_saldo;
                echo "Su saldo se ha cargado correctamente ";
                echo "Su nuevo saldo es de " . $this->saldo;
                echo "Su saldo acumulado es de " . $this->saldo_acumulado;
                }
        }
        else{
            echo "Error al cargar el monto ingresado";
            echo "Verifique que el monto ingresado este dentro de los montos aceptados";
            echo "Su saldo es de " . $this->saldo;
        }
    }

    public function acreditar_saldo($saldo){
        if($this->saldo + $this->saldo_acumulado > $this->limite_saldo){
            $this->saldo_acumulado -= ($this->limite_saldo - $this->saldo); 
            $this->saldo = $this->limite_saldo;
        }
        else{
            $this->saldo += $this->saldo_acumulado;
            $this->saldo_acumulado = 0;
       }
    }

    public function __construct($saldo=0){
        $this->saldo = $saldo;
    }
}