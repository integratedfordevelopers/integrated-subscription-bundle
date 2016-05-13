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
class VatType
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
     * @var float
     */
    protected $percentage;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var int
     */
    protected $disableWithVatId;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $continent;

    /**
     * @var SubscriptionType[]
     */
    protected $subscriptionTypes;

    /**
     * @var VatCountry
     */
    protected $vatCountry;

    /**
     * @var VatContinent
     */
    protected $vatContinent;

    public function __construct()
    {
        $this->subscriptionTypes = new ArrayCollection();
    }

    /**
     * @param string $id
     * @return VatType
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
     * @return VatType
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
     * @param float $percentage
     * @return VatType
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * @return float
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * @param string $code
     * @return VatType
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param boolean $disableWithVatId
     * @return VatType
     */
    public function setDisableWithVatId($disableWithVatId)
    {
        $this->disableWithVatId = $disableWithVatId;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getDisableWithVatId()
    {
        return $this->disableWithVatId;
    }

    /**
     * @param string $country
     * @return VatType
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $continent
     * @return VatType
     */
    public function setContinent($continent)
    {
        $this->continent = $continent;

        return $this;
    }

    /**
     * @return string
     */
    public function getContinent()
    {
        return $this->continent;
    }

    /**
     * Add SubscriptionType entity to collection (one to many).
     *
     * @param SubscriptionType $subscriptionType
     * @return VatType
     */
    public function addSubscriptionType(SubscriptionType $subscriptionType)
    {
        $this->subscriptionTypes->add($subscriptionType);

        return $this;
    }

    /**
     * Remove SubscriptionType entity from collection (one to many).
     *
     * @param SubscriptionType $subscriptionType
     * @return VatType
     */
    public function removeSubscriptionType(SubscriptionType $subscriptionType)
    {
        $this->subscriptionTypes->removeElement($subscriptionType);

        return $this;
    }

    /**
     * Get SubscriptionType entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscriptionTypes()
    {
        return $this->subscriptionTypes;
    }

    /**
     * Set VatCountry entity (many to one).
     *
     * @param VatCountry $vatCountry
     * @return VatType
     */
    public function setVatCountry(VatCountry $vatCountry = null)
    {
        $this->vatCountry = $vatCountry;

        return $this;
    }

    /**
     * Get VatCountry entity (many to one).
     *
     * @return VatCountry
     */
    public function getVatCountry()
    {
        return $this->vatCountry;
    }

    /**
     * Set VatContinent entity (many to one).
     *
     * @param VatContinent $vatContinent
     * @return VatType
     */
    public function setVatContinent(VatContinent $vatContinent = null)
    {
        $this->vatContinent = $vatContinent;

        return $this;
    }

    /**
     * Get VatContinent entity (many to one).
     *
     * @return VatContinent
     */
    public function getVatContinent()
    {
        return $this->vatContinent;
    }
}