<?php

namespace app\IndexBundle\Entity\Vampiro;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vArma", schema="reglasv")
 */

class vArma{
	/**function __construct($Nombre, $Ocultacion, $Dano, $Tipo, $Cadencia){
		$this->nombre = $Nombre;
		$this->ocultacion = $Ocultacion;
		$this->dano = $Dano;
		$this->tipo = $Tipo;
		$this->cadencia = $Cadencia;
	}
	*/

	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */

	public $ID;

	/**
     * @ORM\Column(type="string", length=15)
     */

	public $nombre;

	/**
     * @ORM\Column(type="string", length=1)
     */

	public $ocultacion;

	/**
     * @ORM\Column(type="integer")
     */

	public $dano;

	/**
     * @ORM\Column(type="string", length=30)
     */

	public $tipo;

	/**
     * @ORM\Column(type="integer")
     */

	public $cadencia;
}

?>