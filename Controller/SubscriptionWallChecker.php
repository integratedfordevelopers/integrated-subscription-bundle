<?php

/*
 * This file is part of the Integrated package.
 *
 * (c) e-Active B.V. <integrated@e-active.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Integrated\Bundle\SubscriptionBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;

use Integrated\Bundle\SubscriptionBundle\Model\Subscription;
use Integrated\Bundle\SubscriptionBundle\Model\SubscriptionWall;
use Integrated\Common\Content\Channel\ChannelContextInterface;
use Integrated\Common\Content\ContentInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

/**
 * @author Jacob de Graaf <jacob.de.graaf@windesheim.nl>
 * @author Albert Bakker <albert-david.bakker@windesheim.nl>
 */
class SubscriptionWallChecker
{

    /**
     * @var ChannelContextInterface
     */
    protected $channel;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var AuthorizationChecker
     */
    protected $ac;

    /**
     * @var TokenStorageInterface
     */
    protected $ts;
    /**
     * SubscriptionPaywallChecker constructor.
     * @param ChannelContextInterface $channel
     * @param EntityManager $em
     * @param AuthorizationChecker $ac
     * @param TokenStorageInterface $ts
     */
    public function __construct(ChannelContextInterface $channel, EntityManager $em, AuthorizationChecker $ac, TokenStorageInterface $ts)
    {
        $this->channel = $channel;
        $this->em = $em;
        $this->ac = $ac;
        $this->ts = $ts;
    }

    /**
     * @return bool
     */
    public function needWall()
    {
        if ($this->isBlocked()) {
            if ($this->hasProperSubscription()) {
                return false;
            }
        } else {
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    public function isBlocked()
    {
        if (count($this->getWallsThatBlockArticle()) > 0) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isLoggedIn()
    {
        return $this->ac->isGranted('IS_AUTHENTICATED_FULLY');
    }

    /**
     * @return mixed
     */
    private function hasProperSubscription()
    {
        if ($this->isLoggedIn()) {
            $relationId = $this->ts->getToken()->getUser()->getRelation()->getId();
            //Get subscription of person
            $subscribedSubscriptions = $this->em
                ->getRepository(Subscription::class)
                ->findByRelation($relationId);

            $subscribedWalls = [];
            //Get a list of walls which person has access to
            foreach ($subscribedSubscriptions as $subscription) {
                $wallsOfOneSubscription = $subscription->getType()->getSubscriptionWalls();

                foreach ($wallsOfOneSubscription as $wall) {
                    $subscribedWalls[] = $wall->getId();
                }
            }
            //Get walls that are blocking article
            $wallsThatBlockArticle = $this->getWallsThatBlockArticle();
            //See if person is allowed to view article protected by the walls
            foreach ($wallsThatBlockArticle as $wallThatBlocksArticle) {
                if (in_array($wallThatBlocksArticle->getId(), $subscribedWalls)) {
                    return true;
                }
            };
            return false;
        } else {
            return false;
        }
    }

    /**
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    private function getWallsThatBlockArticle()
    {
        $channel = $this->channel->getChannel();

        $q = $this->em->getRepository(SubscriptionWall::class)
            ->createQueryBuilder('sw');

        $q  ->where('sw.channels LIKE :channels')
            ->setParameter('channels', sprintf('%%%s%%', $channel->getName()))
            ->andWhere('sw.disabled = false');

        return $walls = $q->getQuery()->getResult();
    }
}
