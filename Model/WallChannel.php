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

/**
 * Integrated\Bundle\SubscriptionBundle\Model\WallChannel
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

    /**
     * @var SubscriptionWall|null
     */
    protected $subscriptionWall;

    /**
     * @param SubscriptionWall $wall
     * @return WallChannel
     */
    public function setWall(SubscriptionWall $wall)
    {
        $this->wall = $wall;

        return $this;
    }

    /**
     * @return SubscriptionWall
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
     * @return SubscriptionWall|null
     */
    public function getSubscriptionWall()
    {
        return $this->subscriptionWall;
    }
}