<?php

namespace SOSVelo\Bundle\PointBundle\Form;

use SOSVelo\Bundle\PointBundle\Entity\Point;
use SOSVelo\Bundle\PointBundle\Entity\ServiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class PointType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text')
            ->add('address','text')
            ->add('description','text')
            ->add('services','entity', array(
                'class' => 'SOSVeloPointBundle:PointService',
                'property' => 'name',
                'multiple' => true
            ))
            ->add('save','submit',array(
                'attr' => array(
                    'class' => 'button special'
                    )
            ))
//            ->add('longitude')
//            ->add('latitude')
//            ->add('rating')
//            ->add('activated')
//            ->add('comments')
//            ->add('user')
//            ->add('services')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SOSVelo\Bundle\PointBundle\Entity\Point'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sosvelo_bundle_pointbundle_point';
    }
}
