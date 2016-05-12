<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.0.2 (doctrine2-annotation) on 2016-04-29 10:04:43.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Integrated\Bundle\SubscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Integrated\Bundle\SubscriptionBundle\Entity\SubscriptionTypeVariant
 */
class SubscriptionTypeVariant
{
    protected $subscription_type_id;

    protected $price;

    protected $vat;

    protected $priceVat;

    protected $periodType;

    protected $periodLength;

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