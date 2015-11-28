<?php

namespace SubwayBuddy\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Soccer\EventBundle\Entity\Event;


/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SubwayBuddy\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
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
     * @var name
     *
     * @ORM\Column(name="name", type="string" , length=255)
     * 
     */
    private $nom;

    public function __construct()
    {
        parent::__construct();
         $this->events = new ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
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
   * @ORM\ManyToMany(targetEntity="Soccer\EventBundle\Entity\Event", inversedBy="amis")
   */
     private $events; 
     
    
    
    public function addEvent(Event $event)
  {
    if (!$this->events->contains($event)) {  
    $this->events[] = $event;
    }
    
    return $this;
  }

  public function removeEvent(Event $event)
  {
    $this->events->removeElement($event);

    
  }

  public function getEvents()
  {
    return $this->events;
  }
  
    
    
    
}
