<?php

namespace app\IndexBundle\Entity\DD35;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Partida", schema="reglas")
 */

class Partida{

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
     * @ORM\Column(type="string", length=100)
     */

	public $password;

     /**
     * @ORM\Column(type="string", length=50)
     */

     public $creador;
}

?>