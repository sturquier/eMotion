<?php

namespace LocationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use LocationBundle\Entity\Vehicle;

class DefaultController extends Controller
{
	/**
     * Homepage 
     *
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $vehicles = $em->getRepository('LocationBundle:Vehicle')->findAll();

         return $this->render('LocationBundle:default:index.html.twig', [
            'vehicles' => $vehicles
        ]);
    }

    /**
     * View associated offers to a specific vehicle
     *
     * @Route("/vehicle/{id}/offers-related", name="view_vehicle_slider")
     * @ParamConverter("vehicle", class="LocationBundle:Vehicle")
     */
    public function viewVehicleSliderAction(Vehicle $vehicle)
    {

        return $this->render('LocationBundle:vehicle:view_vehicle_slider.html.twig', [
            'vehicle' => $vehicle,
        ]);  
    }
}