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

    /**
     * @Apidoc()
     * @Route("/friend")
     * @Template()
     */
    public function friendAction()
    {
        return $this->render('SOSVeloTemplateBundle:Template:friend.html.twig');
    }

    /**
     * @Apidoc()
     * @Route("/comment")
     * @Template()
     */
    public function commentAction()
    {
        return $this->render('SOSVeloTemplateBundle:Template:comment.html.twig');
    }

    /**
     * @Apidoc()
     * @Route("/usercontact")
     * @Template()
     */
    public function usercontactAction()
    {
        return $this->render('SOSVeloTemplateBundle:Template:usercontact.html.twig');
    }

    /**
     * @Apidoc()
     * @Route("/message")
     * @Template()
     */
    public function messageAction()
    {
        return $this->render('SOSVeloTemplateBundle:Template:message.html.twig');
    }
}
