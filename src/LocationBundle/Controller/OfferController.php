<?php

namespace LocationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use LocationBundle\Entity\Offer;
use LocationBundle\Form\OfferType;
use LocationBundle\Service\OfferChecker;

class OfferController extends Controller
{
    /**
     * View all offers 
     *
     * @Route("/offers/view", name="view_offers")
     */
    public function viewOffersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $offers = $em->getRepository('LocationBundle:Offer')->findAll();

        return $this->render('LocationBundle:offer:view_offers.html.twig', [
            'offers' => $offers
        ]);
    }

    /**
     * View offer recap before payment
     *
     * @Route("/offer/{id}/recap", name="view_offer_recap")
     */
    public function viewOfferRecapAction(Offer $offer, OfferChecker $checker)
    {
        if (!$checker->isAvailableOffer($offer)) {
            $this->addFlash('error', 'Cette offre est désactivée !');
            return $this->redirectToRoute('homepage');
        }

        return $this->render('LocationBundle:offer:view_offer_recap.html.twig', [
            'offer' => $offer
        ]);
    }
}