<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use LocationBundle\Entity\Offer;
use LocationBundle\Form\OfferType;

class OfferController extends Controller
{
    
    /**
     * Creates a new offer entity.
     *
     * @Route("/admin/offer/add", name="admin_add_offer")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function adminAddOfferAction(Request $request)
    {
        $offer = new Offer();
        $form = $this->createForm('LocationBundle\Form\OfferType', $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();

            return $this->redirectToRoute('view_offers');
        }

        return $this->render('AdminBundle:offer:admin_add_offer.html.twig', [
            'offer'   => $offer,
            'form'    => $form->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing offer entity.
     *
     * @Route("/admin/offer/{id}/edit", name="admin_edit_offer")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function adminEditOfferAction(Request $request, Offer $offer)
    {
        $editForm = $this->createForm('LocationBundle\Form\OfferType', $offer);
        $editForm->handleRequest($request);
    
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Offre bien modifiée');
            return $this->redirectToRoute('view_offers');
        }

        return $this->render('AdminBundle:offer:admin_edit_offer.html.twig', [
            'offer'     => $offer,
            'edit_form' => $editForm->createView(),
        ]);
    }

    /**
     * Delete a offer entity.
     *
     * @Route("/admin/offer/{id}/delete", name="admin_delete_offer")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function adminDeleteOfferAction($id)
    {   
        $em = $this->getDoctrine()->getManager();

        $rep = $this->getDoctrine()->getRepository('LocationBundle:Offer');
        $offer = $rep->find($id);

        $em->remove($offer);
        $em->flush();

        $this->addFlash('success', 'Offre bien supprimée');
        return $this->redirectToRoute('view_offers');
    }
}