<?php
/*
namespace Amicale\UserBundle\Entity;

//use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
//use FR3D\LdapBundle\Model\LdapUserInterface as LdapUserInterface;

/**
 * Amicale\UserBundle\Entity\User
 *
 * @ORM\Entity(repositoryClass="Amicale\UserBundle\Entity\UserRepository")
 * @ORM\Table(name="amicale_user")
 *
class User extends BaseUser/* implements LdapUserInterface*{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
    protected $id;

    /**
     * Ldap Object Distinguished Name
     * @var string $dn
     *
    protected $dn;
    
    public function __construct()
    {
       parent::__construct();
       if (empty($this->roles)) {
         $this->roles[] = 'ROLE_USER';
       }
    }
    
    /**
     * Get id
     *
     * @return integer 
     *
    public function getId() {
	return $this->id;
    }
    
    /**
     * {@inheritDoc}
     *
    public function setDn($dn)
    {
        $this->dn = $dn;
    }

    /**
     * {@inheritDoc}
     *
    public function getDn()
    {
        return $this->dn;
    }    

}*/