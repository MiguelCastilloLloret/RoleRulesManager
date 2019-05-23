<?php
	
	if(!isset($pj1)) $pj1 = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vPersonaje')->find($executor->pj1);
	if(is_null($executor->pj2)) $res = "No se especificó contrincante.";
	else{
		if(!isset($pj2)) $pj2 = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vPersonaje')->find($executor->pj2);
		if(!isset($arma)) $arma = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vArma')->findOneByNombre($pj1->arma);
	
		
		if(!isset($res)) $res = array('Atacante' => $pj1->nombre, 'Arma' => $arma->nombre, 'Dificultad' => $executor->CD, 'Defensor' => $pj2->nombre);

		if($arma->cadencia>0) $tipoAtaque = "Armas de Fuego";
		else $tipoAtaque = "Armas CaC";
		if(!isset($FM)) $FM = 0;

		if(array_key_exists($tipoAtaque, $pj1->habilidades)) $dados = $pj1->bonusDestreza+$pj1->habilidades[$tipoAtaque]-$FM;
		else $dados = $pj1->bonusDestreza-$FM;
		$fracaso = true;
		$var = 0;

		for($i = 0; $i<$dados; $i++){
			$tirada = rand(1,10);
			if($tirada>=$executor->CD){
				$var++;
				$fracaso = false;
			}
			else if($tirada==1) $var--;
		}

		if(!isset($res['Daño'])) $res['Daño'] = 0;
		if(!isset($res['Exitos'])) $res['Exitos'] = 0;
		$res['Exitos'] = $res['Exitos'] + $var;

		if($var > 0){
			$var = $pj1->bonusFuerza+$arma->dano;
			$res['Daño'] = $res['Daño'] + $var;
			if($FM==0){
				$var = $pj2->aplicar_efecto("Ataque", ($var*-1), $arma);
				$res['Daño'] = $res['Daño'] + $var;
			} 
		}
		else if($fracaso==true && $FM<=0) $res['Fracaso'] = "Si";
		else if($FM==0) $res['Fallo'] = "Si";
	}
?>