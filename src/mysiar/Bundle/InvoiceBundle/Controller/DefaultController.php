<?php

namespace mysiar\Bundle\InvoiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $locale = $request->getLocale();
        return $this->redirectToRoute('invoice_index');
    }
}
