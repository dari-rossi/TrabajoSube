<?php
namespace TrabajoSube;

class Colectivo{
    public $costo_boleto;
    
    public function pagarCon($tarjeta){
        if($tarjeta->saldo >= $costo_boleto){
            $tarjeta->saldo -= $costo_boleto;
            echo "Su boleto ha sido pagado exitosamente";
            echo "Su saldo es de " . $this->saldo;
            return new Boleto($costo_boleto);
        }
            
        else{
            echo "No tiene suficiente saldo para comprar un boleto";
            echo "Su saldo es de " . $this->saldo;
            echo "El costo del boleto es de " . $this->costo_boleto;
        }
    }

}
