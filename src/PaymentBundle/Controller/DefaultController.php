<?php

namespace PaymentBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
	/**
     * Payment view
     *
     * @Route("/payment/form", name="payment_view")
     */
    public function indexAction(Request $request)
    {
	    $form = $this->createFormBuilder()
	        ->add('name', TextType::class, array(
	        	'required' => true,
	        	'label' => 'Nom du titulaire de la carte',
                'attr' => [
                    'placeholder' => 'Nom du titulaire de la carte',
                ]
	        ))
	        ->add('number_card', IntegerType::class, array(
	        	'required' => true,
	        	'label' => 'Numéro de carte',
                'attr' => [
                    'placeholder' => 'ex: 1203 4521 7854 6589',
                    'min' => 16,
                    'max' => 16,
                ]
	        ))
	        ->add('number_cvc', IntegerType::class, array(
	        	'required' => true,
	        	'label' => 'Numéro cryptogramme',
                'attr' => [
                    'placeholder' => 'ex: 230',
                    'min' => 3,
                    'max' => 3,
                ]
	        ))
	        ->add('date_exp', DateType::class, array(
	        	'required' => true,
                'format' => 'ddMMyyyy',
                'label' => 'Date d\'expiration'
	        ))
	        ->add('send', SubmitType::class, array(
	        	'label' => 'Envoyer'
	        ))
	        ->getForm();

	    $form->handleRequest($request);

	    if ($form->isSubmitted() && $form->isValid()) {
	        // data is an array with "name", "email", and "message" keys
	        $data = $form->getData();

	        return $this->redirectToRoute('payment_submit');
	    }

        return $this->render('PaymentBundle:Default:index.html.twig', [
        	'form' => $form->createView()
        ]);
    }

    /**
     * Payment action 
     *
     * @Route("/payment/form/submit", name="payment_submit")
     */
    public function paymentSubmitAction()
    {
    	var_dump((string)$this->getUser()->getId());

	    /*\Stripe\Stripe::setApiKey('pk_test_7RFP43V6JWGyPLVJFZlzk7Z0');

	    $charge = Stripe_Charge::create(array(
	    	'customer' => (string)$this->getUser()->getId(),
	    	'amount' => 2000,
	    	'currency' => 'eur'
	    ));*/
	    return $this->render('PaymentBundle:Default:payment_confirm.html.twig');
    }
}
