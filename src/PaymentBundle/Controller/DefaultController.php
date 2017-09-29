<?php

namespace PaymentBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use LocationBundle\Entity\Offer;


class DefaultController extends Controller
{
	/**
	 * Creates a payment form
	 */
	private function createPaymentForm()
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

	    return $form;
	}

	/**
     * Payment form view
     *
     * @Route("/offer/{id}/payment_form", name="offer_payment_form")
     * @ParamConverter("offer", class="LocationBundle:Offer")
     */
    public function paymentFormAction(Request $request, Offer $offer)
    {
	    $form = $this->createPaymentForm();

	    $form->handleRequest($request);

	    if ($form->isSubmitted() && $form->isValid()) {
	        // data is an array with "name", "email", and "message" keys
	        $data = $form->getData();

	        return $this->redirectToRoute('payment_submit');
	    }

        return $this->render('PaymentBundle:default:payment_form.html.twig', [
        	'form' 	=> $form->createView(),
        	'offer'	=> $offer,
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
	    return $this->render('PaymentBundle:default:payment_confirm.html.twig');
    }
	/**
     * Payment 
     *
     * @Route("/payment/mail", name="payment_send_mail_view")
     */
    public function envoiMailAction()
	{
	    $message = (new \Swift_Message('Hello Email'))
	     	->setSubject("ma qué ?")
	        ->setFrom('haha@haha.com')
	        ->setTo('pathe.barry.92@gmail.com')
	        ->setBody('lol');

	    $this->get('mailer')->send($message);


	    return $this->render('PaymentBundle:default:confirmation.html.twig');
	}
}
