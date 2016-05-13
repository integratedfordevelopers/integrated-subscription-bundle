<?php

namespace Integrated\Bundle\SubscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Integrated\Bundle\SubscriptionBundle\Entity\Subscription
 */
class Subscription
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $relation;

    /**
     * @var string
     */
    protected $contact;

    /**
     * @var string
     */
    protected $customPrice;

    /**
     * @var float
     */
    protected $discountPrice;

    /**
     * @var float
     */
    protected $discountPercentage;

    /**
     * @var float
     */
    protected $status;

    /**
     * @var string
     */
    protected $subscriptionType;

    /**
     * @param string $id
     * @return Subscription
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $type
     * @return Subscription
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $relation
     * @return Subscription
     */
    public function setRelation($relation)
    {
        $this->relation = $relation;

        return $this;
    }

    /**
     * @return string
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * @param string $contact
     * @return Subscription
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param float $customPrice
     * @return Subscription
     */
    public function setCustomPrice($customPrice)
    {
        $this->customPrice = $customPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getCustomPrice()
    {
        return $this->customPrice;
    }

    /**
     * @param float $discountPrice
     * @return Subscription
     */
    public function setDiscountPrice($discountPrice)
    {
        $this->discountPrice = $discountPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountPrice()
    {
        return $this->discountPrice;
    }

    /**
     * @param float $discountPercentage
     * @return Subscription
     */
    public function setDiscountPercentage($discountPercentage)
    {
        $this->discountPercentage = $discountPercentage;

        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountPercentage()
    {
        return $this->discountPercentage;
    }

    /**
     * @param string $status
     * @return Subscription
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set SubscriptionType entity (many to one).
     *
     * @param SubscriptionType $subscriptionType
     * @return Subscription
     */
    public function setSubscriptionType(SubscriptionType $subscriptionType)
    {
        $this->subscriptionType = $subscriptionType;

        return $this;
    }

    /**
     * Get SubscriptionType entity (many to one).
     *
     * @return SubscriptionType
     */
    public function getSubscriptionType()
    {
        return $this->subscriptionType;
    }
}