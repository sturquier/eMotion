<?php

namespace LocationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use LocationBundle\Form\VehicleType;
use LocationBundle\Entity\Vehicle;

class DefaultController extends Controller
{
	/**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$vehicles = $em->getRepository('LocationBundle:Vehicle')->findAll();
        return $this->render('LocationBundle:Default:index.html.twig',array('vehicles'=> $vehicles));
    }

     /**
     * Creates a new vehicle entity.
     *
     * @Route("/new", name="vehicle_new")
     */
    public function newAction(Request $request)
    {
        $vehicle = new Vehicle();
        $form = $this->createForm('LocationBundle\Form\VehicleType', $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('LocationBundle:Default:vehicle-form.html.twig', array(
            'vehicle' => $vehicle,
            'form' => $form->createView(),
        ));
    }
}
