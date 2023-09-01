<?php
namespace TrabajoSube;

include Tarjeta.php;
include Boleto.php;

class Colectivo{
    protected $linea;
    public $costo_boleto;
    
    //    Funcion de ejemplo para test
    public function getLinea(){
        return $this->linea;
    }

    /*
    public function cobrarBoleto($tarjeta,$boleto){
        if ($tarjeta->saldo > $boleto->tarifa){
            $tarjeta->saldo -= $boleto->tarifa;
        }
        else echo "No hay saldo suficiente";
    }
    */

    public function pagarCon($tarjeta){
        if($tarjeta->saldo >= $costo_boleto){
            $tarjeta->saldo -= $costo_boleto;
            printf("Su boleto ha sido pagado exitosamente\nSu saldo es de %i",$this->saldo);
            return new Boleto($costo_boleto);
        }
        else{
            printf("No tiene suficiente saldo para comprar un boleto\nSu saldo es de %i\nEl costo del boleto es de %i",$this->saldo,$this->costo_boleto);
        }
    }

    public function __construct($linea){
        $this->linea = $linea;
    }

}
