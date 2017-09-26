<?php

namespace LocationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use LocationBundle\Entity\Vehicle;
use LocationBundle\Form\VehicleType;

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
     * Displays a form to edit an existing vehicle entity.
     *
     * @Route("/vehicles/{id}/edit", name="edit_vehicle")
     */
    public function editVehicleAction(Request $request, Vehicle $vehicle)
    {
        $editForm = $this->createForm('LocationBundle\Form\VehicleType', $vehicle);
        $editForm->handleRequest($request);
    
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('view_vehicles');
        }

        return $this->render('LocationBundle:vehicle:edit_vehicle.html.twig', array(
            'vehicle' => $vehicle,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Delete a vehicle entity.
     *
     * @Route("/vehicles/{id}/delete", name="delete_vehicle")
     */
    public function deleteVehicleAction(Request $request, Vehicle $vehicle)
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vehicle);
            $em->flush();

        return $this->redirectToRoute('view_vehicles');
    }

    

     /**
     * Creates a new vehicle entity.
     *
     * @Route("/vehicle/add", name="add_vehicle")
     */
    public function addVehicleAction(Request $request)
    {
        $vehicle = new Vehicle();
        $form = $this->createForm('LocationBundle\Form\VehicleType', $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush();

            return $this->redirectToRoute('view_vehicles');
        }

        return $this->render('LocationBundle:vehicle:add_vehicle.html.twig', [
            'vehicle'   => $vehicle,
            'form'      => $form->createView(),
        ]);
    }
}
