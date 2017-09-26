<?php

namespace LocationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LocationBundle\Entity\Vehicle;

class VehicleController extends Controller
{
    /**
     * View all vehicles 
     *
     * @Route("/vehicles/view", name="view_vehicles")
     */
    public function viewVehiclesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $vehicles = $em->getRepository('LocationBundle:Vehicle')->findAll();

        return $this->render('LocationBundle:vehicle:view_vehicles.html.twig', [
            'vehicles' => $vehicles
        ]);
    }
}
