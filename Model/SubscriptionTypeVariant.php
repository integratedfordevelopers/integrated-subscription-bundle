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
 * @author Jacob de Graaf <jacob.de.graaf@windesheim.nl> and Albert Bakker <albert-david.bakker@windesheim.nl>
 */
class SubscriptionTypeVariant
{
    /**
     * @var string
     */
    protected $subscription_type_id;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var float
     */
    protected $vat;

    /**
     * @var float
     */
    protected $priceVat;

    /**
     * @var string
     */
    protected $periodType;

    /**
     * @var int
     */
    protected $periodLength;

    /**
     * @var SubscriptionType[]
     */
    protected $subscriptionType;

    /**
     * @param string $subscription_type_id
     * @return SubscriptionTypeVariant
     */
    public function setSubscriptionTypeId($subscription_type_id)
    {
        $this->subscription_type_id = $subscription_type_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubscriptionTypeId()
    {
        return $this->subscription_type_id;
    }

    /**
     * @param float $price
     * @return SubscriptionTypeVariant
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $vat
     * @return SubscriptionTypeVariant
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * @return float
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @param float $priceVat
     * @return SubscriptionTypeVariant
     */
    public function setPriceVat($priceVat)
    {
        $this->priceVat = $priceVat;

        return $this;
    }

    /**
     * @return float
     */
    public function getPriceVat()
    {
        return $this->priceVat;
    }

    /**
     * @param string $periodType
     * @return SubscriptionTypeVariant
     */
    public function setPeriodType($periodType)
    {
        $this->periodType = $periodType;

        return $this;
    }

    /**
     * @return string
     */
    public function getPeriodType()
    {
        return $this->periodType;
    }

    /**
     * @param integer $periodLength
     * @return SubscriptionTypeVariant
     */
    public function setPeriodlength($periodLength)
    {
        $this->periodLength = $periodLength;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPeriodLength()
    {
        return $this->periodLength;
    }

    /**
     * Set SubscriptionType entity (many to one).
     *
     * @param SubscriptionType $subscriptionType
     * @return SubscriptionTypeVariant
     */
    public function setSubscriptionType(SubscriptionType $subscriptionType = null)
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