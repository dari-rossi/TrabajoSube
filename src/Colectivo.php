<?php
namespace TrabajoSube;
class Colectivo{
    protected $linea;
    
    public function __construct($linea){
        $this->linea = $linea;
    }
    
    //    Funcion de ejemplo para test
    public function getLinea(){
        return $this->linea;
    }

    
    public function cobrarBoleto($tarjeta,$boleto){
        if ($tarjeta->saldo > $boleto->tarifa){
            $tarjeta->saldo -= $boleto->tarifa;
        }
        else echo "No hay saldo suficiente";
    }
}
