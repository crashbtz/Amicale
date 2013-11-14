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
    
    /**
     * @Template("AmicaleAccueilBundle:Commande:menu_commande.html.twig")
     */
    public function getMenuCommandes(){
        $response = new Response();
        $response->setSharedMaxAge(300); # en secondes, donc environ 10 minutes
        $response->setPrivate();        
        $response->setMaxAge(300);
        echo 'ici';exit;
        // Check that the Response is not modified for the given Request
        if (!$response->isNotModified($this->getRequest())) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('AmicaleAccueilBundle:StatutCommande');
            if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
                $menus = $repository->getMenuCommande('admin');
            }
            else{
                $menus = $repository->getMenuCommande(null);
            }
            $date = new \DateTime();
            $response->setLastModified($date);
            $response->setContent($this->renderView('AmicaleAccueilBundle:Commande:menu_commande.html.twig', array('menus' => $menus)));       
        }
        return $response;
    }
}
