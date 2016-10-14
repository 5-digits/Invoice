<?php

namespace mysiar\Bundle\InvoiceBundle\Controller;

use mysiar\Bundle\InvoiceBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Product controller.
 *
 * @Route("product")
 */
class ProductController extends Controller
{
    /**
     * Lists all product entities.
     *
     * @Route("/", name="product_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $user = $this->getUser();

        $products = $this->getProductRepository()->getAllProductsForUser($user);

        return $this->render('product/index.html.twig', array(
            'products' => $products,
            'user' => $user,
        ));
    }

    /**
     * Creates a new product entity.
     *
     * @Route("/new", name="product_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $product = new Product();
        $form = $this->createForm('mysiar\Bundle\InvoiceBundle\Form\ProductType', $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $product->setInvoiceUser($user);
            $em->persist($product);
            $em->flush($product);

            return $this->redirectToRoute(
                'product_show',
                array(
                    'id' => $product->getId(),
                    'user' => $user
                )
            );
        }

        return $this->render('product/new.html.twig', array(
            'product' => $product,
            'form' => $form->createView(),
            'user' => $user,
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}", name="product_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $user = $this->getUser();
        $product = $this->getProductRepository()->getProductById($id);

        if ($product) {
            if ($this->getProductRepository()->productOwner($product, $user)) {
                $deleteForm = $this->createDeleteForm($product);

                return $this->render('product/show.html.twig', array(
                    'product' => $product,
                    'delete_form' => $deleteForm->createView(),
                    'user' => $user,
                ));
            }
        }
        return $this->redirectToRoute('product_index');
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     * @Route("/{id}/edit", name="product_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $id)
    {
        $user = $this->getUser();
        $product = $this->getProductRepository()->getProductById($id);

        if ($product) {
            if ($this->getProductRepository()->productOwner($product, $user)) {
                $deleteForm = $this->createDeleteForm($product);
                $editForm = $this->createForm('mysiar\Bundle\InvoiceBundle\Form\ProductType', $product);
                $editForm->handleRequest($request);

                if ($editForm->isSubmitted() && $editForm->isValid()) {
                    $this->getDoctrine()->getManager()->flush();

                    return $this->redirectToRoute(
                        'product_edit',
                        array(
                            'id' => $product->getId(),
                            'user' => $user,
                        )
                    );
                }

                return $this->render(
                    'product/edit.html.twig',
                    array(
                        'product' => $product,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
                        'user' => $user,
                    )
                );
            }
        }
        return $this->redirectToRoute('product_index');
    }

    /**
     * Deletes a product entity.
     *
     * @Route("/{id}", name="product_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $user = $this->getUser();
        $product = $this->getProductRepository()->getProductById($id);

        if ($product) {
            if ($this->getProductRepository()->productOwner($product, $user)) {
                $form = $this->createDeleteForm($product);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($product);
                    $em->flush($product);
                }
            }
        }

        return $this->redirectToRoute('product_index');
    }

    /**
     * Creates a form to delete a product entity.
     *
     * @param Product $product The product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Gets InvoiceBundle:Product repository
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    private function getProductRepository()
    {
        return $this->getDoctrine()->getRepository('InvoiceBundle:Product');
    }
}
