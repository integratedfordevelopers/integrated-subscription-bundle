<?php

namespace Integrated\Bundle\SubscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Integrated\Bundle\SubscriptionBundle\Entity\VatContinent
 */
class VatContinent
{
    /**
     * @var string
     */
    protected $continentCode;

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
     * @param string $continentCode
     * @return VatContinent
     */
    public function setContinentCode($continentCode)
    {
        $this->continentCode = $continentCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getContinentCode()
    {
        return $this->continentCode;
    }

    /**
     * @param float $percentage
     * @return VatContinent
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
     * @return VatContinent
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
     * @return VatContinent
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
     * @return VatContinent
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
     * @return VatContinent
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