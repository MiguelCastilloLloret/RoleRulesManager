<?php

namespace app\IndexBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DD35ControllerTest extends WebTestCase
{
    public function testDd35()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/DD35Master');
    }

}
