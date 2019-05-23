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

		error_reporting(E_ALL);
		ini_set('display_errors', '1');

		if(is_null($executor->pj1)) return "";

		//Ejecucion de los subsistemas

		if($executor->CD != 0 || !is_null($executor->skill)){
			return $this->subsistema_tiradas($executor);
		}
		else if(!is_null($executor->spell)){
			return $this->subsistema_magia($executor);
		}
		else if($executor->action == "Ataque" && !is_null($executor->pj2)) return $this->subsistema_combate($executor);

		else return "Faltó por especificar algún elemento necesario.";
	}

	public function subsistema_tiradas($executor){
		$cadena = __DIR__."/".$executor->game."/".$executor->action.".php";
		$var = '';
		require_once($cadena);
		if($executor->game="DD35") $this->em->flush();
		else $this->ev->flush();
		return $res;
	}

	public function subsistema_magia($executor){
		$cadena = __DIR__."/".$executor->game."/".$executor->action.".php";
		$var = 0;
		require_once($cadena);
		if($executor->game="DD35") $this->em->flush();
		else $this->ev->flush();
		return $res;
	}

	public function subsistema_combate($executor){
		$cadena = __DIR__."/".$executor->game."/".$executor->action.".php";
		$var = 0;
		require_once($cadena);
		if($executor->game="DD35") $this->em->flush();
		else $this->ev->flush();
		return $res;
	}
}

?>