<?php

namespace Amicale\AccueilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amicale\AccueilBundle\Entity\TypeProduit
 *
 * @ORM\Entity(repositoryClass="Amicale\AccueilBundle\Entity\TypeProduitRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="typeproduit")
 */
class TypeProduit {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nom
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="Amicale\AccueilBundle\Entity\Categorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @var datetime $createdAt
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     * @ORM\Column(name="updatedAt", type="datetime", nullable=false)
     */
    private $updatedAt;

    
    /**
     * Now we tell doctrine that before we persist or update we call the updatedTimestamps() function.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function prePersist(){
        $this->updatedTimestamps();
    }
        
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

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    /**
     * Get categorie
     *
     * @return Amicale\AccueilBundle\Entity\Categorie
     */
    public function getCategorie() {
        return $this->categorie;
    }
    
    /**
     * Set categorie
     *
     * @param Amicale\AccueilBundle\Entity\Categorie $categorie
     */
    public function setCategorie(\Amicale\AccueilBundle\Entity\Categorie $categorie) {
        $this->categorie = $categorie;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }
    
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }
    
    public function __toString()
    {
        return $this->nom;
    }
}

?>