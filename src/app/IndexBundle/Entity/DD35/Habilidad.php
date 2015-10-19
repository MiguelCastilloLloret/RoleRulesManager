<?php

namespace app\IndexBundle\Entity\DD35;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Habilidad", schema="reglas")
 */

class Habilidad{
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