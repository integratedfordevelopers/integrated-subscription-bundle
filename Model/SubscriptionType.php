<?php

/*
 * This file is part of the Integrated package.
 *
 * (c) e-Active B.V. <integrated@e-active.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Integrated\Bundle\SubscriptionBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Jacob de Graaf <jacob.de.graaf@windesheim.nl> and Albert Bakker <albert-david.bakker@windesheim.nl>
 */
class SubscriptionType
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $teaser;

    /**
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @var \DateTime
     */
    protected $endDate;

    /**
     * @var string
     */
    protected $condition;

    /**
     * @var int
     */
    protected $disabled;

    /**
     * @var string
     */
    protected $channels;

    /**
     * @var string
     */
    protected $typeVat;

    /**
     * @var Subscription[]
     */
    protected $subscriptions;

    /**
     * @var SubscriptionTypeVariant[]
     */
    protected $subscriptionTypeVariants;

    /**
     * @var VatType
     */
    protected $vatType;

    /**
     * @var SubscriptionWall[]
     */
    protected $subscriptionWalls;

    public function __construct()
    {
        $this->subscriptions = new ArrayCollection();
        $this->subscriptionTypeVariants = new ArrayCollection();
        $this->subscriptionWalls = new ArrayCollection();
    }

    /**
     * @param string $id
     * @return SubscriptionType
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
     * @param string $name
     * @return SubscriptionType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $teaser
     * @return SubscriptionType
     */
    public function setTeaser($teaser)
    {
        $this->teaser = $teaser;

        return $this;
    }

    /**
     * @return string
     */
    public function getTeaser()
    {
        return $this->teaser;
    }

    /**
     * @param \DateTime $startDate
     * @return SubscriptionType
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $endDate
     * @return SubscriptionType
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param string $condition
     * @return SubscriptionType
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * @return string
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param boolean $disabled
     * @return SubscriptionType
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * @param string $channels
     * @return SubscriptionType
     */
    public function setChannels($channels)
    {
        $this->channels = $channels;

        return $this;
    }

    /**
     * @return string
     */
    public function getChannels()
    {
        return $this->channels;
    }

    /**
     * @param string $typevat
     * @return SubscriptionType
     */
    public function setTypevat($typevat)
    {
        $this->typevat = $typevat;

        return $this;
    }

    /**
     * @return string
     */
    public function getTypevat()
    {
        return $this->typevat;
    }

    /**
     * Add Subscription entity to collection (one to many).
     *
     * @param Subscription $subscription
     * @return SubscriptionType
     */
    public function addSubscription(Subscription $subscription)
    {
        $this->subscriptions->add($subscription);

        return $this;
    }

    /**
     * Remove Subscription entity from collection (one to many).
     *
     * @param Subscription $subscription
     * @return SubscriptionType
     */
    public function removeSubscription(Subscription $subscription)
    {
        $this->subscriptions->removeElement($subscription);

        return $this;
    }

    /**
     * Get Subscription entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscriptions()
    {
        return $this->subscriptions;
    }

    /**
     * Add SubscriptionTypeVariant entity to collection (one to many).
     *
     * @param SubscriptionTypeVariant $subscriptionTypeVariant
     * @return SubscriptionType
     */
    public function addSubscriptionTypeVariant(SubscriptionTypeVariant $subscriptionTypeVariant)
    {
        $this->subscriptionTypeVariants->add($subscriptionTypeVariant);

        return $this;
    }

    /**
     * Remove SubscriptionTypeVariant entity from collection (one to many).
     *
     * @param SubscriptionTypeVariant $subscriptionTypeVariant
     * @return SubscriptionType
     */
    public function removeSubscriptionTypeVariant(SubscriptionTypeVariant $subscriptionTypeVariant)
    {
        $this->subscriptionTypeVariants->removeElement($subscriptionTypeVariant);

        return $this;
    }

    /**
     * Get SubscriptionTypeVariant entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscriptionTypeVariants()
    {
        return $this->subscriptionTypeVariants;
    }

    /**
     * Set VatType entity (many to one).
     *
     * @param VatType $vatType
     * @return SubscriptionType
     */
    public function setVatType(VatType $vatType = null)
    {
        $this->vatType = $vatType;

        return $this;
    }

    /**
     * Get VatType entity (many to one).
     *
     * @return VatType
     */
    public function getVatType()
    {
        return $this->vatType;
    }

    /**
     * Add SubscriptionWall entity to collection.
     *
     * @param SubscriptionWall $subscriptionWall
     * @return SubscriptionType
     */
    public function addSubscriptionWall(SubscriptionWall $subscriptionWall)
    {
        $subscriptionWall->addSubscriptionType($this);
        $this->subscriptionWalls->add($subscriptionWall);

        return $this;
    }

    /**
     * Remove SubscriptionWall entity from collection.
     *
     * @param SubscriptionWall $subscriptionWall
     * @return SubscriptionType
     */
    public function removeSubscriptionWall(SubscriptionWall $subscriptionWall)
    {
        $subscriptionWall->removeSubscriptionType($this);
        $this->subscriptionWalls->removeElement($subscriptionWall);

        return $this;
    }

    /**
     * Get SubscriptionWall entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscriptionWalls()
    {
        return $this->subscriptionWalls;
    }
}