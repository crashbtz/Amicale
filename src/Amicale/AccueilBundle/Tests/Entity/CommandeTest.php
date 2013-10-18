<?php

namespace Amicale\AccueilBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommandeTest extends WebTestCase
{
    public function testIndex()
    {
        $commande = new \Amicale\AccueilBundle\Entity\Commande();
        $result = $commande->add(1, 2);
        $this->assertEquals(7,$result);
        $result = $commande->add(2, 1);
        $this->assertEquals(0,$result);
    }
}
