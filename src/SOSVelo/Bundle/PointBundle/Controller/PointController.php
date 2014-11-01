<?php

namespace SOSVelo\Bundle\PointBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SOSVelo\Bundle\PointBundle\Entity\Point;
use SOSVelo\Bundle\PointBundle\Form\Type\PointFormType;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Point controller that handle the CRUD
 *
 * @todo Use symfony form to get the form validations
 *
 * Class PointController
 * @package SOSVelo\Bundle\PointBundle\Controller
 */
class PointController extends Controller {

    /**
     * Add_point with form
     *
     * @Apidoc()
     * @Route("/add_point")
     */
    public function add_pointAction() {
        $point = new Point();
        $form = $this->createForm(new PointFormType(), $point);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $point->setActivated(false);
                $em->persist($point);
                $em->flush();
                
                echo '<script type="text/javascript">alert("Votre demande a été enregistrée."); window.location.href = "home"; </script> ';
                //return $this->redirect($this->generateUrl('sosvelo_home'));
            }
        }

        return $this->render('SOSVeloPointBundle:Point:add_point.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    /**
     * Create an point with json
     *
     * @Apidoc()
     * @Route("/points")
     * @Method({"POST"})
     */
    public function newPointAction() {
        // Preparing the response
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        // Retrieve the request
        $request = $this->get('request');

        // If the content is json
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);

            // Creating the entity
            $point = new Point();
            $point->setName($data["point"]["name"]);
            $point->setAdress($data["point"]["adress"]);
            $point->setDescription($data["point"]["description"]);
            $point->setLongitude($data["point"]["longitude"]);
            $point->setLatitude($data["point"]["latitude"]);
            $point->setRating($data["point"]["rating"]);
            $point->setActivated($data["point"]["activated"]);

            // Persist the point
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($point);
            $em->flush();

            $response->setStatusCode(201); //Created
        } else {
            $response->setStatusCode(406); // Not acceptable
        }

        return $response;
    }

    /**
     * Get all points
     *
     * @Apidoc()
     * @Route("/points")
     * @Method({"GET"})
     */
    public function getPointsAction() {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $points = $this->getDoctrine()
                ->getRepository('SOSVeloPointBundle:Point')
                ->findAll();

        $response = new Response($serializer->serialize(array("points" => $points), 'json'));
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $response;
    }

    /**
     * Get all points
     *
     * @Apidoc()
     * @Route("/geojson/points")
     * @Method({"GET"})
     */
    public function getGeojsonPointsAction() {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery(
                'SELECT p.id, p.name, p.adress, p.description, p.longitude, p.latitude, p.activated
                        FROM SOSVeloPointBundle:Point p
                        ORDER BY p.id ASC');

        $result = $query->getResult();

        $var = "var points = ";
        $points = array(
            'type' => 'FeatureCollection',
            'features' => array()
        );
        for ($i = 0; $i < count($result); $i++) {
            $feature = array(
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array($result[$i]["longitude"], $result[$i]["latitude"])
                ),
                'type' => 'Feature',
                'properties' => array(
                    'id' => $result[$i]["id"],
                    'name' => $result[$i]["name"],
                    'adress' => $result[$i]["adress"],
                    'description' => $result[$i]["description"],
                    'activated' => $result[$i]["activated"]
                )
            );
            array_push($points['features'], $feature);
        }

        $response = new Response($var . $serializer->serialize($points, 'json'));
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $response;
    }

    /**
     * Get the point with the id
     *
     * @Apidoc()
     * @Route("/points/{id}", requirements={"id" = "\d+"})
     * @Method({"GET"})
     */
    public function getPointAction($id) {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $point = $this->getDoctrine()
                ->getRepository('SOSVeloPointBundle:Point')
                ->find($id);

        $response = new Response($serializer->serialize(array("point" => $point), 'json'));
        $response->headers->set('Content-Type', 'application/json');

        // If point not found
        if (sizeof($point) == 0) {
            $response->setStatusCode(404);
        }

        return $response;
    }

    /**
     * activate the point
     *
     * @Apidoc()
     * @Route("/points/activate/{id}", requirements={"id" = "\d+"})
     * @Method({"POST"})
     */
    public function activatePointAction($id) {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        $point = $this->getDoctrine()
                ->getRepository('SOSVeloPointBundle:Point')
                ->find($id);

        // If not instance of point
        if (!$point instanceof Point) {
            $response->setStatusCode(404);
        } else {
            $em = $this->getDoctrine()->getEntityManager();
            $point->setActivated(true);
            $em->persist($point);
            $em->flush();

            $response->setStatusCode(202); // Accepted
        }

        return $response;
    }

    /**
     * Get the comments of the point with the id
     *
     * @Apidoc()
     * @Route("/points/{id}/comments", requirements={"id" = "\d+"})
     * @Method({"GET"})
     */
    public function getCommentsPointAction($id) {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $point = $this->getDoctrine()
                ->getRepository('SOSVeloPointBundle:Point')
                ->find($id);

        $response = new Response($serializer->serialize(array("point" => $point), 'json'));
        $response->headers->set('Content-Type', 'application/json');

        // If point not found
        if (sizeof($point) == 0) {
            $response->setStatusCode(404);
        }

        return $response;
    }

    /**
     * Delete an point
     *
     * @Apidoc()
     * @Route("/points/{id}", requirements={"id" = "\d+"})
     * @Method({"DELETE"})
     */
    public function deletePointAction($id) {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        $point = $this->getDoctrine()
                ->getRepository('SOSVeloPointBundle:Point')
                ->find($id);

        // If not instance of point
        if (!$point instanceof Point) {
            $response->setStatusCode(404);
        } else {
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($point);
            $em->flush();

            $response->setStatusCode(202); // Accepted
        }

        return $response;
    }

    /**
     * Update an point
     *
     * @Apidoc()
     * @Route("/points/{id}", requirements={"id" = "\d+"})
     * @Method({"PUT"})
     */
    public function updatePointAction($id) {
        //Preparing the response
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        // Retrieve the request
        $request = $this->get('request');

        // If the content is json
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);

            $point = $this->getDoctrine()
                    ->getRepository('SOSVeloPointBundle:Point')
                    ->find($id);

            // If point not found
            if (sizeof($point) == 0) {
                $response->setStatusCode(404); // Not found
            } else {
                // Creating the entity
                $point->setName($data["point"]["name"]);
                $point->setAdress($data["point"]["adress"]);
                $point->setDescription($data["point"]["description"]);
                $point->setLongitude($data["point"]["longitude"]);
                $point->setLatitude($data["point"]["latitude"]);
                $point->setRating($data["point"]["rating"]);
                $point->setActivated($data["point"]["activated"]);

                // Persist the point
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($point);
                $em->flush();

                $response->setStatusCode(202); // Accepted
            }
        } else {
            $response->setStatusCode(406); // Not acceptable
        }

        return $response;
    }

}
