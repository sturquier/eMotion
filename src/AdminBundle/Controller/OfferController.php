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
use PaymentBundle\Form\BillType;

class OfferController extends Controller
{
    
    /**
     * View and manage all reservations 
     *
     * @Route("/admin/reservations/view", name="admin_view_reservations")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function adminViewReservationsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $offers = $em->getRepository('LocationBundle:Offer')->findAll();

        foreach ($offers as $key => $offer) {
            $form = $this->createForm(BillType::class);
            $forms[$offer->getId()] = $form->createView();
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offer_id = $request->request->get('offer_id');
            $date_return = $request->request->get('bill')['date_return'];

            $rep = $this->getDoctrine()->getRepository('PaymentBundle:Bill');
            $bill = $rep->findOneByOffer($offer_id);
            $bill->setDateReturn(new \DateTime($date_return));
            $bill->setIsReturned(true);

            $em = $this->getDoctrine()->getManager();
            $em->persist($bill);
            $em->flush();

            $this->addFlash('success', 'Date du retour du véhicule mise a jour');
            return $this->redirectToRoute('admin_view_current_offers');

        }


        return $this->render('AdminBundle:offer:admin_view_reservations.html.twig', [
            'offers'    => $offers,
            'forms'     => $forms,
        ]);
    }

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

            $this->addFlash('success', 'Offre ajoutée');
            return $this->redirectToRoute('admin_view_offers');
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

            $this->addFlash('success', 'Offre modifiée');
            return $this->redirectToRoute('admin_view_offers');
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

        $this->addFlash('error', 'Offre supprimée');
        return $this->redirectToRoute('admin_view_offers');
    }
}