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
     * @var TokenStorageInterface
     */
    protected $token;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * SubscriptionPaywallChecker constructor.
     * @param ChannelContextInterface $channel
     * @param TokenStorageInterface $token
     * @param EntityManager $em
     */
    public function __construct(ChannelContextInterface $channel, TokenStorageInterface $token, EntityManager $em)
    {
        $this->channel = $channel;
        $this->token = $token;
        $this->em = $em;
    }

    /**
     * @return bool
     */
    public function isBlocked(ContentInterface $article)
    {
        $user = $this->token->getToken()->getUser();
        $channel = $this->channel->getChannel();

        $query = "SELECT * FROM subscription_wall WHERE channels LIKE '%".$channel->getName()."%'";
        $walls = $this->em->getConnection()->prepare($query);
        $walls->execute();

        if ($walls->rowCount() > 0) {
            return true;
        }
        return false;
    }
}
