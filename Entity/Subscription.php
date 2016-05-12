<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.0.2 (doctrine2-annotation) on 2016-04-29 10:04:43.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Integrated\Bundle\SubscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Integrated\Bundle\SubscriptionBundle\Entity\Subscription
 *
 * @ORM\Entity()
 * @ORM\Table(name="subscription", indexes={@ORM\Index(name="fk_Subscription_SubscriptionType1_idx", columns={"`type`"})})
 */
class Subscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string", length=36)
     */
    protected $id;

    /**
     * @ORM\Column(name="`type`", type="string", length=36)
     */
    protected $type;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $relation;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $contact;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    protected $customPrice;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    protected $discountPrice;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=3, nullable=true)
     */
    protected $discountPercentage;

    /**
     * @ORM\Column(name="`status`", type="string", length=255, nullable=true)
     */
    protected $status;

    /**
     * @ORM\ManyToOne(targetEntity="SubscriptionType", inversedBy="subscriptions")
     * @ORM\JoinColumn(name="`type`", referencedColumnName="id", nullable=false)
     */
    protected $subscriptionType;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param string $id
     * @return \Integrated\Bundle\SubscriptionBundle\Entity\Subscription
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of type.
     *
     * @param string $type
     * @return \Integrated\Bundle\SubscriptionBundle\Entity\Subscription
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of relation.
     *
     * @param string $relation
     * @return \Integrated\Bundle\SubscriptionBundle\Entity\Subscription
     */
    public function setRelation($relation)
    {
        $this->relation = $relation;

        return $this;
    }

    /**
     * Get the value of relation.
     *
     * @return string
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * Set the value of contact.
     *
     * @param string $contact
     * @return \Integrated\Bundle\SubscriptionBundle\Entity\Subscription
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get the value of contact.
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set the value of customPrice.
     *
     * @param float $customPrice
     * @return \Integrated\Bundle\SubscriptionBundle\Entity\Subscription
     */
    public function setCustomPrice($customPrice)
    {
        $this->customPrice = $customPrice;

        return $this;
    }

    /**
     * Get the value of customPrice.
     *
     * @return float
     */
    public function getCustomPrice()
    {
        return $this->customPrice;
    }

    /**
     * Set the value of discountPrice.
     *
     * @param float $discountPrice
     * @return \Integrated\Bundle\SubscriptionBundle\Entity\Subscription
     */
    public function setDiscountPrice($discountPrice)
    {
        $this->discountPrice = $discountPrice;

        return $this;
    }

    /**
     * Get the value of discountPrice.
     *
     * @return float
     */
    public function getDiscountPrice()
    {
        return $this->discountPrice;
    }

    /**
     * Set the value of discountPercentage.
     *
     * @param float $discountPercentage
     * @return \Integrated\Bundle\SubscriptionBundle\Entity\Subscription
     */
    public function setDiscountPercentage($discountPercentage)
    {
        $this->discountPercentage = $discountPercentage;

        return $this;
    }

    /**
     * Get the value of discountPercentage.
     *
     * @return float
     */
    public function getDiscountPercentage()
    {
        return $this->discountPercentage;
    }

    /**
     * Set the value of status.
     *
     * @param string $status
     * @return \Integrated\Bundle\SubscriptionBundle\Entity\Subscription
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set SubscriptionType entity (many to one).
     *
     * @param \Integrated\Bundle\SubscriptionBundle\Entity\SubscriptionType $subscriptionType
     * @return \Integrated\Bundle\SubscriptionBundle\Entity\Subscription
     */
    public function setSubscriptionType(SubscriptionType $subscriptionType)
    {
        $this->subscriptionType = $subscriptionType;

        return $this;
    }

    /**
     * Get SubscriptionType entity (many to one).
     *
     * @return \Integrated\Bundle\SubscriptionBundle\Entity\SubscriptionType
     */
    public function getSubscriptionType()
    {
        return $this->subscriptionType;
    }
}