<?php

	$pj1 = $this->em->getRepository('app\IndexBundle\Entity\DD35\Personaje')->find($executor->pj1);
	if(is_null($executor->pj2)) $res = "No se especificó contrincante.";
	else{
	$pj2 = $this->em->getRepository('app\IndexBundle\Entity\DD35\Personaje')->find($executor->pj2);
	$hechizo = $this->em->getRepository('app\IndexBundle\Entity\DD35\Hechizo')->findOneByNombre($executor->spell);

	$i = 0;

	while($i<$hechizo->danoBase){ 
		$var = $var+rand(1, $hechizo->dado);
		$i++;
	}

	$i = 0;

	if($hechizo->danoNivel){
		while($i<$pj1->nivel){
			$var = $var+rand(1, $hechizo->dado);
			$i++;
		}
	}

	$res = array('Lanzador' => $pj1->nombre, 'Objetivo' => $pj2->nombre, 'Hechizo' => $executor->spell);

	if($hechizo->curacion){
		if($pj1->clase == "Mago") $var = $pj2->aplicar_efecto($hechizo, $var, $pj1->bonusInteligencia);
		else if($pj1->clase == "Hechicero") $var = $pj2->aplicar_efecto($hechizo, $var, $pj1->bonusCarisma);
		else $var = $pj2->aplicar_efecto($hechizo, $var, $pj1->bonusSabiduria);
		$res['Curacion'] = $var;
	}
	else{
		if($pj1->clase == "Mago") $var = $pj2->aplicar_efecto($hechizo, $var*-1, $pj1->bonusInteligencia);
		else if($pj1->clase == "Hechicero") $var = $pj2->aplicar_efecto($hechizo, $var*-1, $pj1->bonusCarisma);
		else $var = $pj2->aplicar_efecto($hechizo, $var*-1, $pj1->bonusSabiduria);
		$res['Daño'] = $var*-1;
	}

	if($hechizo->efecto){
		if($pj1->clase == "Mago") $var = $pj2->aplicar_efecto($hechizo, $hechizo->efecto, $pj1->bonusInteligencia);
		else if($pj1->clase == "Hechicero") $var = $pj2->aplicar_efecto($hechizo, $hechizo->efecto, $pj1->bonusCarisma);
		else $var = $pj2->aplicar_efecto($hechizo, $hechizo->efecto, $pj1->bonusSabiduria);
		$res['Estado del objetivo'] = $var;
	}

	if($var < 0 || $var > 0) $res['Vida del objetivo'] = $pj2->puntosVida; //"El jugador ".$pj1->nombre." lanza un hechizo ".$executor->spell." y causa ".($var*-1)." puntos de daño a los objetivos. La vida de ".$pj2->nombre." es de ".$pj2->puntosVida." puntos.";
	//else if($var > 0) $res = "El jugador ".$pj1->nombre." lanza un hechizo ".$executor->spell." y cura ".$var." puntos de vida a los objetivos. La vida de ".$pj2->nombre." es de ".$pj2->puntosVida." puntos.";
	//else $res = "El jugador ".$pj1->nombre." lanza un hechizo ".$executor->spell." y cambia el estado de ".$pj2->nombre." a ".$var;
	}
?>