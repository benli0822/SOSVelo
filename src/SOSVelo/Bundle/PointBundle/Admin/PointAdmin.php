<?php
/**
 * Created by PhpStorm.
 * User: benli
 * Date: 04/02/15
 * Time: 21:39
 */

namespace SOSVelo\Bundle\PointBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

use SOSVelo\Bundle\PointBundle\Entity\Point;

class PointAdmin extends Admin {

    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('address')
            ->add('description')
            ->add('rating')
            ->add('activated')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
//            ->add('enabled', null, array('required' => false))
            ->add('name')
            ->add('address')
            ->add('description')
            ->add('rating')
            ->add('activated')
//            ->end()
//            ->with('Tags')
//            ->add('tags', 'sonata_type_model', array('expanded' => true))
//            ->end()
//            ->with('Comments')
//            ->add('comments', 'sonata_type_model')
//            ->end()
//            ->with('System Information', array('collapsed' => true))
//            ->add('created_at')
            ->end()
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('address')
            ->add('description')
            ->add('rating')
            ->add('activated')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('address')
        ;
    }
}