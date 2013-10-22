<?php

namespace Amicale\AccueilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amicale\AccueilBundle\Entity\Commercant
 *
 * @ORM\Entity(repositoryClass="Amicale\AccueilBundle\Entity\CommercantRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="commercant")
 */
class Commercant {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $libelle
     * @ORM\Column(name="libelle", type="string", length=100, nullable=false)
     */
    private $libelle;

    /**
     * @var string $nom
     * @ORM\Column(name="nom", type="string", length=70, nullable=true)
     */
    private $nom;

    /**
     * @var string $prenom
     * @ORM\Column(name="prenom", type="string", length=50, nullable=true)
     */
    private $prenom;

    /**
     * @var text $detail
     * @ORM\Column(name="detail", type="text", nullable=true)
     */
    private $detail;

    /**
     * @var integer $tel
     * @ORM\Column(name="tel", type="integer", nullable=true)
     */
    private $tel;

    /**
     * @var string $email
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity="Amicale\AccueilBundle\Entity\Photo", cascade={"persist", "remove"})
     */
    private $photo;

    /**
     * @ORM\OneToOne(targetEntity="Amicale\AccueilBundle\Entity\Adresse", cascade={"persist", "remove"})
     */
    private $adresse;

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

    public function getLibelle() {
        return $this->libelle;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getDetail() {
        return $this->detail;
    }

    public function setDetail($detail) {
        $this->detail = $detail;
    }

    public function getTel() {
        return $this->tel;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
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

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }
    
    public function __toString() {
        return $this->libelle;
    }
}

?>