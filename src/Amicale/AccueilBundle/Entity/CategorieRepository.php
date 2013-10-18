<?php

namespace Amicale\AccueilBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EvenementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategorieRepository extends EntityRepository
{
    public function getAllCategories(){
        $query = $this->_em->createQuery('SELECT c FROM AmicaleAccueilBundle:Categorie c ORDER BY c.titre ASC');
        return $query->getResult();
    }
}
