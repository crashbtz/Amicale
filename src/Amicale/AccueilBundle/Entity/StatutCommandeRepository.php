<?php

namespace Amicale\AccueilBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * StatutCommandeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StatutCommandeRepository extends EntityRepository
{
    public function getMenuCommande($role = null){
        $query = $this->createQueryBuilder('s');
        if($role === 'admin'){
            $query->where($query->expr()->in('s.id',  array(2, 3, 4, 5)));
        }
        else{
            $query->where($query->expr()->in('s.id',  array(1, 2, 3, 4, 5)));
        }
        return $query->getQuery()->getResult();
    }
}
