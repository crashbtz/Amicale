<?php

namespace Amicale\AccueilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amicale\AccueilBundle\Entity\Produit
 *
 * @ORM\Entity(repositoryClass="Amicale\AccueilBundle\Entity\ProduitRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="produit")
 */
class Produit {

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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string $marque
     * @ORM\Column(name="marque", type="string", length=50, nullable=true)
     */
    private $marque;

    /**
     * @var text $contenu
     * @ORM\Column(name="contenu", type="text", nullable=true)
     */
    private $contenu;

    /**
     * @var integer $prix
     * @ORM\Column(name="prix", type="integer", nullable=true)
     */
    private $prix;
    
    /**
     * @var string $typeProduit
     * @ORM\ManyToOne(targetEntity="Amicale\AccueilBundle\Entity\TypeProduit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeProduit;

    /**
     * @ORM\OneToOne(targetEntity="Amicale\AccueilBundle\Entity\Photo", cascade={"persist", "remove"})
     */
    private $photo;

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

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getMarque() {
        return $this->marque;
    }

    public function setMarque($marque) {
        $this->marque = $marque;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    /**
     * Get typeProduit
     *
     * @return Amicale\AccueilBundle\Entity\TypeProduit
     */
    public function getTypeProduit() {
        return $this->typeProduit;
    }
    
    /**
     * Set typeProduit
     *
     * @param Amicale\AccueilBundle\Entity\TypeProduit $typeProduit
     */
    public function setTypeProduit(\Amicale\AccueilBundle\Entity\TypeProduit $typeProduit) {
        $this->typeProduit = $typeProduit;
    }

    /**
     * @return Amicale\AccueilBundle\Entity\Photo
     */
    public function getPhoto() {
        return $this->photo;
    }
    
    /**
     * @return path photo
     */
    public function getPhotoPath() {
        if(!$this->photo){
            return 'uploads/img/divers.png';
        }
        return $this->photo->getWebPath();
    }
    
    /**
     * @return path photo
     */
    public function getPhotoAlt() {
        if(!$this->photo){
            return 'divers.png';
        }
        return $this->photo->getAlt();
    }

    /**
     * @param Amicale\AccueilBundle\Entity\Photo $photo
     */
    public function setPhoto(\Amicale\AccueilBundle\Entity\Photo $photo = null) {
        $this->photo = $photo;
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


}

?>