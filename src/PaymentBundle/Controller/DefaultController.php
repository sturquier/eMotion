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
	/**
     * Payment 
     *
     * @Route("/payment/mail", name="payment_envoi_mail_view")
     */
    public function envoiMailAction()
	{
	    $message = (new \Swift_Message('Hello Email'))
	     	->setSubject("ma qué ?")
	        ->setFrom('haha@haha.com')
	        ->setTo('pathe.barry.92@gmail.com')
	        ->setBody('lol');

	    $this->get('mailer')->send($message);


	    return $this->render('PaymentBundle:Default:confirmation.html.twig');
	}
}
