<?php

namespace LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 10,
     *      max = 200,
     *      minMessage = "Le prix doit être supérieur à {{ limit }}.",
     *      maxMessage = "Le prix doit être inférieur à {{ limit }}."
     * )
     */
    private $priceLocation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_begin", type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @Assert\GreaterThan("today UTC")
     */
    private $date_begin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @Assert\GreaterThan("+1 day")
     * @Assert\LessThan("+10 day")
     */
    private $date_end;

    /**
     * @ORM\ManyToOne(targetEntity="LocationBundle\Entity\Vehicle", inversedBy="offers", fetch="EAGER")
     * @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    private $vehicle;

    /**
     * @ORM\OneToOne(targetEntity="PaymentBundle\Entity\Bill", mappedBy="offer")
     */
    private $bill;

    /**
     * @ORM\Column(name="is_available", type="boolean", options={"default": true})
     */
    private $is_available = true;

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

    /**
     * Set bill
     *
     * @param \PaymentBundle\Entity\Bill $bill
     *
     * @return Offer
     */
    public function setBill(\PaymentBundle\Entity\Bill $bill = null)
    {
        $this->bill = $bill;

        return $this;
    }

    /**
     * Get bill
     *
     * @return \PaymentBundle\Entity\Bill
     */
    public function getBill()
    {
        return $this->bill;
    }

    /**
     * Set isAvailable
     *
     * @param boolean $isAvailable
     *
     * @return Offer
     */
    public function setIsAvailable($isAvailable)
    {
        $this->is_available = $isAvailable;

        return $this;
    }

    /**
     * Get isAvailable
     *
     * @return boolean
     */
    public function getIsAvailable()
    {
        return $this->is_available;
    }
}
