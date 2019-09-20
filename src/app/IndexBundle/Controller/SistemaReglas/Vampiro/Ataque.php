<?php
	
	if(!isset($pj1)) $pj1 = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vPersonaje')->find($pj1);
	if(is_null($pj2)) $res = "No se especificó contrincante.";
	else{
		$pj2 = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vPersonaje')->find($pj2);
		$arma = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vArma')->findOneByNombre($pj1->arma);
	
		
		$res = array('Atacante' => $pj1->nombre, 'Arma' => $arma->nombre, 'Dificultad' => $CD, 'Defensor' => $pj2->nombre);

		if($arma->cadencia>0) $tipoAtaque = $pj1->ArmasDeFuego;
		else $tipoAtaque = $pj1->ArmasCaC;
		if(!isset($FM)) $FM = 0;


		$dados = $pj1->bonusDestreza+$tipoAtaque-$FM;
		$fracaso = true;
		$var = 0;

		for($i = 0; $i<$dados; $i++){
			$tirada = rand(1,10);
			if($tirada>=$CD){
				$var++;
				$fracaso = false;
			}
			else if($tirada==1) $var--;
		}

		$res['Daño'] = 0;
		$res['Exitos'] = 0;
		$res['Exitos'] = $var;

		if($var > 0){
			$var = $pj1->bonusFuerza+$arma->dano+$var-1;
			if($FM==0){
				$var = $pj2->aplicar_efecto("Ataque", ($var*-1), $arma);
				$res['Daño'] = $var;
			} 
		}
		else if($fracaso==true && $FM<=0) $res['Fracaso'] = "Si";
		else if($FM==0) $res['Fallo'] = "Si";
	}
?>