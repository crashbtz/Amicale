<?php

namespace Amicale\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use \DateTime;

class AdministrationController extends Controller {

    public function indexAction() {
        return $this->render('AmicaleAccueilBundle:Administration:index.html.twig', array());
    }

    public function showAction($entity) {
        $em = $this->getDoctrine()->getManager();
        // On récupère le repository
        $repository = $em->getRepository('AmicaleAccueilBundle:' . $entity);
        $entities = $repository->findAll();
        
        $commercants = null;
        if($entity == 'Evenement'){
            $repository = $em->getRepository('AmicaleAccueilBundle:Commercant');
            $commercants = $repository->findAll();
        }
        
        $render_entity = "AmicaleAccueilBundle:RenderEntity:" . strtolower($entity) . ".html.twig";
        return $this->render('AmicaleAccueilBundle:Administration:index.html.twig', array('entity' => $entity, 'type' => 'show', 'entities' => $entities, 'render_entity' => $render_entity,
                            'commercants' => $commercants));    }

    public function newAction($entity) {
        $em = $this->getDoctrine()->getManager();
        //On crée un l'objet entity
        $nom_object_entity = '\Amicale\AccueilBundle\Entity\\' . $entity;
        $nom_object_entity_type = '\Amicale\AccueilBundle\Form\\' . $entity . 'Type';
        $object_entity = new $nom_object_entity;
        $form = $this->createForm(new $nom_object_entity_type, $object_entity);
        
        $commercants = $this->getCommercants($em, $entity);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($object_entity);
                $em->flush();
                $this->get('session')->clear();
                $this->get('session')->getFlashBag()->add('info', $entity.' bien crée');
                return $this->redirect($this->generateUrl('amicale_administration_show', array('entity' => $entity)));
            }
        }

        return $this->render('AmicaleAccueilBundle:Administration:index.html.twig', array('entity' => $entity, 'type' => 'new', 'form' => $form->createView(),
                            'commercants' => $commercants));
    }
    
    public function saveAction($entity){
        $request = $this->get('request');
        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $nom_object_entity = '\Amicale\AccueilBundle\Entity\\' . $entity;
            $object_entity = new $nom_object_entity;
            //recupere la chaine des parametres et travail pour la rendre exploitable
            $params = $request->get('params');
            $params = str_replace('amicale_accueilbundle_evenementtype', '', $params);
            $params = str_replace('%5B', '', $params);
            $params = str_replace('%5D', '', $params);
            $params = explode('&', $params);
            //variable correspondant aux attributs d'un evenement
            $titre = '';
            $id = '';
            $detail = '';
            $jour = '';
            $mois = '';
            $annee = '';
            $tab_commercants = array();
            //on recupere tous les parametres
            foreach ($params as $key => $value) {
                $value1 = explode('=', $value);
                if(strpos($value1[0], 'commercant') !== false){
                    $value1[0] = 'commercant';
                }
                switch ($value1[0]) {
                    case 'id':
                        $id = $value1[1];
                        break;
                    case 'titre':
                        $titre = urldecode($value1[1]);
                        break;
                    case 'detail':
                        $detail = urldecode($value1[1]);
                        break;
                    case 'dateday':
                        $jour = $value1[1];
                        break;
                    case 'datemonth':
                        $mois = $value1[1];
                        break;
                    case 'dateyear':
                        $annee = $value1[1];
                        break;
                    case 'commercant':
                        $tab_commercants[$value1[1]] = $value1[1];
                        break;
                    default:
                        break;
                }
            }
            //si on est en modification alors on récupere l'objet initial avant de le setter
            if($id != ''){
                $object_entity = $em->find('AmicaleAccueilBundle:'.$entity, $id);
            }
            
            //set des attributs d'un evenement
            $date = DateTime::createFromFormat('j/n/Y', $jour.'/'.$mois.'/'.$annee);            
            $object_entity->setTitre($titre);
            $object_entity->setDetail($detail);
            $object_entity->setDate($date);
            $object_entity->getCommercants()->clear();
            
            //relation avec les commercants y participant
            foreach ($tab_commercants as $key => $id) {                
                $commercant = $em->find('AmicaleAccueilBundle:Commercant', $id);
                $object_entity->addCommercant($commercant);
            }
            //sauvegarde de l'evenement
            $em->persist($object_entity);
            $em->flush();
            
            $this->get('session')->clear();
            $this->get('session')->getFlashBag()->add('info', $entity.' bien crée');
            return new Response($this->generateUrl('amicale_administration_show', array('entity' => $entity)));
        }
        return new Response('pas ajax');
    }
    
    public function editAction($entity, $id) {
        $em = $this->getDoctrine()->getManager();
        $nom_object_entity_type = '\Amicale\AccueilBundle\Form\\' . $entity . 'Type';
        $object = $em->find('AmicaleAccueilBundle:'.$entity, $id);
        $form = $this->createForm(new $nom_object_entity_type, $object);
        
        $commercants = $this->getCommercants($em, $entity, $object);
        
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($object);
                $em->flush();
                $this->get('session')->clear();
                $this->get('session')->getFlashBag()->add('info', $entity.' modifié(e) avec succès.');
                return $this->redirect($this->generateUrl('amicale_administration_show', array('entity' => $entity)));
            }
        }      
        
        return $this->render('AmicaleAccueilBundle:Administration:index.html.twig', array('entity' => $entity, 'type' => 'new', 'form' => $form->createView(),
                            'commercants' => $commercants, 'id' => $id));
    }

    public function deleteAction($entity, $id) {
        $em = $this->getDoctrine()->getManager();
        $object = $em->find('AmicaleAccueilBundle:'.$entity, $id);
        if($object){
            $em->remove($object);
            $em->flush();

            // On définit un message flash
            $this->get('session')->clear();
            $this->get('session')->getFlashBag()->add('info', $entity.' supprimé(e)');

            // Puis on redirige vers l'accueil
            return $this->redirect($this->generateUrl('amicale_administration_show', array('entity' => $entity)));
        }
        else{
            // On définit un message flash
            $this->get('session')->getFlashBag()->add('error', $entity.' supprimé(e)');

            // Puis on redirige vers l'accueil
            return $this->redirect($this->generateUrl('amicale_administration_show', array('entity' => $entity)));
        }        
    }

    /**
     * retourne la liste des commercants en fonction de l'entité passé en parametre
     * @param doctrine manager $em
     * @param string $entity
     * @param \AmicaleAccueilBundle:Evenement $evenement
     * @return array
     */
    public function getCommercants($em, $entity, $evenement = null){
        $commercants = array('achoisir' => array(), 'choisit' => array());
        if($entity == 'Evenement' && !$evenement){
            $repository = $em->getRepository('AmicaleAccueilBundle:Commercant');
            $commercants['achoisir'] = $repository->findAll();
        }
        else if($entity == 'Evenement'){
            $repository = $em->getRepository('AmicaleAccueilBundle:'.$entity);
            $commercants['achoisir'] = $repository->getCommercantsRestantsAChoisir($evenement);
            $commercants['choisit'] = $evenement->getCommercants();
        }
        return $commercants;
    }
}
