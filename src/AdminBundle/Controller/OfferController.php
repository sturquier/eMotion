<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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

}