<?php

namespace mysiar\Bundle\InvoiceBundle\Form;


use mysiar\Bundle\InvoiceBundle\Entity\Invoice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add(
                'invoiceNumber',
                TextType::class,
                array('disabled'=>'true')
            )
            ->add(
                'dateOfIssue',
                DateType::class,
                array('widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'placeholder' => 'yyyy-MM-dd'
                )
            )
            ->add(
                'dateOfSell',
                DateType::class,
                array('widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'placeholder' => 'yyyy-MM-dd'
                )
            )
            ->add(
                'paymentDue',
                DateType::class,
                array('widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'placeholder' => 'yyyy-MM-dd'
                )
            )
//            ->add('isInvoiceNet', ChoiceType::class, array(
//                    'choices' => array(
//                        'select.invoice.net' => true,
//                        'select.invoice.gross' => false,
//                    ),
//                    // *this line is important*
//                    'choices_as_values' => true,
//                ))
        ;


        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($builder) {
            $form = $event->getForm();
            $data = $event->getData();

            if ($data instanceof Invoice) {
                $form->add(
                    'client',
                    EntityType::class,
                    array(
                    'class'       => 'InvoiceBundle:Client',
                    'placeholder' => '',
                    'choices'     => $data->getInvoiceUser()->getClients(),
                    )
                );
            }
        });
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'mysiar\Bundle\InvoiceBundle\Entity\Invoice'
        ));
    }
}
