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

use Integrated\Bundle\ContentBundle\Document\Content\Article;
use Integrated\Bundle\SubscriptionBundle\Model\SubscriptionWall;
use Integrated\Common\Content\Channel\ChannelContextInterface;
use Integrated\Common\Content\ContentInterface;

use Symfony\Component\Routing\RouterInterface;
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
     * @param ContentInterface $article
     * @return bool
     */
    public function isBlocked(ContentInterface $article)
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

    public function hasProperSubscription()
    {
        $person = $this->ts->getToken()->getUser()->getRelation()->getId();
        return $person;
    }

    /**
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getWallsThatBlockArticle()
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
