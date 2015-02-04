<?php

namespace SOSVelo\Bundle\PointBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PointService
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SOSVelo\Bundle\PointBundle\Entity\PointServiceRepository")
 */
class PointService
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="privilege", type="integer")
     */
    private $privilege;

    /**
     * @ORM\ManyToMany(targetEntity="SOSVelo\Bundle\PointBundle\Entity\Point", mappedBy="services")
     */
    private $points;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->points = new ArrayCollection();
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
     * @return PointService
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
     * Set description
     *
     * @param string $description
     * @return PointService
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
     * Set privilege
     *
     * @param integer $privilege
     * @return ServiceType
     */
    public function setPrivilege($privilege)
    {
        $this->privilege = $privilege;

        return $this;
    }

    /**
     * Get privilege
     *
     * @return integer
     */
    public function getPrivilege()
    {
        return $this->privilege;
    }

    /**
     * Add Point
     *
     * @param Point $point
     * @return $this
     */
    public function addPoint(\SOSVelo\Bundle\PointBundle\Entity\Point $point)
    {
        $point->addService($this);
        $this->points[] = $point;

        return $this;
    }

    /**
     * Remove point
     *
     * @param Point $point
     */
    public function removePoint(\SOSVelo\Bundle\PointBundle\Entity\Point $point)
    {
        $this->services->removeElement($point);
    }

    /**
     * Get points
     *
     * @return ArrayCollection
     */
    public function getPoints()
    {
        return $this->points;
    }
}
