<?php

namespace mysiar\Bundle\InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use mysiar\Bundle\InvoiceBundle\Entity\InvoiceUser;

/**
 * Client
 *
 * @ORM\Table(name="clients")
 * @ORM\Entity(repositoryClass="mysiar\Bundle\InvoiceBundle\Repository\ClientRepository")
 */
class Client
{

    /**
     * @ORM\ManyToOne(targetEntity="InvoiceUser", inversedBy="clients", cascade={"persist"})
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
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="client_name", type="string", length=255)
     */
    private $clientName;


    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="company_name", type="string", length=255)
     */
    private $companyName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="vat_id", type="string", length=255)
     */
    private $vatId;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="address_street", type="string", length=255)
     */
    private $addressStreet;

    /**
     * @var string
     *
     * @ORM\Column(name="address_house", type="string", length=255, nullable=true)
     */
    private $addressHouse;

    /**
     * @var string
     *
     * @ORM\Column(name="address_flat", type="string", length=255, nullable=true)
     */
    private $addressFlat;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="address_zip", type="string", length=255)
     */
    private $addressZip;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="address_city", type="string", length=255)
     */
    private $addressCity;

    /**
     * @var string
     *
     * @ORM\Column(name="address_country", type="string", length=255, nullable=true)
     */
    private $addressCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_phone", type="string", length=255, nullable=true)
     */
    private $contactPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_mobile", type="string", length=255, nullable=true)
     */
    private $contactMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_fax", type="string", length=255, nullable=true)
     */
    private $contactFax;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_email", type="string", length=255, nullable=true)
     */
    private $contactEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_www", type="string", length=255, nullable=true)
     */
    private $contactWww;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    private $notes;



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
     * Set clientName
     *
     * @param string $clientName
     *
     * @return Client
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;

        return $this;
    }

    /**
     * Get clientName
     *
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * Set vatId
     *
     * @param string $vatId
     *
     * @return Client
     */
    public function setVatId($vatId)
    {
        $this->vatId = $vatId;

        return $this;
    }

    /**
     * Get vatId
     *
     * @return string
     */
    public function getVatId()
    {
        return $this->vatId;
    }

    /**
     * Set addressStreet
     *
     * @param string $addressStreet
     *
     * @return Client
     */
    public function setAddressStreet($addressStreet)
    {
        $this->addressStreet = $addressStreet;

        return $this;
    }

    /**
     * Get addressStreet
     *
     * @return string
     */
    public function getAddressStreet()
    {
        return $this->addressStreet;
    }

    /**
     * Set addressHouse
     *
     * @param string $addressHouse
     *
     * @return Client
     */
    public function setAddressHouse($addressHouse)
    {
        $this->addressHouse = $addressHouse;

        return $this;
    }

    /**
     * Get addressHouse
     *
     * @return string
     */
    public function getAddressHouse()
    {
        return $this->addressHouse;
    }

    /**
     * Set addressFlat
     *
     * @param string $addressFlat
     *
     * @return Client
     */
    public function setAddressFlat($addressFlat)
    {
        $this->addressFlat = $addressFlat;

        return $this;
    }

    /**
     * Get addressFlat
     *
     * @return string
     */
    public function getAddressFlat()
    {
        return $this->addressFlat;
    }

    /**
     * Set addressZip
     *
     * @param string $addressZip
     *
     * @return Client
     */
    public function setAddressZip($addressZip)
    {
        $this->addressZip = $addressZip;

        return $this;
    }

    /**
     * Get addressZip
     *
     * @return string
     */
    public function getAddressZip()
    {
        return $this->addressZip;
    }

    /**
     * Set addressCity
     *
     * @param string $addressCity
     *
     * @return Client
     */
    public function setAddressCity($addressCity)
    {
        $this->addressCity = $addressCity;

        return $this;
    }

    /**
     * Get addressCity
     *
     * @return string
     */
    public function getAddressCity()
    {
        return $this->addressCity;
    }

    /**
     * Set addressCountry
     *
     * @param string $addressCountry
     *
     * @return Client
     */
    public function setAddressCountry($addressCountry)
    {
        $this->addressCountry = $addressCountry;

        return $this;
    }

    /**
     * Get addressCountry
     *
     * @return string
     */
    public function getAddressCountry()
    {
        return $this->addressCountry;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     *
     * @return Client
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set contactMobile
     *
     * @param string $contactMobile
     *
     * @return Client
     */
    public function setContactMobile($contactMobile)
    {
        $this->contactMobile = $contactMobile;

        return $this;
    }

    /**
     * Get contactMobile
     *
     * @return string
     */
    public function getContactMobile()
    {
        return $this->contactMobile;
    }

    /**
     * Set contactFax
     *
     * @param string $contactFax
     *
     * @return Client
     */
    public function setContactFax($contactFax)
    {
        $this->contactFax = $contactFax;

        return $this;
    }

    /**
     * Get contactFax
     *
     * @return string
     */
    public function getContactFax()
    {
        return $this->contactFax;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     *
     * @return Client
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set contactWww
     *
     * @param string $contactWww
     *
     * @return Client
     */
    public function setContactWww($contactWww)
    {
        $this->contactWww = $contactWww;

        return $this;
    }

    /**
     * Get contactWww
     *
     * @return string
     */
    public function getContactWww()
    {
        return $this->contactWww;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     * @return Client
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     * @return Client
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Set invoiceUser
     *
     * @param \mysiar\Bundle\InvoiceBundle\Entity\InvoiceUser $invoiceUser
     *
     * @return Client
     */
    public function setInvoiceUser(InvoiceUser $invoiceUser = null)
    {
        $this->invoiceUser = $invoiceUser;

        return $this;
    }

    /**
     * Get invoiceUser
     *
     * @return \mysiar\Bundle\InvoiceBundle\Entity\InvoiceUser
     */
    public function getInvoiceUser()
    {
        return $this->invoiceUser;
    }


    public function __toString()
    {
        return $this->clientName;
    }
}
