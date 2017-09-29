<?php

namespace LocationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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

    /**
     * View specific vehicle 
     *
     * @Route("/vehicle/{id}/view", name="view_vehicle")
     * @ParamConverter("vehicle", class="LocationBundle:Vehicle")
     */
    public function viewVehicleAction(Vehicle $vehicle)
    {

        return $this->render('LocationBundle:vehicle:view_vehicle.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * View associated offers to a specific vehicle
     *
     * @Route("/vehicle/{id}/offers", name="view_vehicle_offers")
     * @ParamConverter("vehicle", class="LocationBundle:Vehicle")
     */
    public function viewVehicleOffersAction(Vehicle $vehicle)
    {

        return $this->render('LocationBundle:vehicle:view_vehicle_offers.html.twig', [
            'vehicle' => $vehicle,
        ]);  
    }
}