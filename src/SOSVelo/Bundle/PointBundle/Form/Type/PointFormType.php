<?php

namespace SOSVelo\Bundle\PointBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface; 

class PointFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name', null, array('label' => 'Nom : '))
                ->add('adress', null, array('label' => 'Adresse : '))
                ->add('description', 'textarea', array('label' => 'Description : '))
                ->add('latitude', null, array('label' => 'Latitude : '))
                ->add('longitude', null, array('label' => 'Longitude : '));
    }

    public function getName()
    {
        return 'sosvelo_add_point';
    }
}