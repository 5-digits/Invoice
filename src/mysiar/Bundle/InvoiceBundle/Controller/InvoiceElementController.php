<?php

namespace mysiar\Bundle\InvoiceBundle\Controller;

use mysiar\Bundle\InvoiceBundle\Entity\InvoiceElement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Invoiceelement controller.
 *
 * @Route("invoiceelement")
 */
class InvoiceElementController extends Controller
{
    /**
     * Lists all invoiceElement entities.
     *
     * @Route("/", name="invoiceelement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invoiceElements = $em->getRepository('InvoiceBundle:InvoiceElement')->findAll();

        return $this->render('invoiceelement/index.html.twig', array(
            'invoiceElements' => $invoiceElements,
        ));
    }

    /**
     * Creates a new invoiceElement entity.
     *
     * @Route("/new", name="invoiceelement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $invoiceElement = new Invoiceelement();
        $form = $this->createForm('mysiar\Bundle\InvoiceBundle\Form\InvoiceElementType', $invoiceElement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invoiceElement);
            $em->flush($invoiceElement);

            return $this->redirectToRoute('invoiceelement_show', array('id' => $invoiceElement->getId()));
        }

        return $this->render('invoiceelement/new.html.twig', array(
            'invoiceElement' => $invoiceElement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invoiceElement entity.
     *
     * @Route("/{id}", name="invoiceelement_show")
     * @Method("GET")
     */
    public function showAction(InvoiceElement $invoiceElement)
    {
        $deleteForm = $this->createDeleteForm($invoiceElement);

        return $this->render('invoiceelement/show.html.twig', array(
            'invoiceElement' => $invoiceElement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invoiceElement entity.
     *
     * @Route("/{id}/edit", name="invoiceelement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, InvoiceElement $invoiceElement)
    {
        $deleteForm = $this->createDeleteForm($invoiceElement);
        $editForm = $this->createForm('mysiar\Bundle\InvoiceBundle\Form\InvoiceElementType', $invoiceElement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invoiceelement_edit', array('id' => $invoiceElement->getId()));
        }

        return $this->render('invoiceelement/edit.html.twig', array(
            'invoiceElement' => $invoiceElement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invoiceElement entity.
     *
     * @Route("/{id}", name="invoiceelement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, InvoiceElement $invoiceElement)
    {
        $form = $this->createDeleteForm($invoiceElement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invoiceElement);
            $em->flush($invoiceElement);
        }

        return $this->redirectToRoute('invoiceelement_index');
    }

    /**
     * Creates a form to delete a invoiceElement entity.
     *
     * @param InvoiceElement $invoiceElement The invoiceElement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvoiceElement $invoiceElement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invoiceelement_delete', array('id' => $invoiceElement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
