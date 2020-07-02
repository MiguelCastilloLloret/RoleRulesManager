<?php

namespace app\IndexBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Cunningsoft\ChatBundle\Entity\AuthorInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User implements UserInterface, AuthorInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", unique=true)
     * @Assert\Email(
     *     message = "'{{ value }}' no es un correo válido.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", length=64)
     */
    private $password;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 6,
     *      max = 20,
     *      minMessage = "La contraseña debe tener al menos {{ limit }} caracteres",
     *      maxMessage = "La contraseña no puede tener más de {{ limit }} caracteres"
     * )
     */

    private $plainPassword;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function __toString()
    {
        return $this->email;
    }
}