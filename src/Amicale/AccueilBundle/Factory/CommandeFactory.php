<?php

namespace Amicale\AccueilBundle\Factory;


use Amicale\AccueilBundle\Entity\StatutCommandeRepository;
use Amicale\AccueilBundle\Entity\Commande;
/**
 * Amicale\AccueilBundle\Factory\CommandeFactory
 */
class CommandeFactory {
    public function __construct() {
        
    }
    
    public function getNewCommande(){
        $statutcommanderepos = new StatutCommandeRepository();
        $statutcommande = $statutcommanderepos->find(1);
        $commande = new Commande();
        $commande->setStatutCommande($statutcommande);
    }
}

?>