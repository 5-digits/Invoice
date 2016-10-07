<?php

namespace mysiar\Bundle\InvoiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clientName')
            ->add('companyName')
            ->add('vatId')
            ->add('addressStreet')
            ->add('addressHouse')
            ->add('addressFlat')
            ->add('addressZip')
            ->add('addressCity')
            ->add('addressCountry')
            ->add('contactPhone')
            ->add('contactMobile')
            ->add('contactFax')
            ->add('contactEmail')
            ->add('contactWww')

        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'mysiar\Bundle\InvoiceBundle\Entity\Client'
        ));
    }
}
