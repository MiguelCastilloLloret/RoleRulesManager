<?php

namespace app\IndexBundle\Entity\Vampiro;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="vPlantilla", schema="reglasv")
 */

class vPlantilla{

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

	public $clan;

	/**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = "0",
     *      max = "100",
     *      minMessage = "No se pueden tener estadísticas negativas."
     * )
     */

	public $generacion;

	/**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = "0",
     *      max = "100",
     *      minMessage = "No se pueden tener estadísticas negativas."
     * )
     */

	public $puntosVida;

	/**
     * @ORM\Column(type="integer")
     */

	public $armadura;

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

	public $bonusResistencia;

	/**
     * @ORM\Column(type="integer")
     */

	public $bonusCarisma;

	/**
     * @ORM\Column(type="integer")
     */

	public $bonusManipulacion;

	/**
     * @ORM\Column(type="integer")
     */

	public $bonusApariencia;

	/**
     * @ORM\Column(type="integer")
     */

	public $bonusPercepcion;

	/**
     * @ORM\Column(type="integer")
     */

	public $bonusInteligencia;

	/**
     * @ORM\Column(type="integer")
     */

	public $bonusAstucia;

	/**
     * @ORM\Column(type="integer")
     */

	public $conciencia;

	/**
     * @ORM\Column(type="integer")
     */

	public $autocontrol;

	/**
     * @ORM\Column(type="integer")
     */

	public $coraje;

	/**
     * @ORM\Column(type="string", length=30)
     */

	public $estado;

	/**
     * @ORM\Column(type="integer")
     */

	public $fuerzaVoluntad;

	/**
     * @ORM\Column(type="integer")
     */

	public $sangre;

	 /**
     * @ORM\Column(type="string", length=15)
     */

	public $arma;

	 /**
     * @ORM\Column(type="integer")
     */

	public $fortaleza;

	/**
     * @ORM\Column(type="integer")
     */

	public $armasDeFuego;

	/**
     * @ORM\Column(type="integer")
     */

	public $informatica;

	/**
     * @ORM\Column(type="integer")
     */

	public $armasCaC;

	/**
     * @ORM\Column(type="integer")
     */

	public $diplomacia;

	/**
     * @ORM\Column(type="integer")
     */

	public $atletismo;

	/**
     * @ORM\Column(type="integer")
     */

	public $pelea;

	/**
     * @ORM\Column(type="integer")
     */

	public $investigacion;

		 /**
     * @ORM\Column(type="string", length=15)
     */

	/*function __construct($Nombre, $Clan, $Generacion, $PuntosVida, $Armadura, $BonusFuerza, $BonusDestreza, $BonusResistencia, $BonusCarisma, $BonusManipulacion, $BonusApariencia, $BonusPercepcion, $BonusInteligencia, $BonusAstucia, $Conciencia, $Autocontrol, $Coraje, $Estado, $FuerzaVoluntad, $Sangre, $Arma, $Habilidades){
		$this->nombre = $Nombre;
		$this->clan = $Clan;
		$this->generacion = $Generacion;
		$this->puntosVida = $PuntosVida;
		$this->armadura = $Armadura;
		$this->bonusFuerza = $BonusFuerza;
		$this->bonusDestreza = $BonusDestreza;
		$this->bonusResistencia = $BonusResistencia;
		$this->bonusInteligencia = $BonusInteligencia;
		$this->bonusManipulacion = $BonusManipulacion;
		$this->bonusApariencia = $BonusApariencia;
		$this->bonusPercepcion = $BonusPercepcion;
		$this->bonusAstucia = $BonusAstucia;
		$this->bonusCarisma = $BonusCarisma;
		$this->conciencia = $Conciencia;
		$this->autocontrol = $Autocontrol;
		$this->coraje = $Coraje;
		$this->estado = $Estado;
		$this->fuerzaVoluntad = $FuerzaVoluntad;
		$this->sangre = $Sangre;
		$this->arma = $Arma;
		$this->habilidades = $Habilidades;
	}*/

}

?>