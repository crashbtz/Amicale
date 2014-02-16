<?php

namespace Amicale\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AccueilController extends Controller {

    public function indexAction() {
        $response = new Response();
        $response->setSharedMaxAge(300); # en secondes, donc environ 10 minutes
        $response->setPublic();        
        $response->setMaxAge(300);
        // Check that the Response is not modified for the given Request
        if (!$response->isNotModified($this->getRequest())) {
            // return the 304 Response immediately
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('AmicaleAccueilBundle:Produit');
            $produits = $repository->getLastRecents(5);
            $date = new \DateTime();
            $response->setLastModified($date);
            $response->setContent($this->render('AmicaleAccueilBundle:Accueil:index.html.twig', array('produits' => $produits)));       
        }

        return $response;
    }

}
