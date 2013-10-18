<?php

namespace Amicale\AccueilBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
//        $client = static::createClient();
//
//        $crawler = $client->request('GET', '/hello/Fabien');
//
//        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
        $commande = new \Amicale\AccueilBundle\Entity\Commande();
        $result = $commande->add(30, 12);
        $this->assertEquals(42,$result);
    }
}
