<?php

namespace SOSVelo\Bundle\TemplateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;



class TemplateController extends Controller
{
    /**
     * @Apidoc()
     * @Route("/home")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $id = 'thread_id';
        $thread = $this->container->get('fos_comment.manager.thread')->findThreadById($id);
        if (null === $thread) {
            $thread = $this->container->get('fos_comment.manager.thread')->createThread();
            $thread->setId($id);
            $thread->setPermalink($request->getUri());

            // Add the thread
            $this->container->get('fos_comment.manager.thread')->saveThread($thread);
        }
        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);

        return $this->render('SOSVeloTemplateBundle:Template:index.html.twig',
            array(
                'comments' => $comments,
                'thread' => $thread,
            )
    );
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

}
