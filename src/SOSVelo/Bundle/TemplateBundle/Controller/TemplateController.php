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

    /**
     * @Apidoc()
     * @Route("/generic")
     * @Template()
     */
    public function genericAction()
    {
        return $this->render('SOSVeloTemplateBundle:Template:generic.html.twig');
    }

    /**
     * @Apidoc()
     * @Route("/login")
     * @Template()
     */
    public function loginAction()
    {
        return $this->render('SOSVeloTemplateBundle:Template:login.html.twig');
    }

    /**
     * @Apidoc()
     * @Route("/register")
     * @Template()
     */
    public function registerAction()
    {
        return $this->render('SOSVeloTemplateBundle:Template:register.html.twig');
    }

    /**
     * @Apidoc()
     * @Route("/uc")
     * @Template()
     */
    public function ucAction()
    {
        return $this->render('SOSVeloTemplateBundle:Template:uc.html.twig');
    }

    /**
     * @Apidoc()
     * @Route("/point")
     * @Template()
     */
    public function pointAction()
    {
        return $this->render('SOSVeloTemplateBundle:Template:point.html.twig');
    }
}
