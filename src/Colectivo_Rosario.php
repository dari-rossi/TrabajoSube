<?php
namespace TrabajoSube;

class Colectivo_Rosario{
    public $costo_boleto = 120;
    public $minimo_tarjeta = -211.84;

	public function pagarCon($tarjeta){
		$tipo_tarjeta = comprobar_tarjeta($tarjeta);
		
		if(tipo_tarjeta == 1){//Normal
            $boleto = pagar_comun($tarjeta);
			return boleto;
		}
		if(tipo_tarjeta == 2){//Jubilados
            $boleto = pagar_jubilado($tarjeta);
			return boleto;
		}
		if(tipo_tarjeta == 3){//BEG
            $boleto = pagar_beg($tarjeta);
			return boleto;
		}
		if(tipo_tarjeta == 4){//Parcial
            $boleto = pagar_parcial($tarjeta);
			return boleto;
		}
        else{
            return false;
        }
	}

	private function comprobar_tarjeta($tarjeta){
		$tipo_tarjeta;
		if($tarjeta == Tarjeta){
            $this->tipo_tarjeta = 1; 
		}
		if($tarjeta == FranquiciaCompletaJubilados){
            $this->tipo_tarjeta = 2; 
		}
		if($tarjeta == FranquiciaCompletaBEG){
                if(usos_dia <= 2){
                $this->tipo_tarjeta = 3; 
                }
                 else{
                    $this->tipo_tarjeta = 1;
                }
		    }
		if($tarjeta == FranquiciaParcialMBEyU){
            if(usos_dia <= 4){
			$this->tipo_tarjeta = 4; 
			}
		 	else{
                $this->tipo_tarjeta = 1;
			}
		}
		else{
            echo "Tipo de tarjeta no compatible";
		}
	 return $tipo_tarjeta;
	}

	private function pagar_comun($tarjeta){
        if($tarjeta->saldo - $this->costo_boleto >= $this->minimo_tarjeta){
            $tarjeta->saldo -= $this->costo_boleto;
            $tarjeta->acreditar_saldo($tarjeta->saldo);
            return new Boleto($costo_boleto,$tarjeta->saldo);
        }
        else{
            echo "No tiene suficiente saldo para comprar un boleto";
            echo "Su saldo es de " . $tarjeta->saldo;
            echo "El costo del boleto es de " . $this->costo_boleto;
        }
	}

    private function pagar_jubilado($tarjeta){
        //Comprobar tiempo
        return new Boleto($costo_boleto,$tarjeta->saldo);
        //else no se encuentra en el horario adecuado
        
	}
    
    private function pagar_beg($tarjeta){
        //Comprobar tiempo

	}

    private function pagar_parcial($tarjeta){
        // Comprobar tiempo?
        if($tarjeta->saldo - ($this->costo_boleto/2) >= $this->minimo_tarjeta){
            $tarjeta->saldo -= $this->costo_boleto;
            $tarjeta->acreditar_saldo($tarjeta->saldo);
            return new Boleto($costo_boleto,$tarjeta->saldo);
        }
        else{
            echo "No tiene suficiente saldo para comprar un boleto";
            echo "Su saldo es de " . $tarjeta->saldo;
            echo "El costo del boleto es de " . ($this->costo_boleto/2);
        }
	}






/*
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
*/


}