<?php

namespace app\IndexBundle\Entity\DD35;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Arma", schema="reglas")
 */

class Arma{
	/**function __construct($Nombre, $Dado, $Dano, $Bonus){
		$this->nombre = $Nombre;
		$this->dado = $Dado;
		$this->dano = $Dano;
		$this->bonus = $Bonus;
	}
	*/

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

	public $dado;

	/**
     * @ORM\Column(type="integer")
     */

	public $dano;

	/**
     * @ORM\Column(type="string", length=30)
     */

	public $bonus;
}

?>