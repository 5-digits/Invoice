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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

