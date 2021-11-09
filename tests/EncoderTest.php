<?php

namespace app\IndexBundle\Tests;

use app\IndexBundle\Controller\PartidaEncoder;
use PHPUnit\Framework\TestCase;

class EncoderTest extends TestCase{
	
	public function testEncode(){

		$encoder = new PartidaEncoder();
		$password = 'RbF$Nx31GIeY';

		$encoded = $encoder->encodePassword($password,$encoder->salt);

		$this->assertEquals('3cea9b6e563cf71e710130925419d44cb4afc0173b61ce851a7df18a8e3cafd3', $encoded);

	}

	public function testDecode(){

		$encoder = new PartidaEncoder();
		$password = '3cea9b6e563cf71e710130925419d44cb4afc0173b61ce851a7df18a8e3cafd3';
		$passwordraw = 'RbF$Nx31GIeY';
		$decoded = '';

		$flag = $encoder->isPasswordValid($password, $passwordraw, $encoder->salt);

		$this->assertEquals(1,$flag);

		$passwordraw = 'pato';

		$flag = $encoder->isPasswordValid($password, $passwordraw, $encoder->salt);

		$this->assertEquals(0,$flag);

	}
}

?>