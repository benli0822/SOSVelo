<?php

namespace SOSVelo\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->add('roles', 'choice', array('choices' => 
                array(
                    'ROLE_USER' => 'Non',
                    'ROLE_TRADER' => 'Oui',
                ),
                'label' => 'Commerçant : ',
                'required'  => true,
                'multiple' => true
            ));
    }

    public function getName() {
        return 'sosvelo_user_registration';
    }

}
