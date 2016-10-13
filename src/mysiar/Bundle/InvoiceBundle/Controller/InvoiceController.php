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
use mysiar\Bundle\InvoiceBundle\Form\InvoiceNewType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use mysiar\Bundle\InvoiceBundle\Entity\InvoiceUser;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

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
        $user = $this->getUser();
        $invoices = $this->getInvoiceRepository()->getAllInvoiceForUser($user);

        return $this->render(
            'invoice/index.html.twig',
            array(
                'invoices' => $invoices,
                'user' => $this->getUser()
            )
        );
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
        $invoice->setInvoiceUser($this->getUser()); // invoice owner !!!

        // initial invoice set
        $invoice->setNewInvoice();

        // setting new Invoice number based on numbers of already issued Invoices
        $invoice->setInvoiceNumber($this->getInvoiceRepository()->generateInvoiceNumber($this->getUser()));

        $form = $this->createForm('mysiar\Bundle\InvoiceBundle\Form\InvoiceType', $invoice);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // update invoice with Client information and store it
            $invoice->updateInvoiceWithClient();

            $em->persist($invoice);
            $em->flush();

            return $this->redirectToRoute('invoice_show', array('id' => $invoice->getId()));
        }

        return $this->render(
            'invoice/new.html.twig',
            array(
                'invoice' => $invoice,
                'form' => $form->createView(),
                'user' => $this->getUser()
            )
        );
    }

    /**
     * Finds and displays a Invoice entity.
     *
     * @Route("/{id}", name="invoice_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $invoice = $this->getInvoiceRepository()->getInvoiceById($id, $this);
        if ($invoice) {
            if ($this->getInvoiceRepository()->invoiceOwner($invoice, $this->getUser())) {
                return $this->render(
                    'invoice/invoice1.tmpl.twig',
                    array(
                        'invoice' => $invoice,
                        'user' => $this->getUser(),                   // Seller details
                        'user' => $this->getUser()                    // Logged user name for menu
                    )
                );
            }
        }

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
        $invoice = $this->getInvoiceRepository()->getInvoiceById($id, $this);
        if ($invoice) {
            if ($this->getInvoiceRepository()->invoiceOwner($invoice, $this->getUser())) {
                $preEditInvoiceClient = $invoice->getClient();
                $deleteForm = $this->createDeleteForm($invoice);
                $editForm = $this->createForm('mysiar\Bundle\InvoiceBundle\Form\InvoiceEditType', $invoice);
                $editForm->handleRequest($request);

                if ($editForm->isSubmitted() && $editForm->isValid()) {
                    $em = $this->getDoctrine()->getManager();

                    // if client has been changed in Select of InvoiceEditType - rewrite all client data
                    if ($preEditInvoiceClient != $invoice->getClient()) {
                        $invoice->updateInvoiceWithClient();
                    }
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
                        'user' => $this->getUser()
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
        $invoice = $this->getInvoiceRepository()->getInvoiceById($id, $this);
        if ($invoice) {
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
            ->getForm();
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

    /**
     * Gets InvoiceBundle:Client repository
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    private function getClientRepository()
    {
        return $this->getDoctrine()->getRepository('InvoiceBundle:Client');
    }


    /**
     * Displays final invoice.
     *
     * @Route("/{id}/view", name="invoice_view")
     * @Method({"GET", "POST"})
     */
    public function viewInvoiceAction($id)
    {
        $invoice = $this->getInvoiceRepository()->getInvoiceById($id, $this);

        return $this->render(
            'invoice/invoice1.tmpl.twig',
            array(
                'invoice' => $invoice,
                'user' => $this->getUser(),

            )
        );
    }

}
