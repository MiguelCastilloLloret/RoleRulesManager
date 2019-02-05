<?php

namespace app\IndexBundle\Entity\DD35;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Personaje", schema="reglas")
 */

class Personaje{

	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */

	public $ID;

	 /**
     * @ORM\Column(type="string", length=30)
     */

	public $nombre;

	 /**
     * @ORM\Column(type="string", length=15)
     */

	public $clase;

	/**
     * @ORM\Column(type="integer")
     */

	public $nivel;

	/**
     * @ORM\Column(type="integer")
     */

	public $puntosVida;

	/**
     * @ORM\Column(type="integer")
     */

	public $vidaMaxima;

	/**
     * @ORM\Column(type="integer")
     */

	public $claseArmadura;

	/**
     * @ORM\Column(type="integer")
     */

	public $bonusFuerza;
	
	/**
     * @ORM\Column(type="integer")
     */

	public $bonusDestreza;

	/**
     * @ORM\Column(type="integer")
     */

	public $bonusConstitucion;

	/**
     * @ORM\Column(type="integer")
     */

	public $bonusInteligencia;

	/**
     * @ORM\Column(type="integer")
     */

	public $bonusSabiduria;

	/**
     * @ORM\Column(type="integer")
     */

	public $bonusCarisma;

	/**
     * @ORM\Column(type="integer")
     */

	public $salvacionVoluntad;

	/**
     * @ORM\Column(type="integer")
     */

	public $salvacionFortaleza;

	/**
     * @ORM\Column(type="integer")
     */

	public $salvacionReflejos;

	/**
     * @ORM\Column(type="string", length=30)
     */

	public $estado;

	/**
     * @ORM\Column(type="integer", nullable=true)
     */

	public $resistenciaMagica;

	/**
     * @ORM\Column(type="integer")
     */

	public $reduccionDano;

	 /**
     * @ORM\Column(type="string", length=15)
     */

	public $arma;

		 /**
     * @ORM\Column(type="string", length=15)
     */

	public $partida;

		/**
     * @ORM\Column(type="integer")
     */

	public $usuario;

	/*function __construct($Nombre, $Clase, $Nivel, $PuntosVida, $ClaseArmadura, $BonusFuerza, $BonusDestreza, $BonusConstitucion, $BonusInteligencia, $BonusSabiduria, $BonusCarisma, $SalvacionVoluntad, $SalvacionFortaleza, $SalvacionReflejos, $Estado, $ResistenciaMagica, $ReduccionDano, $Arma){
		$this->nombre = $Nombre;
		$this->clase = $Clase;
		$this->nivel = $Nivel;
		$this->puntosVida = $PuntosVida;
		$this->claseArmadura = $ClaseArmadura;
		$this->bonusFuerza = $BonusFuerza;
		$this->bonusDestreza = $BonusDestreza;
		$this->bonusConstitucion = $BonusConstitucion;
		$this->bonusInteligencia = $BonusInteligencia;
		$this->bonusSabiduria = $BonusSabiduria;
		$this->bonusCarisma = $BonusCarisma;
		$this->salvacionVoluntad = $SalvacionVoluntad;
		$this->salvacionFortaleza = $SalvacionFortaleza;
		$this->salvacionReflejos = $SalvacionReflejos;
		$this->estado = $Estado;
		$this->resistenciaMagica = $ResistenciaMagica;
		$this->reduccionDano = $ReduccionDano;
		$this->arma = $Arma;
	}*/

	public function aplicar_efecto($fuente, $efecto, $bonus = 0){
		if($fuente == "Ataque"){
			$efecto = $efecto+$this->reduccionDano;
			if($efecto>0) $efecto = 0;
			$this->puntosVida = $this->puntosVida+$efecto;
		}
		else{
			if($fuente->salvacion != ""){ 
				$CD = 10+$fuente->nivel+$bonus;
				if($fuente->salvacion == "Fortaleza") $salvacion = rand(1,20)+$this->salvacionFortaleza;
				else if($fuente->salvacion == "Voluntad") $salvacion = rand(1,20)+$this->salvacionVoluntad;
				else $salvacion = rand(1,20)+$this->salvacionReflejos;
				if($salvacion>$CD){
					if($fuente->efectoSalvacion == "Mitad"){
						$efecto = round($efecto/2);
					}
					else{
						$efecto = 0;
					}
				}
			}
			if(is_numeric($efecto)){
				if($efecto<0){
					$efecto = $efecto+$this->resistenciaMagica;
					if($efecto>0) $efecto = 0;
				}
				$this->puntosVida = $this->puntosVida+$efecto;
			}
			else $this->estado = $efecto;
		}
		return $efecto;
	}

}

?>