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
}