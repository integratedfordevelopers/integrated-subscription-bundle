<?php

/*
* This file is part of the Integrated package.
*
* (c) e-Active B.V. <integrated@e-active.nl>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

// src/Acme/BlogBundle/Entity/BlogComment.php
namespace Acme\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\BlogBundle\Entity\SubscriptionWall
 *
 * @ORM\Table(name="blog_comment")
 * @ORM\Entity
 */
class SubscriptionWall
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;
    /**
     * @var string $teaser
     *
     * @ORM\Column(name="teaser", type="text", nullable=false)
     */
    private $teaser;
    /**
     * @var boolean $disabled
     *
     * @ORM\Column(name="disabled", type="boolean", length=100, nullable=false)
     */
    private $disabled;
    /**
     * @var boolean $freetier
     *
     * @ORM\Column(name="freetier", type="string", length=100, nullable=false)
     */
    private $freetier;
    private $channels;
    private $type;
    private $values;

}