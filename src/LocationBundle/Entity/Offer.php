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
     * @ORM\OneToOne(targetEntity="LocationBundle\Entity\Vehicle", inversedBy="offer", fetch="EAGER")
     * @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id")
     */
    private $vehicle;

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
     * Set vehicle
     *
     * @param \LocationBundle\Entity\Vehicle $vehicle
     *
     * @return Offer
     */
    public function setVehicle(\LocationBundle\Entity\Vehicle $vehicle = null)
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * Get vehicle
     *
     * @return \LocationBundle\Entity\Vehicle
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }
}
