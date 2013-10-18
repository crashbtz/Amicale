<?php

namespace Amicale\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends Controller {

    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        //par defaut c'est la 1ère categorie qui est affiché
        if(!$request->query->get('statut')){
            $statut = 'encours';
        }
        //sinon c'est celle qui a était sélectionnée via le menu
        else{
            $statut = $request->query->get('statut');
        } 
        
        
        
        return $this->render('AmicaleAccueilBundle:Commande:index.html.twig', array());
    }
}
