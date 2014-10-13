<?php

namespace SOSVelo\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SOSVelo\Bundle\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

/**
 * User controller that handle the CRUD
 *
 * @todo Use symfony form to get the form validations
 *
 * Class UserController
 * @package SOSVelo\Bundle\UserBundle\Controller
 */
class UserController extends Controller {

    /**
     * Get all users
     *
     * @Route("/users")
     * @Method({"GET"})
     */
    public function getUsersAction() {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
                        'SELECT u.id, u.username, u.password, u.email, u.roles
                        FROM SOSVeloUserBundle:User u
                        ORDER BY u.id ASC');

        $users = $query->getResult();

        $response = new Response($serializer->serialize(array("users" => $users), 'json'));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Get the user with the id
     *
     * @Route("/users/{id}", requirements={"id" = "\d+"})
     * @Method({"GET"})
     */
    public function getUserAction($id) {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
                        'SELECT u.id, u.username, u.email, u.roles
                        FROM SOSVeloUserBundle:User u
                        WHERE u.id = :id');
        $query->setParameter('id', $id);

        $user = $query->getResult();

        $response = new Response($serializer->serialize(array("user" => $user), 'json'));
        $response->headers->set('Content-Type', 'application/json');
        
        // If user not found
        if (sizeof($user) == 0) {
            $response->setStatusCode(404);
        }

        return $response;
    }

    /**
     * Delete an user
     *
     * @Route("/users/{id}", requirements={"id" = "\d+"})
     * @Method({"DELETE"})
     */
    public function deleteUserAction($id) {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        $user = $this->getDoctrine()
                ->getRepository('SOSVeloUserBundle:User')
                ->find($id);

        // If user not found
        if (sizeof($user) == 0){
            $response->setStatusCode(404);
        } else {
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($user);
            $em->flush();

            $response->setStatusCode(202); // Accepted
        }

        return $response;
    }

    /**
     * Update an user
     *
     * @Route("/users/{id}", requirements={"id" = "\d+"})
     * @Method({"PUT"})
     */
    public function updateUserAction($id) {
        //Preparing the response
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        // Retrieve the request
        $request = $this->get('request');

        // If the content is json
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);

            $user = $this->getDoctrine()
                    ->getRepository('SOSVeloUserBundle:User')
                    ->find($id);

            // If user not found
            if (sizeof($user) == 0){
                $response->setStatusCode(404);
            } else {
                // Creating the entity
                $user->setEmail($data["user"]["email"]);
                $user->setUsername($data["user"]["Username"]);
                $user->setPlainPassword($data["user"]["password"]);

                // Persist the user
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($user);
                $em->flush();

                $response->setStatusCode(202); // Accepted
            }
        } else {
            $response->setStatusCode(406); // Not acceptable
        }

        return $response;
    }

    /**
     * Create an user
     *
     * @Route("/users")
     * @Method({"POST"})
     */
    public function newUserAction() {
        // Preparing the response
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        // Retrieve the request
        $request = $this->get('request');

        // If the content is json
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);

            // Creating the entity
            $user = new User();
            $user->setEmail($data["user"]["email"]);
            $user->setUsername($data["user"]["Username"]);
            $user->setPlainPassword($data["user"]["password"]);

            // Persist the user
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($user);
            $em->flush();

            $response->setStatusCode(201); //Created
        } else {
            $response->setStatusCode(406); // Not acceptable
        }

        return $response;
    }

}
