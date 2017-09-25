<?php

namespace LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Table(name="offer")
 * @ORM\Entity(repositoryClass="LocationBundle\Repository\OfferRepository")
 */
class Offer
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
     * @var string
     *
     * @ORM\Column(name="vehicle", type="string", length=255)
     */
    private $vehicle;

    /**
     * @var string
     *
     * @ORM\Column(name="owner", type="string", length=255)
     */
    private $owner;

    /**
     * @var float
     *
     * @ORM\Column(name="price_location", type="float")
     */
    private $priceLocation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duration_location", type="datetimetz")
     */
    private $durationLocation;


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
     * Set vehicle
     *
     * @param string $vehicle
     *
     * @return Offer
     */
    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * Get vehicle
     *
     * @return string
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * Set owner
     *
     * @param string $owner
     *
     * @return Offer
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set priceLocation
     *
     * @param float $priceLocation
     *
     * @return Offer
     */
    public function setPriceLocation($priceLocation)
    {
        $this->priceLocation = $priceLocation;

        return $this;
    }

    /**
     * Get priceLocation
     *
     * @return float
     */
    public function getPriceLocation()
    {
        return $this->priceLocation;
    }

    /**
     * Set durationLocation
     *
     * @param \DateTime $durationLocation
     *
     * @return Offer
     */
    public function setDurationLocation($durationLocation)
    {
        $this->durationLocation = $durationLocation;

        return $this;
    }

    /**
     * Get durationLocation
     *
     * @return \DateTime
     */
    public function getDurationLocation()
    {
        return $this->durationLocation;
    }
}

