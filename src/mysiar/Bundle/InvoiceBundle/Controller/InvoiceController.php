<?php

namespace mysiar\Bundle\InvoiceBundle\Controller;

use mysiar\Bundle\InvoiceBundle\Repository\InvoiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use mysiar\Bundle\InvoiceBundle\Entity\Invoice;
use mysiar\Bundle\InvoiceBundle\Repository\InvoiceRepository as InvoiceRepo;
use mysiar\Bundle\InvoiceBundle\Form\InvoiceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


use mysiar\Bundle\InvoiceBundle\Entity\IUser;


/**
 * Invoice controller.
 * @Security("has_role('ROLE_USER')")
 * @Route("/invoice")
 */
class InvoiceController extends Controller
{
    /**
     * Lists all Invoice entities.
     *
     * @Route("/", name="invoice_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        //$this->denyAccessUnlessGranted('ROLE_USER', null, '');

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        //$invoices = $em->getRepository('InvoiceBundle:Invoice')->findBy(array( 'iuser' => $user));
        $invoices = $this->getInvoiceRepository()->getAllInvoiceForUser( $user );

        return $this->render('invoice/index.html.twig', array(
            'invoices' => $invoices,
            'username' => $this->getUser()->getUsername()
        ));
    }

    /**
     * Creates a new Invoice entity.
     *
     * @Route("/new", name="invoice_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $invoice = new Invoice();
        $form = $this->createForm('mysiar\Bundle\InvoiceBundle\Form\InvoiceType', $invoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $invoice->setIuser($this->getUser());
            $em->persist($invoice);
            $em->flush();

            return $this->redirectToRoute('invoice_show', array('id' => $invoice->getId()));
        }

        return $this->render('invoice/new.html.twig', array(
            'invoice' => $invoice,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Invoice entity.
     *
     * @Route("/{id}", name="invoice_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $invoice = $this->getInvoiceRepository()->getInvoiceById($id,$this);
        if(isset($invoice))
        {
            if ($this->getInvoiceRepository()->invoiceOwner($invoice, $this->getUser())) {
                $deleteForm = $this->createDeleteForm($invoice);

                return $this->render(
                    'invoice/show.html.twig',
                    array(
                        'invoice' => $invoice,
                        'delete_form' => $deleteForm->createView(),
                        'username' => $this->getUser()->getUsername()
                    )
                );
            }
        }

        //return new Response(dump($invoice));
        return $this->redirectToRoute('invoice_index');
    }

    /**
     * Displays a form to edit an existing Invoice entity.
     *
     * @Route("/{id}/edit", name="invoice_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $id)
    {
        $invoice = $this->getInvoiceRepository()->getInvoiceById($id,$this);
        if(isset($invoice)) {
            if ($this->getInvoiceRepository()->invoiceOwner($invoice, $this->getUser())) {
                $deleteForm = $this->createDeleteForm($invoice);
                $editForm = $this->createForm('mysiar\Bundle\InvoiceBundle\Form\InvoiceType', $invoice);
                $editForm->handleRequest($request);

                if ($editForm->isSubmitted() && $editForm->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($invoice);
                    $em->flush();

                    return $this->redirectToRoute('invoice_edit', array('id' => $invoice->getId()));
                }

                return $this->render(
                    'invoice/edit.html.twig',
                    array(
                        'invoice' => $invoice,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
                    )
                );
            }
        }
        return $this->redirectToRoute('invoice_index');

    }

    /**
     * Deletes a Invoice entity.
     *
     * @Route("/{id}", name="invoice_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $invoice = $this->getInvoiceRepository()->getInvoiceById($id,$this);
        if(isset($invoice)) {
            if ($this->getInvoiceRepository()->invoiceOwner($invoice, $this->getUser())) {
                $form = $this->createDeleteForm($invoice);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($invoice);
                    $em->flush();
                }
            }
        }

        return $this->redirectToRoute('invoice_index');
    }

    /**
     * Creates a form to delete a Invoice entity.
     *
     * @param Invoice $invoice The Invoice entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Invoice $invoice)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invoice_delete', array('id' => $invoice->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    /**
     * Gets InvoiceBundle:Invoice repository
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    private function getInvoiceRepository()
    {
        return $this->getDoctrine()->getRepository('InvoiceBundle:Invoice');
    }

}
