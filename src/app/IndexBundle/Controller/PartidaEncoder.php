<?php

namespace app\IndexBundle\Controller;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class Sha256Salted implements PasswordEncoderInterface{

	public $salt = 'salt5678901234567890123456789012';

    public function encodePassword($raw){
		return hash('sha256', $this->salt . $raw); // Custom function for encrypt with sha256
    }

    public function isPasswordValid($encoded, $raw){
        return $encoded === $this->encodePassword($raw, $this->salt);
    }

}