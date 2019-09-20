<?php
	$pj2 = $var;
	$pj1 = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vPersonaje')->find($pj1);
	$pj2 = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vPersonaje')->find($pj2);
	$hab = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vHabilidad')->findOneByNombre($skill);

	switch ($hab->atributoAsociado) {
		case 'Fuerza':
			$bonus = $pj1->bonusFuerza;
			$bonus2 = $pj2->bonusFuerza;
			break;
		case 'Destreza':
			$bonus = $pj1->bonusDestreza;
			$bonus2 = $pj2->bonusDestreza;
			break;
		case 'Resistencia':
			$bonus = $pj1->bonusResistencia;
			$bonus2 = $pj2->bonusResistencia;
			break;
		case 'Carisma':
			$bonus = $pj1->bonusCarisma;
			$bonus2 = $pj2->bonusCarisma;
			break;
		case 'Manipulacion':
			$bonus = $pj1->bonusManipulacion;
			$bonus2 = $pj2->bonusManipulacion;
			break;
		case 'Apariencia':
			$bonus = $pj1->bonusApariencia;
			$bonus2 = $pj2->bonusApariencia;
			break;
		case 'Percepcion':
			$bonus = $pj1->bonusPercepcion;
			$bonus2 = $pj2->bonusPercepcion;
			break;
		case 'Inteligencia':
			$bonus = $pj1->bonusInteligencia;
			$bonus2 = $pj2->bonusInteligencia;
			break;
		case 'Astucia':
			$bonus = $pj1->bonusAstucia;
			$bonus2 = $pj2->bonusAstucia;
			break;
	}
	
	$var = 0;
	$var2 = 0;
	$dados = $bonus+$pj1->{$hab->nombre};
	$dados2 = $bonus2+$pj2->{$hab->nombre};

	for($i = 0; $i<$dados; $i++){
		$tirada = rand(1,10);
		if($tirada>=$dados2){
			$var++;
		}
		else if($tirada==1) $var--;
	}

	for($i = 0; $i<$dados2; $i++){
		$tirada = rand(1,10);
		if($tirada>=$dados){
			$var2++;
		}
		else if($tirada==1) $var2--;
	}

	$res = array('Personaje' => array($pj1->nombre,$pj2->nombre), 'Dados' => array($dados,$dados2), 'Exitos' => array($var,$var2));

	/*if($var-$var2 > 0) $res = "El jugador ".$pj1->nombre." gana el chequeo de dificultad con ".$var-$var2." éxitos.";
	else $res = "El jugador ".$pj1->nombre." gana el chequeo de dificultad con ".$var2-$var." éxitos.";*/
?>