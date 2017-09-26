<?php

namespace LocationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use LocationBundle\Entity\Offer;
use LocationBundle\Form\OfferType;

class OfferController extends Controller
{
    /**
     * View all offers 
     *
     * @Route("/offer/view", name="view_offers")
     */
    public function viewOffersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $offers = $em->getRepository('LocationBundle:Offer')->findAll();

        return $this->render('LocationBundle:offer:view_offers.html.twig', [
            'offers' => $offers
        ]);
    }
}