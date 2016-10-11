<?php

/**
 * Bundle to ovveride some Controllers' Method of FOSUserBundle
 */


namespace mysiar\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
