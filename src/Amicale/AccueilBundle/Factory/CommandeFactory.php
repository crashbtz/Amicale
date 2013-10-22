<?php

namespace Amicale\AccueilBundle\Factory;

//use Amicale\AccueilBundle\Entity\StatutCommandeRepository;
use Amicale\AccueilBundle\Entity\Commande;
/**
 * Amicale\AccueilBundle\Factory\CommandeFactory
 */
class CommandeFactory {
    private $em;
    private $security_context;


    public function __construct($em, $security_context) {
        $this->em = $em;
        $this->security_context = $security_context;
    }
    
    public function getNewCommande(){
        $statutcommanderepos = $this->em->getRepository('AmicaleAccueilBundle:StatutCommande');
        $statutcommande = $statutcommanderepos->find(1);
        $commande = new Commande();
        $commande->setStatutCommande($statutcommande);
        $user= $this->security_context->getToken()->getUser();
        $commande->setUser($user);
        
        return $commande;
    }
}

?>