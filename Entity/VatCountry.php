<?php

namespace Integrated\Bundle\SubscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Integrated\Bundle\SubscriptionBundle\Entity\VatCountry
 */
class VatCountry
{
    /**
     * @var string
     */
    protected $countryCode;

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

    protected $vatTypes;

    public function __construct()
    {
        $this->vatTypes = new ArrayCollection();
    }

    /**
     * @param string $countryCode
     * @return VatCountry
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param float $percentage
     * @return VatCountry
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
     * @return VatCountry
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
     * @return VatCountry
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
     * Add VatType entity to collection (one to many).
     *
     * @param VatType $vatType
     * @return VatCountry
     */
    public function addVatType(VatType $vatType)
    {
        $this->vatTypes->add($vatType);

        return $this;
    }

    /**
     * Remove VatType entity from collection (one to many).
     *
     * @param VatType $vatType
     * @return VatCountry
     */
    public function removeVatType(VatType $vatType)
    {
        $this->vatTypes->removeElement($vatType);

        return $this;
    }

    /**
     * Get VatType entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVatTypes()
    {
        return $this->vatTypes;
    }
}