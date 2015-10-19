<?php
	$pj1 = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vPersonaje')->find($executor->pj1);
	$pj2 = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vPersonaje')->find($executor->pj2);
	$arma = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vArma')->findOneByNombre($pj1->arma);

	$FM=$executor->ataques;
	$danoFinal = 0;
	$fracaso = false;

	for($i = 0; $i<$FM || $fracaso = true; i++){
		require_once(__DIR__."/Vampiro/Ataque.php");
		$FM--;
		$danoFinal = $danoFinal+$var; 
	}

	if($fracaso==true) $res = "Fracaso en el ataque.";
	else if($danoFinal>0){
		$danoFinal = $pj2->aplicar_efecto("Ataque", ($danoFinal*-1), $arma);
		$res = $pj1->nombre." acierta los ataques, y ".$pj2->nombre." sufre ".$var." puntos de daño."
	}
	else $res = "El jugador ".$pj1->nombre." falló los ataques.";
?>