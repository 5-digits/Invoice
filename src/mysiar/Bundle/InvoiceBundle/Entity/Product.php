<?php

namespace mysiar\Bundle\InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="mysiar\Bundle\InvoiceBundle\Repository\ProductRepository")
 */
class Product
{

    /**
     * @ORM\ManyToOne(targetEntity="InvoiceUser", inversedBy="products", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $invoiceUser;

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
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string", length=255, nullable=true)
     */
    private $unit;

    /**
     * @var string
     *
     * @ORM\Column(name="pkwiu_code", type="string", length=255, nullable=true)
     */
    private $pkwiuCode;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="price_net", type="decimal", precision=12, scale=2)
     */
    private $priceNet;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="vat_rate", type="string", length=10)
     */
    private $vatRate;

    /**
     * @var string
     *
     * @ORM\Column(name="price_gross", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $priceGross;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    private $notes;

    /**
     * Product constructor.
     */
    public function __construct()
    {
    }

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
     * Set code
     *
     * @param string $code
     *
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
     * Set pkwiu
     *
     * @param string $pkwiuCode
     *
     * @return Product
     */
    public function setPkwiuCode($pkwiuCode)
    {
        $this->pkwiuCode = $pkwiuCode;

        return $this;
    }

    /**
     * Get pkwiu
     *
     * @return string
     */
    public function getPkwiuCode()
    {
        return $this->pkwiuCode;
    }

    /**
     * Set priceNet
     *
     * @param string $priceNet
     *
     * @return Product
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
     * Set vat
     *
     * @param string $vatRate
     *
     * @return Product
     */
    public function setVatRate($vatRate)
    {
        $this->vatRate = $vatRate;

        return $this;
    }

    /**
     * Get vat
     *
     * @return string
     */
    public function getVatRate()
    {
        return $this->vatRate;
    }

    /**
     * Set priceGross
     *
     * @param string $priceGross
     *
     * @return Product
     */
    public function setPriceGross($priceGross)
    {
        $this->priceGross = $priceGross;

        return $this;
    }

    /**
     * Get priceGross
     *
     * @return string
     */
    public function getPriceGross()
    {
        return $this->priceGross;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Product
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @return mixed
     */
    public function getInvoiceUser()
    {
        return $this->invoiceUser;
    }

    /**
     * @param mixed $invoiceUser
     * @return Product
     */
    public function setInvoiceUser($invoiceUser)
    {
        $this->invoiceUser = $invoiceUser;

        return $this;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     * @return Product
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }


    public function __toString()
    {
        return $this->name;
    }

}
