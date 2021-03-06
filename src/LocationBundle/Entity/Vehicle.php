<?php

namespace LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Vehicle
 *
 * @ORM\Table(name="vehicle")
 * @ORM\Entity(repositoryClass="LocationBundle\Repository\VehicleRepository")
 * @UniqueEntity("serialNumber")
 * @UniqueEntity("numberPlate")
 */
class Vehicle
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
     * @ORM\Column(name="brand", type="string", length=255)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255)
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="serial_number", type="string", length=255)
     */
    private $serialNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="number_plate", type="string", length=255)
     */
    private $numberPlate;

    /**
     * @var int
     *
     * @ORM\Column(name="kilometer", type="integer")
     */
    private $kilometer;

    /**
     * @var \Date
     *
     * @ORM\Column(name="date_purchase", type="date")
     */
    private $datePurchase;

    /**
     * @var float
     *
     * @ORM\Column(name="price_purchase", type="float")
     */
    private $pricePurchase;

    /**
     * @ORM\OneToMany(targetEntity="LocationBundle\Entity\Offer", mappedBy="vehicle", cascade={"remove"})
     */
    private $offers;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Image()
     */
    private $picture;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

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
     * Set brand
     *
     * @param string $brand
     *
     * @return Vehicle
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set model
     *
     * @param string $model
     *
     * @return Vehicle
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set serialNumber
     *
     * @param integer $serialNumber
     *
     * @return Vehicle
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    /**
     * Get serialNumber
     *
     * @return int
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Vehicle
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set numberPlate
     *
     * @param string $numberPlate
     *
     * @return Vehicle
     */
    public function setNumberPlate($numberPlate)
    {
        $this->numberPlate = $numberPlate;

        return $this;
    }

    /**
     * Get numberPlate
     *
     * @return string
     */
    public function getNumberPlate()
    {
        return $this->numberPlate;
    }

    /**
     * Set kilometer
     *
     * @param integer $kilometer
     *
     * @return Vehicle
     */
    public function setKilometer($kilometer)
    {
        $this->kilometer = $kilometer;

        return $this;
    }

    /**
     * Get kilometer
     *
     * @return int
     */
    public function getKilometer()
    {
        return $this->kilometer;
    }

    /**
     * Set datePurchase
     *
     * @param \Date $datePurchase
     *
     * @return Vehicle
     */
    public function setDatePurchase($datePurchase)
    {
        $this->datePurchase = $datePurchase;

        return $this;
    }

    /**
     * Get datePurchase
     *
     * @return \Date
     */
    public function getDatePurchase()
    {
        return $this->datePurchase;
    }

    /**
     * Set pricePurchase
     *
     * @param float $pricePurchase
     *
     * @return Vehicle
     */
    public function setPricePurchase($pricePurchase)
    {
        $this->pricePurchase = $pricePurchase;

        return $this;
    }

    /**
     * Get pricePurchase
     *
     * @return float
     */
    public function getPricePurchase()
    {
        return $this->pricePurchase;
    }

    /**
     * For Offer Forms
     */
    public function getDisplayName()
    {
        return $this->brand . " - " . $this->model . " ( numero de serie : " . $this->serialNumber . " ) ";
    }

    /**
     * Add offer
     *
     * @param \LocationBundle\Entity\Offer $offer
     *
     * @return Vehicle
     */
    public function addOffer(\LocationBundle\Entity\Offer $offer)
    {
        $this->offers[] = $offer;

        return $this;
    }

    /**
     * Remove offer
     *
     * @param \LocationBundle\Entity\Offer $offer
     */
    public function removeOffer(\LocationBundle\Entity\Offer $offer)
    {
        $this->offers->removeElement($offer);
    }

    /**
     * Get offers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Vehicle
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
