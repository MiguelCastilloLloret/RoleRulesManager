<?php

namespace app\IndexBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DD35ControllerTest extends WebTestCase
{
    public function testDD35LoggedReach()
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
        $form['form[game]']->select('DD35Master');

        $crawler = $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect('/DD35Master'));
        $crawler = $client->followRedirect();
		$this->assertEquals(200, $client->getResponse()->getStatusCode());

		$this->assertGreaterThan(0, $crawler->filter('h1')->count());
		$this->assertequals(1, $crawler->filter('h1:contains("Menú del Master: D&D 3.5")')->count());
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

    public function testDD35NotLoggedReach()
    {
        $client = static::createClient();

        $crawler = $client->request('GET','/DD35Master');

		$this->assertFalse($client->getResponse()->isRedirect('http://localhost/DD35Master'));
		$this->assertTrue($client->getResponse()->isRedirect('http://localhost/login'));
		$crawler = $client->followRedirect();
		$this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testDD35CrearPersonaje()
    {
    	$client = static::createClient();

        $crawler = $client->request('GET','/DD35Master');
    }

    public function testDD35CrearPersonajeFailed()
    {

    }

    public function testDD35ModificarPersonaje()
    {

    }

    public function testDD35ModificarPersonajeFailed()
    {

    }

    public function testDD35EliminarPersonaje()
    {

    }

    public function testDD35EliminarPersonajeFailed()
    {

    }

    public function testDD35CrearPlantilla()
    {

    }

    public function testDD35CrearPlantillaFailed()
    {

    }

    public function testDD35EliminarPlantilla()
    {

    }

    public function testDD35EliminarPlantillaFailed()
    {

    }

    public function testDD35CrearArma()
    {

    }

    public function testDD35CrearArmaFailed()
    {

    }

    public function testDD35ModificarArma()
    {

    }

    public function testDD35ModificarArmaFailed()
    {

    }

    public function testDD35CrearPartida()
    {

    }

    public function testDD35CrearPartidaFailed()
    {

    }

    public function testDD35EliminarPartida()
    {

    }

    public function testDD35EliminarPartidaFailed()
    {

    }

}
