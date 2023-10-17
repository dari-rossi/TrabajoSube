<?php
namespace TrabajoSube;

class Colectivo_Rosario{
    public $costo_boleto = 120;
    public $minimo_tarjeta = -211.84;
    public $linea = "Rosario";

	public function pagarCon($tarjeta , $tiempo){
		$tipo_tarjeta = $this->comprobar_tarjeta($tarjeta , $tiempo);
		
		if($this->tipo_tarjeta == 1){//Normal
            $boleto = $this->pagar_comun($tarjeta,$tiempo);
            $tarjeta->usos_por_mes += 1;
			return $boleto;
		}
		if($this->tipo_tarjeta == 2){//Jubilados
            $boleto = $this->pagar_jubilado($tarjeta,$tiempo);
			return $boleto;
		}
		if($this->tipo_tarjeta == 3){//BEG
            $boleto = $this->pagar_beg($tarjeta,$tiempo);
            $tarjeta->usos_por_dia += 1;
			return $boleto;
		}
		if($this->tipo_tarjeta == 4){//Parcial
            $boleto = $this->pagar_parcial($tarjeta,$tiempo);
            $tarjeta->usos_por_dia += 1;
			return $boleto;
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
                    if($tarjeta->usos_por_dia < 2){
                    $this->tipo_tarjeta = 3; 
                    }
                     else{
                        $this->tipo_tarjeta = 1;
                    }
                }
            if($tarjeta instanceof FranquiciaParcialMBEyU){
                if($tarjeta->usos_por_dia < 4){
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

	public function pagar_comun($tarjeta,$tiempo){
        if($tarjeta->usos_por_mes <= 29){
            if($tarjeta->saldo - $this->costo_boleto >= $this->minimo_tarjeta){
                $tarjeta->saldo -= $this->costo_boleto;
                $tarjeta->acreditar_saldo($tarjeta->saldo);
                return new Boleto($tiempo,$tarjeta->tipo,$linea,$costo_boleto,$tarjeta->saldo,$tarjeta->id);
            }
            else{
                echo "No tiene suficiente saldo para comprar un boleto";
                echo "Su saldo es de " . $tarjeta->saldo;
                echo "El costo del boleto es de " . $this->costo_boleto;
                return false;
            }
            if($tarjeta->usos_por_mes >= 30 && $tarjeta->usos_por_mes <= 79){
                if($tarjeta->saldo - ($this->costo_boleto * 0.80) >= $this->minimo_tarjeta){
                    $tarjeta->saldo -= ($this->costo_boleto * 0.80);
                    $tarjeta->acreditar_saldo($tarjeta->saldo);
                    return new Boleto($tiempo,$tarjeta->tipo,$linea,$costo_boleto,$tarjeta->saldo,$tarjeta->id);
                }
                else{
                    echo "No tiene suficiente saldo para comprar un boleto";
                    echo "Su saldo es de " . $tarjeta->saldo;
                    echo "El costo del boleto es de " . $this->costo_boleto;
                    return false;
                }
            }
            else{
                if($tarjeta->saldo - ($this->costo_boleto * 0.75) >= $this->minimo_tarjeta){
                    $tarjeta->saldo -= ($this->costo_boleto * 0.75);
                    $tarjeta->acreditar_saldo($tarjeta->saldo);
                    return new Boleto($tiempo,$tarjeta->tipo,$linea,$costo_boleto,$tarjeta->saldo,$tarjeta->id);
                }
                else{
                    echo "No tiene suficiente saldo para comprar un boleto";
                    echo "Su saldo es de " . $tarjeta->saldo;
                    echo "El costo del boleto es de " . $this->costo_boleto;
                    return false;
                }
            }
	    }
    }

    public function pagar_jubilado($tarjeta,$tiempo){
        return new Boleto($tiempo,$tarjeta->tipo,$linea,$costo_boleto,$tarjeta->saldo,$tarjeta->id);
	}
    
    public function pagar_beg($tarjeta,$tiempo){
        return new Boleto($tiempo,$tarjeta->tipo,$linea,$costo_boleto,$tarjeta->saldo,$tarjeta->id);
	}

    public function pagar_parcial($tarjeta,$tiempo){
        if(($tiempo - $tarjeta->ultimo_boleto)>300){
            if($tarjeta->saldo - ($this->costo_boleto/2) >= $this->minimo_tarjeta){
                $tarjeta->saldo -= ($this->costo_boleto/2);
                $tarjeta->acreditar_saldo($tarjeta->saldo);
                $tarjeta->ultimo_boleto = $tiempo;
                return new Boleto($tiempo,$tarjeta->tipo,$linea,$costo_boleto,$tarjeta->saldo,$tarjeta->id);
            }
            else{
                echo "No tiene suficiente saldo para comprar un boleto";
                echo "Su saldo es de " . $tarjeta->saldo;
                echo "El costo del boleto es de " . ($this->costo_boleto/2);
                return false;
            }
        }
        else{
            echo "Tienes que esperar 5 minutos desde tu ultimo boleto comprado";
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