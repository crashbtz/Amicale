<?php

namespace Amicale\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends Controller {

    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        // On récupère le repository Categorie
        $repository = $em->getRepository('AmicaleAccueilBundle:Categorie');
        $categories = $repository->getAllCategories();
        //par defaut c'est la 1ère categorie qui est affiché
        if(!$request->query->get('id')){
            $id = $categories[0]->getId();
        }
        //sinon c'est celle qui a était sélectionnée via le menu
        else{
            $id = $request->query->get('id');
        }        
              
        $repository = $em->getRepository('AmicaleAccueilBundle:TypeProduit');
        $typeProduits = $repository->findBy(array('categorie' => $id), array('nom' => 'asc'));
        //on recupere ensuite les produits concernés par la catégorie
        $repository = $em->getRepository('AmicaleAccueilBundle:Produit');
        $produits = $repository->findByCategorie($id);
        
        return $this->render('AmicaleAccueilBundle:Produit:index.html.twig', array('categories' => $categories, 'id' => $id, 'produits' => $produits, 'typeProduits' => $typeProduits));
    }
    
    /**
     * @Template("AmicaleAccueilBundle:Produit:menu_produit.html.twig")
     */
    public function getMenuProduitAction(){
        $response = new Response();
        $response->setSharedMaxAge(300); # en secondes, donc environ 10 minutes
        $response->setPublic();        
        $response->setMaxAge(300);
        // Check that the Response is not modified for the given Request
        if (!$response->isNotModified($this->getRequest())) {
            // return the 304 Response immediately
            $em = $this->getDoctrine()->getManager();
            // On récupère le repository Categorie
            $repository = $em->getRepository('AmicaleAccueilBundle:Categorie');
            $categories = $repository->getAllCategories();
            $date = new \DateTime();
            $response->setLastModified($date);
            $response->setContent($this->renderView('AmicaleAccueilBundle:Produit:menu_produit.html.twig', array('categories' => $categories)));       
        }
        return $response;
        //return $this->render('AmicaleAccueilBundle:Produit:menu_produit.html.twig', array('categories' => $categories));
    }
    
    public function filtreProduitsAction(Request $request) {
        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('AmicaleAccueilBundle:Produit');
            if($request->get('typeproduits') && $request->get('typeproduits') !== ''){
                $typeproduits = $request->get('typeproduits');
                $typeproduits = explode('*', $typeproduits);
                $min = $request->get('min');
                $max = $request->get('max');
                $produits = $repository->findByTypeproduitsAndPrix($typeproduits, $min, $max);
                
            }
            else if($request->get('id') && $request->get('id') != ''){
                $produits = $repository->findByCategorie($request->get('id'));
            }
            else{
                return new Response('error');
            }
            return $this->container->get('templating')->renderResponse('AmicaleAccueilBundle:Produit:content_produit.html.twig', array('produits' => $produits));
        }
    }
    
    public function createNewCommandeAction(Request $request){
        if($request->isXmlHttpRequest()){
            $commandefactory = $this->container->get('amicale_new_commande');
            $commande = $commandefactory->getNewCommande();
            
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('AmicaleAccueilBundle:Produit');
            $produit = $repository->find($request->get('id_produit'));
            $commande->setProduit($produit);
            $commande->setQuantite($request->get('quantite'));
            $this->get('session')->clear();
            $message = '';
            if ($request->getMethod() == 'POST') {
                $em->persist($commande);
                $em->flush();
                $message = 'Votre commande a été crée avec succès.';
            }
            else{
                $message = 'Une erreur est survenue lors de la création de votre commande.';
            }
            return new Response($message);
        }
    }
}
