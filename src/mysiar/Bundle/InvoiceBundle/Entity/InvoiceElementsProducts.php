<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-10-21
 * Time: 12:01
 */

namespace mysiar\Bundle\InvoiceBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class InvoiceElementsProducts
{
    protected $invoice;

    protected $product;

    protected $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getInvoice()
    {
        return $this->invoice;
    }

    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setAllProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     * @return InvoiceElementsProducts
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }



}