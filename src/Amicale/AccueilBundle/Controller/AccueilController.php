<?php

namespace Amicale\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AmicaleAccueilBundle:Produit');
        $produits = $repository->getLastRecents(5);
        return $this->render('AmicaleAccueilBundle:Accueil:index.html.twig', array('produits' => $produits));
    }

}
