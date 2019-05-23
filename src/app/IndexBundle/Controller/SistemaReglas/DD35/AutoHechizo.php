<?php
	$pj1 = $this->em->getRepository('app\IndexBundle\Entity\DD35\Personaje')->find($executor->pj1);
	$hechizo = $this->em->getRepository('app\IndexBundle\Entity\DD35\Hechizo')->findOneByNombre($executor->spell);

	if($hechizo->efecto){
		if($pj1->clase == "Mago") $var = $pj1->aplicar_efecto($hechizo, $hechizo->efecto, $pj1->bonusInteligencia);
		else if($pj1->clase == "Hechicero") $var = $pj1->aplicar_efecto($hechizo, $hechizo->efecto, $pj1->bonusCarisma);
		else $var = $pj1->aplicar_efecto($hechizo, $hechizo->efecto, $pj1->bonusSabiduria);
	}

	return $res = "El jugador ".$executor->pj1." lanza un hechizo ".$executor->spell." y cambia su estado a ".$var;
?>