<?php
	$pj1 = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vPersonaje')->find($pj1);
	$hab = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vHabilidad')->findOneByNombre($skill);
	$CD = $var;

	switch ($hab->atributoAsociado) {
		case 'Fuerza':
			$bonus = $pj1->bonusFuerza;
			break;
		case 'Destreza':
			$bonus = $pj1->bonusDestreza;
			break;
		case 'Resistencia':
			$bonus = $pj1->bonusResistencia;
			break;
		case 'Carisma':
			$bonus = $pj1->bonusCarisma;
			break;
		case 'Manipulacion':
			$bonus = $pj1->bonusManipulacion;
			break;
		case 'Apariencia':
			$bonus = $pj1->bonusApariencia;
			break;
		case 'Percepcion':
			$bonus = $pj1->bonusPercepcion;
			break;
		case 'Inteligencia':
			$bonus = $pj1->bonusInteligencia;
			break;
		case 'Astucia':
			$bonus = $pj1->bonusAstucia;
			break;
	}

	$var = 0;
	$fracaso = true;
	$dados = $bonus+$pj1->{$hab->nombre};
	for($i = 0; $i<$dados; $i++){
		$tirada = rand(1,10);
		if($tirada>=$CD){
			$var++;
			$fracaso = false;
		}
		else if($tirada==1) $var--;
	}

	$res = array('Personaje' => $pj1->nombre, 'Dados' => $dados, 'Clase de Dificultad' => $CD, 'Éxitos' => $var);

	if($fracaso==true) $res['Fracaso'] = "Si";
	else if($var==0) $res['Fallo'] = "Si";
?>