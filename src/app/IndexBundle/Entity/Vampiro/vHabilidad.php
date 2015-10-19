<?php

namespace app\IndexBundle\Entity\Vampiro;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vHabilidad", schema="reglasv")
 */

class vHabilidad{
	public function __construct($Nombre, $AtributoAsociado){
		$this->nombre = $Nombre;
		$this->atributoAsociado = $AtributoAsociado;
	}

	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */

	private $ID;

	/**
     * @ORM\Column(type="string", length=30)
     */

	public $nombre;

	/**
     * @ORM\Column(type="string", length=30)
     */

	public $atributoAsociado;
}

?>