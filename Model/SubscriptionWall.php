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
class SubscriptionWall
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
     * @var int
     */
    protected $disabled;

    /**
     * Times a user can see an article before payment
     *
     * @var string
     */
    protected $freeTier;

    /**
     * @var WallChannel[]
     */
    public $wallChannels;

    /**
     * @var SubscriptionType[]
     */
    protected $subscriptionTypes;

    public function __construct()
    {
        $this->wallChannels = new ArrayCollection();
        $this->subscriptionTypes = new ArrayCollection();
    }

    /**
     * @param string $id
     * @return \Integrated\Bundle\SubscriptionBundle\Model\SubscriptionWall
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
     * @return SubscriptionWall
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
     * @return SubscriptionWall
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
     * @param boolean $disabled
     * @return SubscriptionWall
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
     * @param string $freetier
     * @return SubscriptionWall
     */
    public function setFreetier($freeTier)
    {
        $this->freeTier = $freeTier;

        return $this;
    }

    /**
     * @return string
     */
    public function getFreetier()
    {
        return $this->freeTier;
    }

    /**
     * Add WallChannel entity to collection (one to many).
     *
     * @param WallChannel $wallChannel
     * @return SubscriptionWall
     */
    public function addWallChannel(WallChannel $wallChannel)
    {
        $this->wallChannels->add($wallChannel);

        return $this;
    }

    /**
     * Remove WallChannel entity from collection (one to many).
     *
     * @param WallChannel $wallChannel
     * @return SubscriptionWall
     */
    public function removeWallChannel(WallChannel $wallChannel)
    {
        $this->wallChannels->removeElement($wallChannel);

        return $this;
    }

    /**
     * Get WallChannel entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWallChannels()
    {
        return $this->wallChannels;
    }

    /**
     * Add SubscriptionType entity to collection.
     *
     * @param SubscriptionType $subscriptionType
     * @return SubscriptionWall
     */
    public function addSubscriptionType(SubscriptionType $subscriptionType)
    {
        $this->subscriptionTypes->add($subscriptionType);

        return $this;
    }

    /**
     * Remove SubscriptionType entity from collection.
     *
     * @param SubscriptionType $subscriptionType
     * @return SubscriptionWall
     */
    public function removeSubscriptionType(SubscriptionType $subscriptionType)
    {
        $this->subscriptionTypes->removeElement($subscriptionType);

        return $this;
    }

    /**
     * Get SubscriptionType entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscriptionTypes()
    {
        return $this->subscriptionTypes;
    }
}