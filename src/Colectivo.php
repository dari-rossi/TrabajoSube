<?php
namespace TrabajoSube;

class Colectivo{
    public $costo_boleto = 120;
    public $costo_medio_boleto = 60;
    public $costo_boleto_completo = 0;
    public $minimo_tarjeta = -211.84;
    
    public function pagarCon($tarjeta){
        if($tarjeta->saldo - $this->costo_boleto >=  $this->minimo_tarjeta){
            $tarjeta->saldo -= $this->costo_boleto;
            echo "Su boleto ha sido pagado exitosamente";
            echo "Su saldo es de " . $tarjeta->saldo;
            $tarjeta->acreditar_saldo($tarjeta->saldo);
            return new Boleto($costo_boleto , $tarjeta->saldo);
        }
            
        else{
            echo "No tiene suficiente saldo para comprar un boleto";
            echo "Su saldo es de " . $tarjeta->saldo;
            echo "El costo del boleto es de " . $this->costo_boleto;
            return false;
        }
    }

    public function pagarSon($tarjeta){
        if($tarjeta == Tarjeta){
            if($tarjeta->saldo - $this->costo_boleto >= $this->minimo_tarjeta){
                $tarjeta->saldo -= $this->costo_boleto;
                $tarjeta->acreditar_saldo($tarjeta->saldo);
                return new Boleto($costo_boleto , $tarjeta->saldo);
            }
            else{
                echo "No tiene suficiente saldo para comprar un boleto";
                echo "Su saldo es de " . $tarjeta->saldo;
                echo "El costo del boleto es de " . $this->costo_boleto;
                return false;
            }
        }
        if($tarjeta == Medio_Boleto){
            if($tarjeta->saldo - $this->costo_medio_boleto >= $this->minimo_tarjeta){
                $tarjeta->saldo -= $this->costo_medio_boleto;
                $tarjeta->acreditar_saldo($tarjeta->saldo);
                return new Boleto($costo_boleto , $tarjeta->saldo);
            }
            else{
                echo "No tiene suficiente saldo para comprar un boleto";
                echo "Su saldo es de " . $tarjeta->saldo;
                echo "El costo del boleto es de " . $this->costo_boleto;
                return false;
            }
        }
        if($tarjeta == Boleto_Completo){
            if($tarjeta->saldo - $this->costo_boleto_completo >= $this->minimo_tarjeta){
                $tarjeta->saldo -= $this->costo_boleto_completo;
                $tarjeta->acreditar_saldo($tarjeta->saldo);
                return new Boleto($costo_boleto , $tarjeta->saldo);
            }
        }
    }



}