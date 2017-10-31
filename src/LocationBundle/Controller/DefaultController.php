<?php

namespace LocationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	/**
     * Homepage 
     *
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $vehicles = $em->getRepository('LocationBundle:Vehicle')->findAll();

         return $this->render('LocationBundle:default:index.html.twig', [
            'vehicles' => $vehicles
        ]);
    }
}