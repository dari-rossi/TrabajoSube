<?php
namespace TrabajoSube;

class Colectivo{
    public $costo_boleto = 120;
    
    public function pagarCon($tarjeta){
        if($tarjeta->saldo >= $this->costo_boleto){
            $tarjeta->saldo -= $this->costo_boleto;
            echo "Su boleto ha sido pagado exitosamente";
            echo "Su saldo es de " . $tarjeta->saldo;
            return new Boleto($costo_boleto);
        }
            
        else{
            echo "No tiene suficiente saldo para comprar un boleto";
            echo "Su saldo es de " . $tarjeta->saldo;
            echo "El costo del boleto es de " . $this->costo_boleto;
        }
    }

}
