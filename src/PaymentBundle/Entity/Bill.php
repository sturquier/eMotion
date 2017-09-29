<?php

namespace PaymentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bill
 *
 * @ORM\Table(name="bill")
 * @ORM\Entity(repositoryClass="PaymentBundle\Repository\BillRepository")
 */
class Bill
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="bills")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * @ORM\OneToOne(targetEntity="LocationBundle\Entity\Offer", inversedBy="bill", fetch="EAGER")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="id")
     */
    private $offer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_return", type="datetime", nullable = true, options={"default": 0})
     */
    private $date_return;

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
     * Set dateReturn
     *
     * @param \DateTime $dateReturn
     *
     * @return Bill
     */
    public function setDateReturn($dateReturn)
    {
        $this->date_return = $dateReturn;

        return $this;
    }

    /**
     * Get dateReturn
     *
     * @return \DateTime
     */
    public function getDateReturn()
    {
        return $this->date_return;
    }

    /**
     * Set customer
     *
     * @param \UserBundle\Entity\User $customer
     *
     * @return Bill
     */
    public function setCustomer(\UserBundle\Entity\User $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \UserBundle\Entity\User
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set offer
     *
     * @param \LocationBundle\Entity\Offer $offer
     *
     * @return Bill
     */
    public function setOffer(\LocationBundle\Entity\Offer $offer = null)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return \LocationBundle\Entity\Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }
}
