<?php

namespace mysiar\Bundle\InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvoiceElement
 *
 * @ORM\Table(name="invoice_elements")
 * @ORM\Entity(repositoryClass="mysiar\Bundle\InvoiceBundle\Repository\InvoiceElementRepository")
 */
class InvoiceElement
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string", length=255)
     */
    private $unit;

    /**
     * @var string
     *
     * @ORM\Column(name="price_net", type="decimal", precision=10, scale=2)
     */
    private $priceNet;

    /**
     * @var string
     *
     * @ORM\Column(name="discount", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $discount;

    /**
     * @var string
     *
     * @ORM\Column(name="pkwiu_code", type="string", length=255, nullable=true)
     */
    private $pkwiuCode;

    /**
     * @var string
     *
     * @ORM\Column(name="vat_rate", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $vatRate;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return InvoiceElement
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set amount
     *
     * @param string $amount
     * @return InvoiceElement
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set unit
     *
     * @param string $unit
     * @return InvoiceElement
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string 
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set priceNet
     *
     * @param string $priceNet
     * @return InvoiceElement
     */
    public function setPriceNet($priceNet)
    {
        $this->priceNet = $priceNet;

        return $this;
    }

    /**
     * Get priceNet
     *
     * @return string 
     */
    public function getPriceNet()
    {
        return $this->priceNet;
    }

    /**
     * Set discount
     *
     * @param string $discount
     * @return InvoiceElement
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return string 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set pkwiuCode
     *
     * @param string $pkwiuCode
     * @return InvoiceElement
     */
    public function setPkwiuCode($pkwiuCode)
    {
        $this->pkwiuCode = $pkwiuCode;

        return $this;
    }

    /**
     * Get pkwiuCode
     *
     * @return string 
     */
    public function getPkwiuCode()
    {
        return $this->pkwiuCode;
    }

    /**
     * Set vatRate
     *
     * @param string $vatRate
     * @return InvoiceElement
     */
    public function setVatRate($vatRate)
    {
        $this->vatRate = $vatRate;

        return $this;
    }

    /**
     * Get vatRate
     *
     * @return string 
     */
    public function getVatRate()
    {
        return $this->vatRate;
    }
}
