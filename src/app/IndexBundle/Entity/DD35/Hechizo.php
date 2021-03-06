<?php

namespace app\IndexBundle\Entity\DD35;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Hechizo", schema="reglas")
 */

class Hechizo{

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
     * @ORM\Column(type="integer")
     */

	public $nivel;

	/**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = "0",
     *      max = "100",
     *      minMessage = "No se pueden tener estadísticas negativas."
     * )
     */

	public $dado;

	/**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = "0",
     *      max = "100",
     *      minMessage = "No se pueden tener estadísticas negativas."
     * )
     */

	public $danoBase;

	/**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = "0",
     *      max = "100",
     *      minMessage = "No se pueden tener estadísticas negativas."
     * )
     */

	public $danoNivel;

	/**
     * @ORM\Column(type="boolean")
     */

	public $curacion;

	/**
     * @ORM\Column(type="string", length=30)
     */

	public $efecto;

	/**
     * @ORM\Column(type="string", length=30)
     */

	public $salvacion;

	/**
     * @ORM\Column(type="string", length=30)
     */

	public $efectoSalvacion;

	function __construct($Nombre, $Nivel, $Dado, $DanoBase, $DanoNivel, $Curacion, $Efecto, $Salvacion, $EfectoSalvacion){
		$this->nombre = $Nombre;
		$this->nivel = $Nivel;
		$this->dado = $Dado;
		$this->danoBase = $DanoBase;
		$this->danoNivel = $DanoNivel;
		$this->curacion = $Curacion;
		$this->efecto = $Efecto;
		$this->salvacion = $Salvacion;
		$this->efectoSalvacion = $EfectoSalvacion;
	}

}

?>