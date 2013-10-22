<?php

namespace Amicale\AccueilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amicale\AccueilBundle\Entity\Adresse
 *
 * @ORM\Entity(repositoryClass="Amicale\AccueilBundle\Entity\AdresseRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="adresse")
 */
class Adresse {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $numero
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var string $rue
     * @ORM\Column(name="rue", type="string", length=100, nullable=false)
     */
    private $rue;

    /**
     * @var string $complements
     * @ORM\Column(name="complements", type="string", length=200, nullable=true)
     */
    private $complements;

    /**
     * @var integer $code_postal
     * @ORM\Column(name="code_postal", type="integer", nullable=true)
     */
    private $code_postal;

    /**
     * @var string $ville
     * @ORM\Column(name="ville", type="string", nullable=true)
     */
    private $ville;

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
    
    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getRue() {
        return $this->rue;
    }

    public function setRue($rue) {
        $this->rue = $rue;
    }

    public function getComplements() {
        return $this->complements;
    }

    public function setComplements($complements) {
        $this->complements = $complements;
    }

    public function getCodePostal() {
        return $this->code_postal;
    }

    public function setCodePostal($code_postal) {
        $this->code_postal = $code_postal;
    }

    public function getVille() {
        return $this->ville;
    }

    public function setVille($ville) {
        $this->ville = $ville;
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
}

?>