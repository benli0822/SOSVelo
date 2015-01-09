<?php

namespace SOSVelo\Bundle\TemplateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class TemplateController extends Controller
{
    /**
     * @Apidoc()
     * @Route("/home")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('SOSVeloTemplateBundle:Template:index.html.twig');
    }

    /**
     * @Apidoc()
     * @Route("/contact")
     * @Template()
     */
    public function contactAction()
    {
        return $this->render('SOSVeloTemplateBundle:Template:contact.html.twig');
    }
}
