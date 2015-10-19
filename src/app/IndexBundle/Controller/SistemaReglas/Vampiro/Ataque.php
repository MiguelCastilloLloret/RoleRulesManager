<?php
	if(!isset($arma)){
		$pj1 = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vPersonaje')->find($executor->pj1);
		$pj2 = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vPersonaje')->find($executor->pj2);
		$arma = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vArma')->findOneByNombre($pj1->arma);
	}

	if($arma->cadencia>0) $tipoAtaque = "Armas de Fuego";
	else $tipoAtaque = "Armas CaC";
	if(!isset($FM)) $FM = 0;

	$dados = $pj1->bonusDestreza+$pj1->habilidades[$tipoAtaque]-$FM;
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

	if($var > 0){
		$var = $pj1->bonusFuerza+$arma->dano;
		if($FM==0){
			$var = $pj2->aplicar_efecto("Ataque", ($var*-1), $arma);
			$res = $pj1->nombre." acierta el ataque, y ".$pj2->nombre." sufre ".$var." puntos de daño."
		} 
	}
	else if($fracaso==true && $FM=0) $res = "Fracaso en el ataque.";
	else if($FM==0) $res = "El ataque falló.";

?>