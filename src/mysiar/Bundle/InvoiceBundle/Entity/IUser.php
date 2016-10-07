<?php

namespace mysiar\Bundle\InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * IUser
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="mysiar\Bundle\InvoiceBundle\Repository\IUserRepository")
 */
class IUser extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Payment in number of days
     *
     * @var int
     *
     * @ORM\Column(name="payment", type="integer")
     *
     */
    private $payment;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_number_prefix", type="string", length=255, nullable=true)
     */
    private $invoice_number_prefix;


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
     * @return int
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param int $payment
     * @return IUser
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceNumberPrefix()
    {
        return $this->invoice_number_prefix;
    }

    /**
     * @param string $invoice_number_prefix
     * @return IUser
     */
    public function setInvoiceNumberPrefix($invoice_number_prefix)
    {
        $this->invoice_number_prefix = $invoice_number_prefix;

        return $this;
    }



}

