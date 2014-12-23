<?php

namespace SOSVelo\Bundle\PointBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SOSVelo\Bundle\PointBundle\Entity\DemandeRepository")
 */
class Demande
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    public function __construct()
    {
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        $this->dateTime = new \Datetime();
    }

    /**
     * @ORM\OneToOne(targetEntity="SOSVelo\Bundle\PointBundle\Entity\Point", cascade={"persist"})
     */
    private $point;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime")
     */
    private $dateTime;

    /**
     * @var \string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


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
     * Set dateTime
     *
     * @param \DateTime $dateTime
     * @return Demande
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get dateTime
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Set point
     *
     * @param \SOSVelo\Bundle\PointBundle\Entity\Point $point
     * @return Demande
     */
    public function setPoint(\SOSVelo\Bundle\PointBundle\Entity\Point $point = null)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Get point
     *
     * @return \SOSVelo\Bundle\PointBundle\Entity\Point 
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Demande
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
}
