<?php

namespace app\IndexBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase{
	
	public function testLogin(){

		$client = static::createClient();

		$crawler = $client->request('GET','/login');

		$this->assertGreaterThan(0, $crawler->filter('h1')->count());

		$this->assertGreaterThan(0, $crawler->filter('h1:contains("Sistema intérprete de reglas Rol")')->count());

		$this->assertGreaterThan(0, $crawler->filter('label')->count());

		$this->assertGreaterThan(0, $crawler->filter('label:contains("Email:")')->count());

		$this->assertGreaterThan(0, $crawler->filter('label:contains("Contraseña:")')->count());

		$form = $crawler->filter('form')->form();

		$form['_username'] = 'miguel.castillolloret@alum.uca.es';
		$form['_password'] = 'tonto';

		$crawler = $client->submit($form);

		$this->assertEquals(302, $client->getResponse()->getStatusCode());

		var_dump($client->getResponse()->getContent());

	}

	public function testWrongLogin(){

		$client = static::createClient();

		$crawler = $client->request('GET','/login');

		$this->assertGreaterThan(0, $crawler->filter('h1')->count());

		$this->assertGreaterThan(0, $crawler->filter('h1:contains("Sistema intérprete de reglas Rol")')->count());

		$this->assertGreaterThan(0, $crawler->filter('label')->count());

		$this->assertGreaterThan(0, $crawler->filter('label:contains("Email:")')->count());

		$this->assertGreaterThan(0, $crawler->filter('label:contains("Contraseña:")')->count());

		$form = $crawler->filter('form')->form();

		$form['_username'] = 'miguel.castillolloret@alum.uca.es';
		$form['_password'] = 'tonta';

		$crawler = $client->submit($form);

		$this->assertEquals(302, $client->getResponse()->getStatusCode());

		$this->assertTrue($client->getResponse()->isRedirect('http://localhost/login'));

	}
}

?>