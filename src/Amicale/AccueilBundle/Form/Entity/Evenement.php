<?php

namespace Amicale\AccueilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amicale\AccueilBundle\Entity\Evenement
 *
 * @ORM\Entity(repositoryClass="Amicale\AccueilBundle\Entity\EvenementRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="evenement")
 */
class Evenement {

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
     * @var text $detail
     * @ORM\Column(name="detail", type="text", nullable=true)
     */
    private $detail;

    /**
     * @var datetime $date
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="Amicale\AccueilBundle\Entity\Commercant")
     */
    private $commercants;

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

    public function __construct() {
        $this->commercants = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->produits = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    public function getDetail() {
        return $this->detail;
    }

    public function setDetail($detail) {
        $this->detail = $detail;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
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
       
    /**
     * Add commercants
     *
     * @param Amicale\AccueilBundle\Entity\Commercant $commercant
     */
    public function addCommercant(\Amicale\AccueilBundle\Entity\Commercant $commercant) {
        $this->commercants[] = $commercant;
    }

    /**
     * Remove commercants
     *
     * @param Amicale\AccueilBundle\Entity\Commercant $commercant
     */
    public function removeCommercant(\Amicale\AccueilBundle\Entity\Commercant $commercant) {
        $this->commercants->removeElement($commercant);
    }

    /**
     * Get commercants
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getCommercants() {
        return $this->commercants;
    }
    
    //===============================================================================================
    
    public function getChaineIdCommercants(){
        $chaine_id = '';
        foreach ($this->commercants as $commercant){
            if($chaine_id != ''){
                $chaine_id .= ','.$commercant->getId();
            }
            else{
                $chaine_id = $commercant->getId();
            }
        }
        return $chaine_id;
    }
}

?>