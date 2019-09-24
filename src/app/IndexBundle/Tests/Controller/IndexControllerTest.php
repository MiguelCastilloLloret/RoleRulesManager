<?php

namespace app\IndexBundle\Tests\Controller;

use app\IndexBundle\Controller\IndexController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase{
	
	public function testIndex(){

		$client = static::createClient();

		$crawler = $client->request('GET','/');

		$this->assertGreaterThan(0, $crawler->filter('h1')->count());

		$this->assertGreaterThan(0, $crawler->filter('h1:contains("Sistema intérprete de reglas Rol")')->count();

		$this->assertGreaterThan(0, $crawler->filter('label')->count());

		$this->assertGreaterThan(0, $crawler->filter('label:contains("Email:")')->count();

		$this->assertGreaterThan(0, $crawler->filter('label:contains("Contraseña:")')->count();

		$form = $crawler->selectButton('submit')->form();

		$form['username'] = 'miguel.castillolloret@alum.uca.es';
		$form['password'] = 'tonto';

		$crawler = $client->submit($form);

		$this->assertEquals(200, $client->getResponse()->getStatusCode());

	}
}