<?php

namespace PaymentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="date_payment", type="datetime", nullable=false)
     */
    private $date_payment;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var float
     *
     * @ORM\Column(name="lateness_costs", type="float", options={"default": 0})
     */
    private $lateness_costs = 0;

    /**
     * @ORM\Column(name="is_returned", type="boolean", options={"default":true})
     */
    private $is_returned = true;

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

    /**
     * Set datePayment
     *
     * @param \DateTime $datePayment
     *
     * @return Bill
     */
    public function setDatePayment($datePayment)
    {
        $this->date_payment = $datePayment;

        return $this;
    }

    /**
     * Get datePayment
     *
     * @return \DateTime
     */
    public function getDatePayment()
    {
        return $this->date_payment;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return Bill
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set latenessCosts
     *
     * @param float $latenessCosts
     *
     * @return Bill
     */
    public function setLatenessCosts($latenessCosts)
    {
        $this->lateness_costs = $latenessCosts;

        return $this;
    }

    /**
     * Get latenessCosts
     *
     * @return float
     */
    public function getLatenessCosts()
    {
        return $this->lateness_costs;
    }

    /**
     * Set isReturned
     *
     * @param boolean $isReturned
     *
     * @return Bill
     */
    public function setIsReturned($isReturned)
    {
        $this->is_returned = $isReturned;

        return $this;
    }

    /**
     * Get isReturned
     *
     * @return boolean
     */
    public function getIsReturned()
    {
        return $this->is_returned;
    }
}
