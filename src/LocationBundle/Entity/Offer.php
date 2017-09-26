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
     * @var float
     *
     * @ORM\Column(name="price_location", type="float")
     */
    private $priceLocation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_begin", type="datetime")
     */
    private $date_begin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="datetime")
     */
    private $date_end;

    /**
     * @ORM\OneToMany(targetEntity="LocationBundle\Entity\Vehicle", mappedBy="offer")
     */
    private $vehicles;

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
     * Set dateBegin
     *
     * @param \DateTime $dateBegin
     *
     * @return Offer
     */
    public function setDateBegin($dateBegin)
    {
        $this->date_begin = $dateBegin;

        return $this;
    }

    /**
     * Get dateBegin
     *
     * @return \DateTime
     */
    public function getDateBegin()
    {
        return $this->date_begin;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return Offer
     */
    public function setDateEnd($dateEnd)
    {
        $this->date_end = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->date_end;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vehicles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add vehicle
     *
     * @param \LocationBundle\Entity\Vehicle $vehicle
     *
     * @return Offer
     */
    public function addVehicle(\LocationBundle\Entity\Vehicle $vehicle)
    {
        $this->vehicles[] = $vehicle;

        return $this;
    }

    /**
     * Remove vehicle
     *
     * @param \LocationBundle\Entity\Vehicle $vehicle
     */
    public function removeVehicle(\LocationBundle\Entity\Vehicle $vehicle)
    {
        $this->vehicles->removeElement($vehicle);
    }

    /**
     * Get vehicles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }
}
