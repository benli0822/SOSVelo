<?php

namespace SOSVelo\Bundle\PointBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Point
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SOSVelo\Bundle\PointBundle\Entity\PointRepository")
 * @UniqueEntity("name")
 */
class Point
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=64)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=128)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=128)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=128)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="string", length=128, nullable=true)
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="activated", type="boolean", options={"default"=false})
     */
    private $activated;

    /**
     * @ORM\ManyToOne(targetEntity="SOSVelo\Bundle\PointBundle\Entity\PointComment", cascade={"persist"})
     */
    private $comments;

    /**
     * @ORM\OneToOne(targetEntity="SOSVelo\Bundle\UserBundle\Entity\User", cascade={"persist"})
     */
    private $user;


    /**
     * @ORM\ManyToMany(targetEntity="SOSVelo\Bundle\PointBundle\Entity\PointService", cascade={"persist"}, inversedBy="points")
     * @ORM\JoinTable(name="points_services")
     */
    private $services;


    public function __toString()
    {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     * @return Point
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set adress
     *
     * @param string $address
     * @return Point
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get adress
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Point
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Point
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    
        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Point
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    
        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set rating
     *
     * @param string $rating
     * @return Point
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set activated
     *
     * @param boolean $activated
     * @return Point
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;

        return $this;
    }

    /**
     * Get activated
     *
     * @return boolean
     */
    public function getActivated()
    {
        return $this->activated;
    }
    

    /**
     * Set comments
     *
     * @param \SOSVelo\Bundle\PointBundle\Entity\Point $comments
     * @return Point
     */
    public function setComments(\SOSVelo\Bundle\PointBundle\Entity\Point $comments = null)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return \SOSVelo\Bundle\PointBundle\Entity\Point 
     */
    public function getComments()
    {
        return $this->comments;
    }



    /**
     * Set user
     *
     * @param \SOSVelo\Bundle\UserBundle\Entity\User $user
     * @return Point
     */
    public function setUser(\SOSVelo\Bundle\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \SOSVelo\Bundle\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->services = new ArrayCollection();
    }

    /**
     * Add services
     *
     * @param \SOSVelo\Bundle\PointBundle\Entity\PointService $services
     * @return Point
     */
    public function addService(\SOSVelo\Bundle\PointBundle\Entity\PointService $services)
    {
        $services->addPoint($this);
        $this->services[] = $services;

        return $this;
    }

    /**
     * Remove services
     *
     * @param \SOSVelo\Bundle\PointBundle\Entity\PointService $services
     */
    public function removeService(\SOSVelo\Bundle\PointBundle\Entity\PointService $services)
    {
        $this->services->removeElement($services);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServices()
    {
        return $this->services;
    }
}
