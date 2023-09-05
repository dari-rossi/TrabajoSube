<?php
namespace TrabajoSube;
class Tarjeta{
    public $saldo;
    public $cargas_aceptadas = [150, 200, 250, 300, 350, 400, 450, 500, 600, 700, 800, 900, 1000, 1100, 1200, 1300, 1400, 1500, 2000, 2500, 3000, 3500, 4000];
    private $limite_saldo = 6600;

    public function cargar_tarjeta($nueva_carga){
        if(in_array($nueva_carga , $cargas_aceptadas) && ($saldo + $nueva_carga) <= limite_saldo){
            echo "Su saldo se ha cargado correctamente ";
            echo "Su nuevo saldo es de " . $this->saldo;
            $this->saldo += $nueva_carga;
        }
        else{
            echo "Error al cargar el monto ingresado";
            echo "Verifique que el monto ingresado este dentro de los montos aceptados";
            echo "Su saldo es de " . $this->saldo;
        }
    }

    public function __construct($saldo=0){
        $this->saldo = $saldo;
    }
}
