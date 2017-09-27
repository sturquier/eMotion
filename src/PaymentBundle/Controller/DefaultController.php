<?php

namespace PaymentBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	/**
     * Payment 
     *
     * @Route("/payment", name="payment_view")
     */
    public function indexAction()
    {
        return $this->render('PaymentBundle:Default:index.html.twig');
    }
}
