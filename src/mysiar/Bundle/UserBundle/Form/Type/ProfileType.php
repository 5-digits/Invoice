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
        class: mysiar\Bundle\UserBundle\Form\Type\ProfileType
        tags:
            - { name: form.type, alias: app_user_profile }



# app/config/config.yml
fos_user:
    # ...
    profile:
        form:
            type: mysiar\Bundle\UserBundle\Form\Type\ProfileType


 */



namespace mysiar\Bundle\UserBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Range;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('locale', ChoiceType::class, array(
            'choices'  => array(
                'Polish / Polski' => 'pl',
                'English / Angielski' => 'en',

            ),
            // *this line is important*
            'choices_as_values' => true,
        ));

        $builder->add('invoiceNumberPrefix');
        $builder->add('payment');
        $builder->add('companyName');
        $builder->add('vatId');
        $builder->add('addressStreet');
        $builder->add('addressHouse');
        $builder->add('addressFlat');
        $builder->add('addressZip');
        $builder->add('addressCity');
        $builder->add('addressCountry');

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