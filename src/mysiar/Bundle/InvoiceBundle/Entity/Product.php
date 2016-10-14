<?php

namespace mysiar\Bundle\InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="mysiar\Bundle\InvoiceBundle\Repository\ProductRepository")
 */
class Product
{

    /**
     * @ORM\ManyToOne(targetEntity="InvoiceUser")
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="pkwiu", type="string", length=255, nullable=true)
     */
    private $pkwiu;

    /**
     * @var string
     *
     * @ORM\Column(name="price_net", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $priceNet;

    /**
     * @var string
     *
     * @ORM\Column(name="vat", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $vat;

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
     * @param string $pkwiu
     *
     * @return Product
     */
    public function setPkwiu($pkwiu)
    {
        $this->pkwiu = $pkwiu;

        return $this;
    }

    /**
     * Get pkwiu
     *
     * @return string
     */
    public function getPkwiu()
    {
        return $this->pkwiu;
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
     * @param string $vat
     *
     * @return Product
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return string
     */
    public function getVat()
    {
        return $this->vat;
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


}
