<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-10-20
 * Time: 12:34
 */

namespace mysiar\Bundle\InvoiceBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class InvoiceElements
{
    protected $invoice;

    protected $elements;

    public function __construct()
    {
        $this->elements = new ArrayCollection();
    }


    public function getInvoice()
    {
        return $this->invoice;
    }

    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }

    public function getElements()
    {
        return $this->elements;
    }

    public function setAllElements($elements)
    {
        $this->elements = $elements;
    }

}