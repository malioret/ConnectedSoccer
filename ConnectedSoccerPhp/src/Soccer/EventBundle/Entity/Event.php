<?php

namespace Soccer\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use SubwayBuddy\UserBundle\Entity\User;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Soccer\EventBundle\Entity\EventRepository")
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


/**
     * @var string
     *
     * @ORM\Column(name="nom", type="string",  length=255)
     *
     */
    private $nom;
   
   
   /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string",  length=255)
     *
     */
    private $lieu;
   
   
   
   /**
     * @var date
     *
     * @ORM\Column(name="date", type="string", length=11)
     *
     */
    private $date;
   
   
    public function __construct()
    {
       
         $this->amis = new ArrayCollection();
    }
   

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
     /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
    
    
      /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }
    
    
      /**
     * Get date
     *
     * @return date
     */
    public function getDate()
    {
        return $this->date;
    }
    
    


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Event
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Event
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return Event
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
    
    
     /**
    * @ORM\ManyToMany(targetEntity="SubwayBuddy\UserBundle\Entity\User", mappedBy="events")
    */
     private $amis; 
    
    
      public function addAmi(User $ami)
      {
         if (!$this->amis->contains($ami)) {
        $this->amis[] = $ami;
        $ami->addEvent($this);
        return $this;
             
         }
      }

  public function removeAmi(User $ami)
  {
    $this->amis->removeElement($ami);
    $ami->removeAmi($this);

    
  }

  public function getAmis()
  {
    return $this->amis;
  }
     
    
}
