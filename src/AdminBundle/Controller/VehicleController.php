<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use LocationBundle\Entity\Vehicle;
use LocationBundle\Form\VehicleType;

class VehicleController extends Controller
{   

    /**
     * View all vehicles 
     *
     * @Route("/admin/vehicles/view", name="admin_view_vehicles")
     */
    public function viewVehiclesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $vehicles = $em->getRepository('LocationBundle:Vehicle')->findAll();

        return $this->render('AdminBundle:vehicle:admin_view_vehicles.html.twig', [
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Creates a new vehicle entity.
     *
     * @Route("/admin/vehicle/add", name="admin_add_vehicle")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function adminAddVehicleAction(Request $request)
    {
        $vehicle = new Vehicle();
        $form = $this->createForm('LocationBundle\Form\VehicleType', $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush();

            $this->addFlash('success', 'Vehicule ajouté');
            return $this->redirectToRoute('admin_view_vehicles');
        }

        return $this->render('AdminBundle:vehicle:admin_add_vehicle.html.twig', [
            'vehicle'   => $vehicle,
            'form'      => $form->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing vehicle entity.
     *
     * @Route("/admin/vehicle/{id}/edit", name="admin_edit_vehicle")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function adminEditVehicleAction(Request $request, Vehicle $vehicle)
    {
        $editForm = $this->createForm('LocationBundle\Form\VehicleType', $vehicle);
        $editForm->handleRequest($request);
    
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Vehicule modifié');
            return $this->redirectToRoute('admin_view_vehicles');
        }

        return $this->render('AdminBundle:vehicle:admin_edit_vehicle.html.twig', [
            'vehicle' => $vehicle,
            'edit_form' => $editForm->createView(),
        ]);
    }

    /**
     * Delete a vehicle entity.
     *
     * @Route("/admin/vehicle/{id}/delete", name="admin_delete_vehicle")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function adminDeleteVehicleAction(Vehicle $vehicle)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($vehicle);
        $em->flush();

        $this->addFlash('danger', 'Vehicule et offres associées supprimés ');
        return $this->redirectToRoute('admin_view_vehicles');
    }
}
