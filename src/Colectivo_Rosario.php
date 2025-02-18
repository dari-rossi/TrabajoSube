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
			return $boleto;
		}
		if($this->tipo_tarjeta == 2){//Jubilados
            $boleto = $this->pagar_jubilado($tarjeta,$tiempo);
			return $boleto;
		}
		if($this->tipo_tarjeta == 3){//BEG
            $boleto = $this->pagar_beg($tarjeta,$tiempo);
            $tarjeta->tiempo_ultimo_boleto = $tiempo;
			return $boleto;
		}
		if($this->tipo_tarjeta == 4){//Parcial
            $boleto = $this->pagar_parcial($tarjeta,$tiempo);
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
                $this->comprobar_mes($tarjeta, $tiempo);
                $this->tipo_tarjeta = 1; 
            }
            if($tarjeta instanceof FranquiciaCompletaJubilados){
                $this->tipo_tarjeta = 2; 
            }
            if($tarjeta instanceof FranquiciaCompletaBEG){
                $this->comprobar_dia($tarjeta, $tiempo);
                if($tarjeta->usos_por_dia < 2){
                    $this->tipo_tarjeta = 3; 
                    }
                    else{
                    $this->tipo_tarjeta = 1;
                }
            }
            if($tarjeta instanceof FranquiciaParcialMBEyU){
                $this->comprobar_dia($tarjeta, $tiempo);
                if($tarjeta->usos_por_dia < 4){
                $this->tipo_tarjeta = 4; 
                }
                else{$this->tipo_tarjeta = 1;
                }
            }
            else{
                echo "Tipo de tarjeta no compatible";
            }
        }
        else{
            $this->comprobar_mes($tarjeta, $tiempo);
            $this->tipo_tarjeta = 1;
        }

	 return $tipo_tarjeta;
	}

	public function pagar_comun($tarjeta,$tiempo){
        if($tarjeta->usos_por_mes <= 29 && $tarjeta->saldo - $this->costo_boleto >= $this->minimo_tarjeta){
            $tarjeta->saldo -= $this->costo_boleto;
            $tarjeta->acreditar_saldo($tarjeta->saldo);
            $tarjeta->usos_por_mes += 1;
            $tarjeta->tiempo_ultimo_boleto = $tiempo;
            return new Boleto($tiempo,$tarjeta->tipo,$this->linea,$this->costo_boleto,$tarjeta->saldo,$tarjeta->id);
        }

        if($tarjeta->usos_por_mes >= 30 && $tarjeta->usos_por_mes <= 79 && $tarjeta->saldo - ($this->costo_boleto * 0.80) >= $this->minimo_tarjeta){
            $tarjeta->saldo -= ($this->costo_boleto * 0.80);
            $tarjeta->acreditar_saldo($tarjeta->saldo);
            $tarjeta->usos_por_mes += 1;
            $tarjeta->tiempo_ultimo_boleto = $tiempo;
            return new Boleto($tiempo,$tarjeta->tipo,$this->linea,$this->costo_boleto,$tarjeta->saldo,$tarjeta->id);
        }
        
        if($tarjeta->usos_por_mes >= 80 && $tarjeta->saldo - ($this->costo_boleto * 0.75) >= $this->minimo_tarjeta){
            $tarjeta->saldo -= ($this->costo_boleto * 0.75);
            $tarjeta->acreditar_saldo($tarjeta->saldo);
            $tarjeta->usos_por_mes += 1;
            $tarjeta->tiempo_ultimo_boleto = $tiempo;
            return new Boleto($tiempo,$tarjeta->tipo,$this->linea,$this->costo_boleto,$tarjeta->saldo,$tarjeta->id);
        }

        echo "No tiene suficiente saldo para comprar un boleto";
        echo "Su saldo es de " . $tarjeta->saldo;
        echo "El costo del boleto es de " . $this->costo_boleto;
        return false;
	}

    public function pagar_jubilado($tarjeta,$tiempo){
        return new Boleto($tiempo,$tarjeta->tipo,$this->linea,$this->costo_boleto,$tarjeta->saldo,$tarjeta->id);
	}
    
    public function pagar_beg($tarjeta,$tiempo){
        $tarjeta->usos_por_dia += 1;
        $tarjeta->tiempo_ultimo_boleto = $tiempo;
        return new Boleto($tiempo,$tarjeta->tipo,$this->linea,$this->costo_boleto,$tarjeta->saldo,$tarjeta->id);
	}

    public function pagar_parcial($tarjeta,$tiempo){
        if(($tiempo - $tarjeta->ultimo_boleto)>300){
            if($tarjeta->saldo - ($this->costo_boleto/2) >= $this->minimo_tarjeta){
                $tarjeta->saldo -= ($this->costo_boleto/2);
                $tarjeta->acreditar_saldo($tarjeta->saldo);
                $tarjeta->usos_por_dia += 1;
                $tarjeta->tiempo_ultimo_boleto = $tiempo;
                return new Boleto($tiempo,$tarjeta->tipo,$this->linea,$this->costo_boleto,$tarjeta->saldo,$tarjeta->id);
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
        return $diaSemana >= 1 && $diaSemana <= 5 && $hora >= 6 && $hora <= 22;
    }

    public function comprobar_mes($tarjeta, $tiempo) {
        $mes_ultimo_boleto = date("m Y", $tarjeta->tiempo_ultimo_boleto);
        $fecha = date("m Y", $tiempo);
        if ($mes_ultimo_boleto != $fecha) {
            $tarjeta->usos_por_mes = 0;
        }
    }

    public function comprobar_dia($tarjeta, $tiempo) {
        $dia_ultimo_boleto = date("j m Y", $tarjeta->tiempo_ultimo_boleto);
        $fecha = date("j m Y", $tiempo);
        if ($dia_ultimo_boleto != $fecha) {
            $tarjeta->usos_por_dia = 0;
        }
    }
}