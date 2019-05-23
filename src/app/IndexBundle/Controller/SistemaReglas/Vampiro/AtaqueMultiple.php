<?php
	$pj1 = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vPersonaje')->find($executor->pj1);
	$pj2 = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vPersonaje')->find($executor->pj2);
	$arma = $this->ev->getRepository('app\IndexBundle\Entity\Vampiro\vArma')->findOneByNombre($pj1->arma);

	$FM=$executor->ataques;
	$fracaso = false;

	while($FM>0 || $fracaso == false){
		require_once(__DIR__."/Vampiro/Ataque.php");
		$FM--;
	}

	if($fracaso==true){
		$res['Fracaso'] = "Si";
		unset($res['Fallo']);
		unset($res['Daño']);
		unset($res['Exitos']);
	}
	else{
		$res['Daño'] = $pj2->aplicar_efecto("Ataque", ($res['Daño']*-1), $arma);
	}
?>