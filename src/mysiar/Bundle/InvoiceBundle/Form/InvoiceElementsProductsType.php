<?php

namespace mysiar\Bundle\InvoiceBundle\Form;

use mysiar\Bundle\InvoiceBundle\Entity\InvoiceElementsProducts;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;



class InvoiceElementsProductsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($builder) {
            $form = $event->getForm();
            $data = $event->getData();

            if ($data instanceof InvoiceElementsProducts) {
                $form->add(
                    'product',
                    EntityType::class,
                    array(
                        'class'       => 'InvoiceBundle:Product',
                        'choices'     => $data->getProducts(),
                        'choices_as_values' => true,
                    )
                );
            }
        });
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'mysiar\Bundle\InvoiceBundle\Entity\InvoiceElementsProducts'
        ));
    }



}
