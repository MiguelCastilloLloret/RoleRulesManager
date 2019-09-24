<?php

namespace app\IndexBundle\Tests;

use app\IndexBundle\PartidaEncoder;
use PHPUnit\Framework\TestCase;

class EncoderTest extends TestCase{
	
	public function testEncode(){
		
		$encoder = new PartidaEncoder();
		$password = 'RbF$Nx31GIeY';

		$encoded = $encoder->encodePassword($party->password,$encoder->salt);

		$this->assertEquals('3cea9b6e563cf71e710130925419d44cb4afc0173b61ce851a7df18a8e3cafd3', $encoded);

	}

	public function testDecode(){

		$encoder = new PartidaEncoder();
		$password = '3cea9b6e563cf71e710130925419d44cb4afc0173b61ce851a7df18a8e3cafd3';
		$decoded = '';

		$flag = $encoder->isPasswordValid($decoded, $password, $encoder->salt);

		$this->assertEquals('RbF$Nx31GIeY',$decoded);

	}
}