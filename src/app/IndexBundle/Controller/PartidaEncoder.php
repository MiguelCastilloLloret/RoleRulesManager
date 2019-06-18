<?php

namespace app\IndexBundle\Controller;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class PartidaEncoder implements PasswordEncoderInterface{

	public $salt = 'salt5678901234567890123456789012';

    public function encodePassword($raw, $salt){
		return hash('sha256', $salt . $raw); // Custom function for encrypt with sha256
    }

    public function isPasswordValid($encoded, $raw, $salt){
    	ob_start();
        var_dump( $this->encodePassword($raw, $salt) );                    // start buffer capture
        $contents = ob_get_contents(); // put the buffer into a variable
        ob_end_clean();                // end capture
        error_log( $contents );
        return $encoded === $this->encodePassword($raw, $salt);
    }

}