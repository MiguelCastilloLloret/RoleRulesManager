<?php

namespace app\IndexBundle\Controller\SistemaReglas;

use app\IndexBundle\Entity\DD35\Personaje;
use app\IndexBundle\Entity\DD35\Habilidad;
use app\IndexBundle\Entity\DD35\Hechizo;
use app\IndexBundle\Entity\DD35\Arma;

use app\IndexBundle\Entity\Vampiro\vPersonaje;
use app\IndexBundle\Entity\Vampiro\vHabilidad;
use app\IndexBundle\Entity\Vampiro\vArma;

class SistemaReglas{

	public $em;
	public $ev;

	public function __construct($EM, $EV){
		$this->em = $EM;
		$this->ev = $EV;
	}

	public function ejecutorReglas($executor){

		if(is_null($executor->pj1)) return "Falta por especificar personaje";

		//Ejecucion de los subsistemas

		if($executor->CD != 0 || !is_null($executor->skill)){
			if ($executor->CD == 0) return $this->subsistema_tiradas($executor->game, $executor->action, $executor->skill, $executor->pj1, $executor->CD);
			else return $this->subsistema_tiradas($executor->game, $executor->action, $executor->skill, $executor->pj1, $executor->pj2);
		}
		else if(!is_null($executor->spell)){
			return $this->subsistema_magia($executor->game, $executor->action, $executor->pj1, $executor->pj2, $executor->spell);
		}
		else if($executor->action == "Ataque" && !is_null($executor->pj2)) return $this->subsistema_combate($executor->game, $executor->action, $executor->pj1, $executor->pj2);

		else return "Faltó por especificar algún elemento necesario";
	}

	public function subsistema_tiradas($game, $action, $skill, $pj1, $var){
		$cadena = __DIR__."/".$game."/".$action.".php";
		$var = '';
		require_once($cadena);
		if($executor->game="DD35") $this->em->flush();
		else $this->ev->flush();
		return $res;
	}

	public function subsistema_magia($game, $action, $pj1, $pj2, $spell){
		$cadena = __DIR__."/".$game."/".$action.".php";
		$var = 0;
		require_once($cadena);
		if($executor->game="DD35") $this->em->flush();
		else $this->ev->flush();
		return $res;
	}

	public function subsistema_combate($game, $action, $pj1, $pj2, $CD){
		$cadena = __DIR__."/".$game."/".$action.".php";
		$var = 0;
		require_once($cadena);
		if($executor->game="DD35") $this->em->flush();
		else $this->ev->flush();
		return $res;
	}
}

?>