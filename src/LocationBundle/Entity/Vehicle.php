<?php

namespace LocationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicle
 *
 * @ORM\Table(name="vehicle")
 * @ORM\Entity(repositoryClass="LocationBundle\Repository\VehicleRepository")
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
     * @var int
     *
     * @ORM\Column(name="serial_number", type="integer")
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_purchase", type="datetime")
     */
    private $datePurchase;

    /**
     * @var float
     *
     * @ORM\Column(name="price_purchase", type="float")
     */
    private $pricePurchase;


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
     * @param \DateTime $datePurchase
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
     * @return \DateTime
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
}

