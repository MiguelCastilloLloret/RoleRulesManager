<?php

namespace app\IndexBundle\Controller;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class PartidaEncoder implements PasswordEncoderInterface{

	public $salt = '';

    public function encodePassword($raw, $salt){
		return hash('sha256', $salt . $raw); // Custom function for encrypt with sha256
    }

    public function isPasswordValid($encoded, $raw, $salt){
        return $encoded === $this->encodePassword($raw, $salt);
    }
    }

}