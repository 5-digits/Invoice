<?php

namespace mysiar\Bundle\InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Currency
 *
 *
 * https://en.wikipedia.org/wiki/ISO_4217
 *
 * @ORM\Table(name="currencies")
 * @ORM\Entity(repositoryClass="mysiar\Bundle\InvoiceBundle\Repository\CurrencyRepository")
 */
class Currency
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="currency_code", type="string", length=255)
     */
    private $currencyCode;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="currency_num", type="string", length=255)
     */
    private $currencyNum;

    /**
     * @var smallint
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="currency_exponent", type="smallint", length=255)
     */
    private $currencyExponent;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_owner", type="string", length=255, nullable=true)
     */
    private $currencyOwner;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set currencyCode
     *
     * @param string $currencyCode
     *
     * @return Currency
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * Get currencyCode
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * Set currencyNum
     *
     * @param string $currencyNum
     *
     * @return Currency
     */
    public function setCurrencyNum($currencyNum)
    {
        $this->currencyNum = $currencyNum;

        return $this;
    }

    /**
     * Get currencyNum
     *
     * @return string
     */
    public function getCurrencyNum()
    {
        return $this->currencyNum;
    }

    /**
     * Set currencyExponent
     *
     * @param string $currencyExponent
     *
     * @return Currency
     */
    public function setCurrencyExponent($currencyExponent)
    {
        $this->currencyExponent = $currencyExponent;

        return $this;
    }

    /**
     * Get currencyExponent
     *
     * @return string
     */
    public function getCurrencyExponent()
    {
        return $this->currencyExponent;
    }

    /**
     * Set currencyOwner
     *
     * @param string $currencyOwner
     *
     * @return Currency
     */
    public function setCurrencyOwner($currencyOwner)
    {
        $this->currencyOwner = $currencyOwner;

        return $this;
    }

    /**
     * Get currencyOwner
     *
     * @return string
     */
    public function getCurrencyOwner()
    {
        return $this->currencyOwner;
    }

    public function __toString()
    {
        return $this->currencyCode;
    }
}

