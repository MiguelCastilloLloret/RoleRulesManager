<?php
	$pj2 = $var;
	$pj1 = $this->em->getRepository('app\IndexBundle\Entity\DD35\Personaje')->find($pj1);
	if(is_null($pj2)) $res = "No se especificó contrincante.";
	else{ 
	$pj2 = $this->em->getRepository('app\IndexBundle\Entity\DD35\Personaje')->find($pj2);
	$hab = $this->em->getRepository('app\IndexBundle\Entity\DD35\Habilidad')->findOneByNombre($skill);
	switch ($hab->atributoAsociado) {
		case 'Fuerza':
			$bonus1 = $pj1->bonusFuerza;
			$bonus2 = $pj2->bonusFuerza;
			break;
		case 'Destreza':
			$bonus1 = $pj1->bonusDestreza;
			$bonus2 = $pj2->bonusDestreza;
			break;
		case 'Constitucion':
			$bonus1 = $pj1->bonusConstitucion;
			$bonus2 = $pj2->bonusConstitucion;
			break;
		case 'Inteligencia':
			$bonus1 = $pj1->bonusInteligencia;
			$bonus2 = $pj2->bonusInteligencia;
			break;
		case 'Sabiduria':
			$bonus1 = $pj1->bonusSabiduria;
			$bonus2 = $pj2->bonusSabiduria;
			break;
		case 'Carisma':
			$bonus1 = $pj1->bonusCarisma;
			$bonus2 = $pj2->bonusCarisma;
			break;
	}
	$tir = rand(1,20);
	$var = $tir+$bonus1+$pj1->{$hab->nombre};
	$tir2 = rand(1,20);
	$var2 = $tir2+$bonus2+$pj2->{$hab->nombre};

	$res = array('Personaje' => array($pj1->nombre,$pj2->nombre), 'Tirada' => array($tir,$tir2), 'Bonus' => array($bonus1,$bonus2), $hab->nombre => array($pj1->{$hab->nombre},$pj2->{$hab->nombre}), 'Total' => array($var,$var2), 'Resultado' => array($var,$var2));

	/*if($var > $var2){
		$nom = $pj1->nombre;
	}
	else{
		$nom = $pj2->nombre;
	}
	$res = "El jugador ".$nom." ha ganado la tirada de ".$executor->skill."(".$var."vs".$var2.")";
	*/
}
?>