<?php
	$pj1 = $this->em->getRepository('app\IndexBundle\Entity\DD35\Personaje')->find($executor->pj1);
	$hab = $this->em->getRepository('app\IndexBundle\Entity\DD35\Habilidad')->findOneByNombre($executor->skill);
	switch ($hab->atributoAsociado) {
		case 'Fuerza':
			$bonus = $pj1->bonusFuerza;
			break;
		case 'Destreza':
			$bonus = $pj1->bonusDestreza;
			break;
		case 'Constitucion':
			$bonus = $pj1->bonusConstitucion;
			break;
		case 'Inteligencia':
			$bonus = $pj1->bonusInteligencia;
			break;
		case 'Sabiduria':
			$bonus = $pj1->bonusSabiduria;
			break;
		case 'Carisma':
			$bonus = $pj1->bonusCarisma;
			break;
	}
	$var = rand(1,20)+$bonus;
	if($var > $executor->CD) $res = "El jugador ".$pj1->nombre." paso el chequeo de dificultad(tirada ".$var." vs CD ".$executor->CD.")";
	else $res = "El jugador ".$pj1->nombre." fallo el chequeo de dificultad(tirada ".$var." vs CD ".$executor->CD.")";
?>