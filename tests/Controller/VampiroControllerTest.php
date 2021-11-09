<?php

namespace app\IndexBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VampiroControllerTest extends WebTestCase
{
public function testVampiroLoggedReach()
    {
        $client = static::createClient();

        $crawler = $client->request('GET','/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $form = $crawler->filter('form')->form();
		$form['_username'] = 'miguel.castillolloret@alum.uca.es';
		$form['_password'] = 'tonto';

		$crawler = $client->submit($form);
		$crawler = $client->followRedirect();

		$this->assertGreaterThan(0, $crawler->filter('h1')->count());
		$this->assertEquals(1, $crawler->filter('h1:contains("Menú del Master")')->count());
		$this->assertGreaterThan(0, $crawler->filter('a.nav-link')->count());
		$this->assertEquals(1, $crawler->filter('a.nav-link:contains("miguel.castillolloret@alum.uca.es")')->count());
		$this->assertGreaterThan(0, $crawler->filter('label')->count());
		$this->assertEquals(1, $crawler->filter('label:contains("Juego")')->count());

        $form = $crawler->filter('form')->form();
        $form['form[game]']->select('VampiroMaster');

        $crawler = $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect('/VampiroMaster'));
        $crawler = $client->followRedirect();

		$this->assertEquals(200, $client->getResponse()->getStatusCode());

		$this->assertGreaterThan(0, $crawler->filter('h1')->count());
		$this->assertequals(1, $crawler->filter('h1:contains("Menú del Master: Vampiro la Mascarada")')->count());
		$this->assertGreaterThan(0, $crawler->filter('div.wrap')->count());
		$this->assertEquals(9, $crawler->filter('a.btn-primary')->count());
		$this->assertequals(1, $crawler->filter('a.btn-primary:contains("Crear Personaje")')->count());
		$this->assertequals(1, $crawler->filter('a.btn-primary:contains("Modificar Personaje")')->count());
		$this->assertequals(1, $crawler->filter('a.btn-primary:contains("Eliminar Personaje")')->count());
		$this->assertequals(1, $crawler->filter('a.btn-primary:contains("Crear Plantilla")')->count());
		$this->assertequals(1, $crawler->filter('a.btn-primary:contains("Eliminar Plantilla")')->count());
		$this->assertequals(1, $crawler->filter('a.btn-primary:contains("Crear Arma")')->count());
		$this->assertequals(1, $crawler->filter('a.btn-primary:contains("Modificar Arma")')->count());
		$this->assertequals(1, $crawler->filter('a.btn-primary:contains("Crear Partida")')->count());
		$this->assertequals(1, $crawler->filter('a.btn-primary:contains("Eliminar Partida")')->count());
    }

    public function testVampiroNotLoggedReach()
    {
        $client = static::createClient();

        $crawler = $client->request('GET','/VampiroMaster');

		$this->assertFalse($client->getResponse()->isRedirect('http://localhost/VampiroMaster'));
		$this->assertTrue($client->getResponse()->isRedirect('http://localhost/login'));
		$crawler = $client->followRedirect();
		$this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testVampiroCrearPersonaje()
    {
    	$client = static::createClient();

        $crawler = $client->request('GET','/VampiroMaster');
    }

    public function testVampiroCrearPersonajeFailed()
    {

    }

    public function testVampiroModificarPersonaje()
    {

    }

    public function testVampiroModificarPersonajeFailed()
    {

    }

    public function testVampiroEliminarPersonaje()
    {

    }

    public function testVampiroEliminarPersonajeFailed()
    {

    }

    public function testVampiroCrearPlantilla()
    {

    }

    public function testVampiroCrearPlantillaFailed()
    {

    }

    public function testVampiroEliminarPlantilla()
    {

    }

    public function testVampiroEliminarPlantillaFailed()
    {

    }

    public function testVampiroCrearArma()
    {

    }

    public function testVampiroCrearArmaFailed()
    {

    }

    public function testVampiroModificarArma()
    {

    }

    public function testVampiroModificarArmaFailed()
    {

    }

    public function testVampiroCrearPartida()
    {

    }

    public function testVampiroCrearPartidaFailed()
    {

    }

    public function testVampiroEliminarPartida()
    {

    }

    public function testVampiroEliminarPartidaFailed()
    {

    }

}

