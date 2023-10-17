<?php
namespace TrabajoSube;

class Colectivo_Rosario{
    public $costo_boleto = 120;
    public $minimo_tarjeta = -211.84;

	public function pagarCon($tarjeta , $tiempo){
		$tipo_tarjeta = $this->comprobar_tarjeta($tarjeta , $tiempo);
		
		if(tipo_tarjeta == 1){//Normal
            $boleto = pagar_comun($tarjeta);
            $tarjeta->usos_por_mes += 1;
			return boleto;
		}
		if(tipo_tarjeta == 2){//Jubilados
            $boleto = pagar_jubilado($tarjeta);
			return boleto;
		}
		if(tipo_tarjeta == 3){//BEG
            $boleto = pagar_beg($tarjeta);
            $tarjeta->usos_por_dia += 1;
			return boleto;
		}
		if(tipo_tarjeta == 4){//Parcial
            $boleto = pagar_parcial($tarjeta);
            $tarjeta->usos_por_dia += 1;
			return boleto;
		}
        else{
            return false;
        }
	}

	public function comprobar_tarjeta($tarjeta , $tiempo){
		$tipo_tarjeta;

        if($this->horario_franquicias($tiempo)){
            if($tarjeta instanceof Tarjeta){
                $this->tipo_tarjeta = 1; 
            }
            if($tarjeta instanceof FranquiciaCompletaJubilados){
                $this->tipo_tarjeta = 2; 
            }
            if($tarjeta instanceof FranquiciaCompletaBEG){
                    if($tarjeta->usos_por_dia <= 2){
                    $this->tipo_tarjeta = 3; 
                    }
                     else{
                        $this->tipo_tarjeta = 1;
                    }
                }
            if($tarjeta instanceof FranquiciaParcialMBEyU){
                if($tarjeta->usos_por_dia <= 4){
                $this->tipo_tarjeta = 4; 
                }
                 else{
                    $this->tipo_tarjeta = 1;
                }
            }
            else{
                echo "Tipo de tarjeta no compatible";
            }
        }
        else{
            $this->tipo_tarjeta = 1;
        }

	 return $tipo_tarjeta;
	}

	public function pagar_comun($tarjeta){
        if($tarjeta->saldo - $this->costo_boleto >= $this->minimo_tarjeta){
            $tarjeta->saldo -= $this->costo_boleto;
            $tarjeta->acreditar_saldo($tarjeta->saldo);
            return new Boleto($costo_boleto,$tarjeta->saldo);
        }
        else{
            echo "No tiene suficiente saldo para comprar un boleto";
            echo "Su saldo es de " . $tarjeta->saldo;
            echo "El costo del boleto es de " . $this->costo_boleto;
            return false;
        }
	}

    public function pagar_jubilado($tarjeta){
        return new Boleto($costo_boleto,$tarjeta->saldo);
	}
    
    public function pagar_beg($tarjeta){
        return new Boleto($costo_boleto,$tarjeta->saldo);
	}

    public function pagar_parcial($tarjeta){
        if($tarjeta->saldo - ($this->costo_boleto/2) >= $this->minimo_tarjeta){
            $tarjeta->saldo -= ($this->costo_boleto/2);
            $tarjeta->acreditar_saldo($tarjeta->saldo);
            return new Boleto($costo_boleto,$tarjeta->saldo);
        }
        else{
            echo "No tiene suficiente saldo para comprar un boleto";
            echo "Su saldo es de " . $tarjeta->saldo;
            echo "El costo del boleto es de " . ($this->costo_boleto/2);
            return false;
        }
	}

    public function horario_franquicias($tiempo){
        $diaSemana = date('N', $tiempo);
        $hora = date('H', $tiempo);
        if ($diaSemana >= 1 && $diaSemana <= 5 && $hora >= 6 && $hora < 22) {
            return true;
        }
        else{
            return false;
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