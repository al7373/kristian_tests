<?php

namespace Neo\NeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NEOs
 *
 * @ORM\Table(name="neos")
 * @ORM\Entity(repositoryClass="Neo\NeoBundle\Repository\NEOsRepository")
 */
class NEOs
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="reference", type="integer", unique=true)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="speed", type="float", nullable=true)
     */
    private $speed;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_hazardous", type="boolean", nullable=true)
     */
    private $isHazardous;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Game
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set reference
     *
     * @param int $date
     *
     * @return NEOs
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return int
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return NEOs
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
     * Set speed
     *
     * @param float $speed
     *
     * @return NEOs
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return float
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set isHazardous
     *
     * @param boolean $isHazardous
     *
     * @return NEOs
     */
    public function setIsHazardous($isHazardous)
    {
        $this->isHazardous = $isHazardous;

        return $this;
    }

    /**
     * Get isHazardous
     *
     * @return boolean
     */
    public function getIsHazardous()
    {
        return $this->isHazardous;
    }
}

