<?php

namespace Amicale\AccueilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amicale\AccueilBundle\Entity\Categorie
 *
 * @ORM\Entity(repositoryClass="Amicale\AccueilBundle\Entity\CategorieRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="categorie")
 */
class Categorie {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $titre
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;
    
    /**
     * @var text $description
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

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
    
    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
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
    
    public function __toString()
    {
        return $this->titre;
    }
}

?>