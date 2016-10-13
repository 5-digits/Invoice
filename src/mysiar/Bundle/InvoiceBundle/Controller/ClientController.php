<?php

namespace mysiar\Bundle\InvoiceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use mysiar\Bundle\InvoiceBundle\Entity\Client;
use mysiar\Bundle\InvoiceBundle\Form\ClientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Client controller.
 * @Security("has_role('ROLE_USER')")
 * @Route("/client")
 */
class ClientController extends Controller
{
    /**
     * Lists all Client entities.
     *
     * @Route("/", name="client_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $clients = $this->getClientRepository()->getAllClientsForUser($user);

        return $this->render('client/index.html.twig', array(
            'clients' => $clients,
            'user' => $this->getUser()
        ));
    }

    /**
     * Creates a new Client entity.
     *
     * @Route("/new", name="client_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $client = new Client();
        $form = $this->createForm('mysiar\Bundle\InvoiceBundle\Form\ClientType', $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $client->setInvoiceUser($this->getUser());
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('client_show', array('id' => $client->getId()));
        }

        return $this->render('client/new.html.twig', array(
            'client' => $client,
            'form' => $form->createView(),
            'user' => $this->getUser()
        ));
    }

    /**
     * Finds and displays a Client entity.
     *
     * @Route("/{id}", name="client_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $client = $this->getClientRepository()->getClientById($id, $this);

        if ($client) {
            if ($this->getClientRepository()->clientOwner($client, $this->getUser())) {
                $deleteForm = $this->createDeleteForm($client);

                return $this->render(
                    'client/show.html.twig',
                    array(
                        'client' => $client,
                        'delete_form' => $deleteForm->createView(),
                        'user' => $this->getUser()
                    )
                );
            }
        }
        return $this->redirectToRoute('client_index');
    }

    /**
     * Displays a form to edit an existing Client entity.
     *
     * @Route("/{id}/edit", name="client_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $id)
    {
        $client = $this->getClientRepository()->getClientById($id, $this);

        if ($client) {
            if ($this->getClientRepository()->clientOwner($client, $this->getUser())) {
                $deleteForm = $this->createDeleteForm($client);
                $editForm = $this->createForm('mysiar\Bundle\InvoiceBundle\Form\ClientType', $client);
                $editForm->handleRequest($request);

                if ($editForm->isSubmitted() && $editForm->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($client);
                    $em->flush();

                    return $this->redirectToRoute('client_edit', array('id' => $client->getId()));
                }

                return $this->render(
                    'client/edit.html.twig',
                    array(
                        'client' => $client,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
                        'user' => $this->getUser()
                    )
                );
            }
        }
        return $this->redirectToRoute('client_index');
    }

    /**
     * Deletes a Client entity.
     *
     * @Route("/{id}", name="client_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Client $client)
    {
        $form = $this->createDeleteForm($client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush();
        }

        return $this->redirectToRoute('client_index');
    }

    /**
     * Creates a form to delete a Client entity.
     *
     * @param Client $client The Client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Client $client)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('client_delete', array('id' => $client->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
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
}
