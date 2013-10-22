<?php

namespace Amicale\AccueilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amicale\AccueilBundle\Entity\Commande
 *
 * @ORM\Entity(repositoryClass="Amicale\AccueilBundle\Entity\CommandeRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="commande")
 */
class Commande {

    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $quantite
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="Amicale\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Amicale\AccueilBundle\Entity\Produit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @var string $statutCommande
     * @ORM\ManyToOne(targetEntity="Amicale\AccueilBundle\Entity\StatutCommande")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statutCommande;

    /**
     * @var datetime $createdAt
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;
    
    /**
     * Now we tell doctrine that before we persist or update we call the updatedTimestamps() function.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime());

        if($this->getCreatedAt() == null)
        {
            $this->setCreatedAt(new \DateTime());
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    /**
     * Get user
     *
     * @return Amicale\UserBundle\Entity\User
     */
    public function getUser() {
        return $this->user;
    }
    
    /**
     * Set user
     *
     * @param Amicale\UserBundle\Entity\User $user
     */
    public function setUser(\Amicale\UserBundle\Entity\User $user) {
        $this->user = $user;
    }
    
    /**
     * Get produit
     *
     * @return Amicale\AccueilBundle\Entity\Produit
     */
    public function getProduit() {
        return $this->produit;
    }
    
    /**
     * Set produit
     *
     * @param Amicale\AccueilBundle\Entity\Produit $produit
     */
    public function setProduit(\Amicale\AccueilBundle\Entity\Produit $produit) {
        $this->produit = $produit;
    }
    
    /**
     * Get statutCommande
     *
     * @return Amicale\AccueilBundle\Entity\SatutCommande
     */
    public function getStatutCommande() {
        return $this->statutCommande;
    }
    
    /**
     * Set statutCommande
     *
     * @param Amicale\AccueilBundle\Entity\SatutCommande $statutCommande
     */
    public function setStatutCommande(\Amicale\AccueilBundle\Entity\StatutCommande $statutCommande) {
        $this->statutCommande = $statutCommande;
    }
    
    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    public function add($a, $b){
        $resultA = 0;
        $resultB = 0;
        if($a === 1){
            $resultA = $a + $b;
        }
        else{
            $resultA = $a - $b;
        }
        if($b === 1){
            $resultB = $b - $a;
        }
        else{
            $resultB = $b + $b;
        }
        return $resultA + $resultB;
    }
    
}

?>