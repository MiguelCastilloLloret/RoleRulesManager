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

		$this->assertTrue($client->getResponse()->isRedirect('http://localhost/'));

		$crawler = $client->followRedirect();

		$this->assertEquals(200, $client->getResponse()->getStatusCode());

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

		$this->assertTrue($client->getResponse()->isRedirect('http://localhost/login'));

		$crawler = $client->followRedirect();

		$this->assertEquals(200, $client->getResponse()->getStatusCode());

		$this->assertGreaterThan(0, $crawler->filter('h3')->count());

		$this->assertGreaterThan(0, $crawler->filter('h3:contains("Error")')->count());

		$form = $crawler->filter('form')->form();

		$form['_username'] = 'migueel.castillolloret@alum.uca.es';
		$form['_password'] = 'tonto';

		$crawler = $client->submit($form);

		$this->assertTrue($client->getResponse()->isRedirect('http://localhost/login'));

		$crawler = $client->followRedirect();

		$this->assertEquals(200, $client->getResponse()->getStatusCode());

		$this->assertGreaterThan(0, $crawler->filter('h3')->count());

		$this->assertGreaterThan(0, $crawler->filter('h3:contains("Error")')->count());

	}

	public function testRegister(){

		$client = static::createClient();

		$crawler = $client->request('GET','/registro');

		$this->assertGreaterThan(0, $crawler->filter('h1')->count());

		$this->assertGreaterThan(0, $crawler->filter('h1:contains("Registro")')->count());

		$this->assertGreaterThan(0, $crawler->filter('label')->count());

		$this->assertGreaterThan(0, $crawler->filter('label:contains("Email")')->count());

		$this->assertGreaterThan(0, $crawler->filter('label:contains("Contraseña")')->count());

		$this->assertGreaterThan(0, $crawler->filter('label:contains("Repetir Contraseña")')->count());

		$form = $crawler->filter('form')->form();

		$form['app_indexbundle_user[email]'] = 'anikiladorDX@gmail.com';
		$form['app_indexbundle_user[plainPassword][first]'] = 'pardisimo';
		$form['app_indexbundle_user[plainPassword][second]'] = 'pardisimo';

		$crawler = $client->submit($form);

		$this->assertTrue($client->getResponse()->isRedirect('/login'));

		$crawler = $client->followRedirect();

		$this->assertEquals(200, $client->getResponse()->getStatusCode());

	}

	public function testWrongRegister(){

		$client = static::createClient();

		$crawler = $client->request('GET','/registro');

		$this->assertGreaterThan(0, $crawler->filter('h1')->count());

		$this->assertGreaterThan(0, $crawler->filter('h1:contains("Registro")')->count());

		$this->assertGreaterThan(0, $crawler->filter('label')->count());

		$this->assertGreaterThan(0, $crawler->filter('label:contains("Email")')->count());

		$this->assertGreaterThan(0, $crawler->filter('label:contains("Contraseña")')->count());

		$this->assertGreaterThan(0, $crawler->filter('label:contains("Repetir Contraseña")')->count());

		$form = $crawler->filter('form')->form();

		$form['app_indexbundle_user[email]'] = 'anikiladorDX@gmail.com';
		$form['app_indexbundle_user[plainPassword][first]'] = 'pardos';
		$form['app_indexbundle_user[plainPassword][second]'] = 'pardos';

		$crawler = $client->submit($form);

		$this->assertEquals(200, $client->getResponse()->getStatusCode());

		$this->assertGreaterThan(0, $crawler->filter('div:contains("Este usuario ya existe")')->count());

		$form = $crawler->filter('form')->form();

		$form['app_indexbundle_user[email]'] = 'miguel.castillolloret@gmail.com';
		$form['app_indexbundle_user[plainPassword][first]'] = 'pardo';
		$form['app_indexbundle_user[plainPassword][second]'] = 'pardo';

		$crawler = $client->submit($form);

		$this->assertEquals(200, $client->getResponse()->getStatusCode());

		$this->assertGreaterThan(0, $crawler->filter('li:contains("La contraseña debe tener al menos 6 caracteres")')->count());

		$form = $crawler->filter('form')->form();

		$form['app_indexbundle_user[email]'] = 'anikiladorDX';
		$form['app_indexbundle_user[plainPassword][first]'] = 'pardos';
		$form['app_indexbundle_user[plainPassword][second]'] = 'pardos';

		$crawler = $client->submit($form);

		$this->assertEquals(200, $client->getResponse()->getStatusCode());

		$this->assertGreaterThan(0, $crawler->filter('li:contains(""anikiladorDX" no es un correo válido.")')->count());
	}
}

?>