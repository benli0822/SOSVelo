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
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;

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
     * @Apidoc()
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
     * @Apidoc()
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
     * @Apidoc()
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
     * @Apidoc()
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
     * @Apidoc()
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

    /**
     * Index of user center
     *
     * @ApiDoc()
     * @Route("/uc")
     * @Method({"GET"})
     */
    public function ucAction() {
        return $this->render('SOSVeloUserBundle:UserCenter:uc.html.twig');
    }

    /**
     * Display all point for a user
     *
     * @Apidoc()
     * @Route("/uc/point")
     * @Method({"GET"})
     */
    public function pointAction()
    {

        $em = $this->getDoctrine()->getManager();
        $user  = $this->get('security.context')->getToken()->getUser();
        $point = $em->getRepository('SOSVeloPointBundle:Point')->findOneByUser($user->getID());
        $listPointService = $em->getRepository('SOSVeloPointBundle:PointService')->findAll();
//        $choiceList = new ObjectChoiceList($point->getServices(), 'name', array(), null, 'id');

//        \Doctrine\Common\Util\Debug::dump($point->getServices());

        foreach($point->getServices() as $key1 => $service){
//            if($listPointService->contains($service)){
//                $listPointService->remove($service);
//            }
            foreach($listPointService as $key2 => $PService) {
                if ($PService->getName() == $service->getName()) {
                    unset($listPointService[$key2]);
                }
            }
//                }
        }


        $formBuilder = $this->get('form.factory')->createBuilder('form', $point);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
            ->add('adress',      'text')
            ->add('description' , 'text')
//            ->add('services', 'choice')
//            ->add(
//                'services',
//                'choice',
//                array(
//                    'choice_list'   => $choiceList,
//                    'multiple'  => true,
//                    'required' => false
//                )
//            )
//            ->add('title',     'text')
//            ->add('content',   'textarea')
//            ->add('author',    'text')
//            ->add('published', 'checkbox')
//            ->add('save',      'submit')
        ;
        // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

        // À partir du formBuilder, on génère le formulaire
        $form = $formBuilder->getForm();

//        // On boucle sur les catégories de l'annonce pour les supprimer
//        for($i = 0 ; $i < count($point->getServices()); $i++)
//        {
//
//            $PService = $point->getServices()[$i];
//
//            for($j = 0 ; $j < count($listPointService ) ; $j++)
//            {
//                $Service = $listPointService[$j];
//
////                \Doctrine\Common\Util\Debug::dump($Service->getName());
////                \Doctrine\Common\Util\Debug::dump($j);
////                \Doctrine\Common\Util\Debug::dump($PService->getName() == $Service->getName());
////                die();
//
//                if($PService->getName() == $Service->getName()){
//                    //$listPointService->removeElement($Service);
//                    $listPointService = array_values($listPointService);
//                    unset($listPointService[$j]);
//                }
//            }
//        }

        return $this->render('SOSVeloUserBundle:UserCenter:point.html.twig',array(
            'point' => $point,
            'allService' => $listPointService,
            'form' => $form->createView()
        ));
    }

    /**
     * @Apidoc()
     * @Route("/uc/friend")
     * @Method({"GET"})
     */
    public function friendAction()
    {
        return $this->render('SOSVeloUserBundle:UserCenter:friend.html.twig');
    }

    /**
     * @Apidoc()
     * @Route("/uc/comment")
     * @Method({"GET"})
     */
    public function commentAction()
    {
        return $this->render('SOSVeloUserBundle:UserCenter:comment.html.twig');
    }

    /**
     * @Apidoc()
     * @Route("/uc/contact")
     * @Method({"GET"})
     */
    public function usercontactAction()
    {
        return $this->render('SOSVeloUserBundle:UserCenter:usercontact.html.twig');
    }

    /**
     * @Apidoc()
     * @Route("/uc/message")
     * @Method({"GET"})
     */
    public function messageAction()
    {
        return $this->render('SOSVeloUserBundle:UserCenter:message.html.twig');
    }

}
