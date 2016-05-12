<?php

namespace Integrated\Bundle\SubscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Integrated\Bundle\SubscriptionBundle\Entity\WallChannel
 */
class WallChannel
{
    /**
     * @var string
     */
    protected $wall;

    /**
     * @var string
     */
    protected $channel;

    protected $subscriptionWall;

    /**
     * @param string $wall
     * @return WallChannel
     */
    public function setWall($wall)
    {
        $this->wall = $wall;

        return $this;
    }

    /**
     * @return string
     */
    public function getWall()
    {
        return $this->wall;
    }

    /**
     * @param string $channel
     * @return WallChannel
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set SubscriptionWall entity (many to one).
     *
     * @param SubscriptionWall $subscriptionWall
     * @return WallChannel
     */
    public function setSubscriptionWall(SubscriptionWall $subscriptionWall = null)
    {
        $this->subscriptionWall = $subscriptionWall;

        return $this;
    }

    /**
     * Get SubscriptionWall entity (many to one).
     *
     * @return SubscriptionWall
     */
    public function getSubscriptionWall()
    {
        return $this->subscriptionWall;
    }
}