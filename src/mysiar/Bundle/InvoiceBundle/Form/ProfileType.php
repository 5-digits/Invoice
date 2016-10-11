<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-10-11
 * Time: 18:32
 *
 * overrides default FOSUser Profile Edit form
 *
 * http://symfony.com/doc/current/bundles/FOSUserBundle/overriding_forms.html


# app/config/services.yml
services:
    app.form.profile:
        class: mysiar\Bundle\InvoiceBundle\Form\ProfileType
        tags:
            - { name: form.type, alias: app_user_profile }



# app/config/config.yml
fos_user:
    # ...
    profile:
        form:
            type: mysiar\Bundle\InvoiceBundle\Form\ProfileType


 */



namespace mysiar\Bundle\InvoiceBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('locale');
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}