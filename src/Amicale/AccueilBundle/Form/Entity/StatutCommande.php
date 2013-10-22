<?php
 
namespace Amicale\AccueilBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
 
/**
 * Amicale\AccueilBundle\Entity\StatutCommande
 *
 * @ORM\Table(name="statutcommande")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Amicale\AccueilBundle\Entity\StatutCommandeRepository")
 */
class StatutCommande
{
  /**
   * @var integer $id
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;
 
  /**
   * @var string libelle
   *
   * @ORM\Column(name="libelle", type="string", length=50, nullable=false)
   */
  private $libelle;
  
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
}
?>