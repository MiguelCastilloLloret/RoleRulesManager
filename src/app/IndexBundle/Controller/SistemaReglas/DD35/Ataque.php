<?php
	$pj1 = $this->em->getRepository('app\IndexBundle\Entity\DD35\Personaje')->find($executor->pj1);
	$pj2 = $this->em->getRepository('app\IndexBundle\Entity\DD35\Personaje')->find($executor->pj2);
	$arma = $this->em->getRepository('app\IndexBundle\Entity\DD35\Arma')->findOneByNombre($pj1->arma);

	$impacto = rand(1,20);
	$critico = false;
	
	if($arma->bonus == "Fuerza") $bonus = $pj1->bonusFuerza;
	else $bonus = $pj1->bonusDestreza;

	$danoFinal = $bonus;

	if($impacto==20){
		$comprobacionCritico = rand(1,20);
			$i = 0;
		while ($i<$arma->dano){
			$danoFinal = $danoFinal + rand(1,$arma->dado);
			$i++;
		}
		if(($comprobacionCritico+$bonus)>$pj2->claseArmadura){
			$danoFinal = $danoFinal*2;
			$critico = true;
		}
	}
	else if(($impacto+$bonus)>$pj2->claseArmadura){
		$i = 0;
		while ($i<$arma->dano){
			$danoFinal = $danoFinal + rand(1,$arma->dado);
			$i++;
		}
	}

	if($danoFinal!=0) $var = $pj2->aplicar_efecto("Ataque", ($danoFinal*-1));

	

	if($danoFinal == 0) $res = "El jugador ".$pj1->nombre." falla el ataque(Tirada ".$impacto."+".$bonus." vs CA ".$pj2->claseArmadura.").";
	else if($impacto == 20 && $critico == true) $res = "El jugador ".$pj1->nombre." acierta un golpe crítico(Tirada ".$impacto."+".$bonus.", comprobación ".$comprobacionCritico."+".$bonus.") y causa ".($var*-1)." puntos de daño a ".$pj2->nombre.".";
	else if($impacto == 20) $res = "El jugador ".$pj1->nombre." falla una oportunidad de crítico(Tirada ".$impacto."+".$bonus.", comprobación ".$comprobacionCritico."+".$bonus."). Su ataque causa ".($var*-1)." puntos de daño a ".$pj2->nombre.".";
	else $res = "El jugador ".$pj1->nombre." acierta un ataque(Tirada ".$impacto."+".$bonus." vs CA ".$pj2->claseArmadura.") y causa ".($var*-1)." puntos de daño a ".$pj2->nombre.".";
?>