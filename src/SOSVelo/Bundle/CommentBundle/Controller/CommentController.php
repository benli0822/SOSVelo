<?php

namespace SOSVelo\Bundle\CommentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SOSVelo\Bundle\CommentBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

/**
 * Comment controller that handle the CRUD
 *
 * @todo Use symfony form to get the form validations
 *
 * Class CommentController
 * @package SOSVelo\Bundle\CommentBundle\Controller
 */
class CommentController extends Controller {

    /**
     * Get all comments
     *
     * @Route("/comments")
     * @Method({"GET"})
     */
    public function getCommentsAction() {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
                        //'SELECT c.id, c.thread_id, c.author_id, c.body, c.ancestors, c.depth, c.created_at, c.state, c.score
                        'SELECT c.id, c.body, c.ancestors, c.depth, c.state, c.score
                        FROM SOSVeloCommentBundle:Comment c
                        ORDER BY c.id ASC');

        $comments = $query->getResult();

        $response = new Response($serializer->serialize(array("comments" => $comments), 'json'));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Get the comment with the id
     *
     * @Route("/comments/{id}", requirements={"id" = "\d+"})
     * @Method({"GET"})
     */
    public function getCommentAction($id) {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $comment = $this->getDoctrine()
            ->getRepository('SOSVeloCommentBundle:Comment')
            ->find($id);
        
//        $em = $this->getDoctrine()->getEntityManager();
//        $query = $em->createQuery(
//                        //'SELECT c.id, c.thread_id, c.author_id, c.body, c.ancestors, c.depth, c.created_at, c.state, c.score
//                        'SELECT c.id, c.body, c.ancestors, c.depth, c.state, c.score
//                        FROM SOSVeloCommentBundle:Comment c
//                        WHERE c.id = :id');
//        $query->setParameter('id', $id);
//
//        $comment = $query->getResult();

        $response = new Response($serializer->serialize(array("comment" => $comment), 'json'));
        $response->headers->set('Content-Type', 'application/json');
        
        // If comment not found
        if (sizeof($comment) == 0) {
            $response->setStatusCode(404);
        }

        return $response;
    }

    /**
     * Delete an comment
     *
     * @Route("/comments/{id}", requirements={"id" = "\d+"})
     * @Method({"DELETE"})
     */
    public function deleteCommentAction($id) {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        $comment = $this->getDoctrine()
                ->getRepository('SOSVeloCommentBundle:Comment')
                ->find($id);

        // If comment not found
        if (sizeof($comment) == 0){
            $response->setStatusCode(404);
        } else {
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($comment);
            $em->flush();

            $response->setStatusCode(202); // Accepted
        }

        return $response;
    }

    /**
     * Update an comment
     *
     * @Route("/comments/{id}", requirements={"id" = "\d+"})
     * @Method({"PUT"})
     */
    public function updateCommentAction($id) {
        //Preparing the response
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        // Retrieve the request
        $request = $this->get('request');

        // If the content is json
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);

            $comment = $this->getDoctrine()
                    ->getRepository('SOSVeloCommentBundle:Comment')
                    ->find($id);

            // If comment not found
            if (sizeof($comment) == 0){
                $response->setStatusCode(404);
            } else {
                // Creating the entity
                $comment->setEmail($data["comment"]["email"]);
                $comment->setCommentname($data["comment"]["Commentname"]);
                $comment->setPlainPassword($data["comment"]["password"]);

                // Persist the comment
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($comment);
                $em->flush();

                $response->setStatusCode(202); // Accepted
            }
        } else {
            $response->setStatusCode(406); // Not acceptable
        }

        return $response;
    }

    /**
     * Create an comment
     *
     * @Route("/comments")
     * @Method({"POST"})
     */
    public function newCommentAction() {
        // Preparing the response
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        // Retrieve the request
        $request = $this->get('request');

        // If the content is json
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);

            // Creating the entity
            $comment = new Comment();
            $comment->setEmail($data["comment"]["email"]);
            $comment->setCommentname($data["comment"]["Commentname"]);
            $comment->setPlainPassword($data["comment"]["password"]);

            // Persist the comment
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($comment);
            $em->flush();

            $response->setStatusCode(201); //Created
        } else {
            $response->setStatusCode(406); // Not acceptable
        }

        return $response;
    }

}
