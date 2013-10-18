<?php

namespace Amicale\UserBundle\Entity;
 
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
 
/**
 * Amicale\UserBundle\Entity\User
 * @ORM\Entity(repositoryClass="Amicale\UserBundle\Entity\UserRepository")
 * @ORM\Table(name="amicale_user")
 */
class User extends BaseUser
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
  
  public function __construct()
    {
       parent::__construct();
       if (empty($this->roles)) {
         $this->roles[] = 'ROLE_USER';
       }
    }
}