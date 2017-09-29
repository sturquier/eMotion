<?php

namespace PaymentBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use PaymentBundle\Resources\config\config;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use LocationBundle\Entity\Offer;
use PaymentBundle\Entity\Bill;

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
	        	'constraints' => array(new NotBlank()),
	        	'label' => 'Nom du titulaire de la carte',
                'attr' => [
                    'placeholder' => 'Nom du titulaire de la carte',
                ]
	        ))
	        /*->add('number_card',TextType::class, array(
	        	'required' => true,
	        	'label' => 'Numéro de carte',
	        	'constraints' => array(
	        		new NotBlank(),
	        		new Assert\Range(array(
			            'min' => 16
			        ))
	        	),
                'attr' => [
                    'placeholder' => 'ex: 1203 4521 7854 6589',
                    'id' => 'card-element'
                ]
	        ))
	        ->add('number_cvc', IntegerType::class, array(
	        	'required' => true,
	        	'constraints' => array(new NotBlank()),
	        	'label' => 'Numéro cryptogramme',
                'attr' => [
                    'placeholder' => 'ex: 230',
                    'min' => 3,
                    'max' => 3,
                ]
	        ))
	        ->add('date_exp', DateType::class, array(
	        	'required' => true,
	        	'constraints' => array(new NotBlank()),
                'format' => 'ddMMyyyy',
                'label' => 'Date d\'expiration'
	        )) 
	        ->add('send', SubmitType::class, array(
	        	'label' => 'Envoyer'
	        )) */
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
    	$bill = new Bill();
    	$em = $this->getDoctrine()->getManager();

	    $form = $this->createPaymentForm();
	    $form->handleRequest($request);

	    if ($form->isSubmitted() && $form->isValid()) {
	        $data = $form->getData();
	        //dump($data);
	        // paiement
	        //\Stripe\Stripe::setApiKey('sk_test_sOYMH9QVjgTyYof1TCyOYWpb');

	        //$post = $_POST['stripeToken'];

		    //$charge = Charge::create(array(
		    //	'customer' => (string)$this->getUser()->getId(),
		    //	'amount' => 2000,
		    //	'currency' => 'eur'
		    //));

	        // TODO : persister la facture client, envoyer un mail et payer avec Stripe
	        $bill->setCustomer($this->getUser());
	        $bill->setOffer($offer);
	        $em->persist($bill);
	        $em->flush();

	        $this->addFlash('success', 'Paiement bien effectué. Vous allez recevoir un mail récapitulatif');
	        return $this->redirectToRoute('homepage');
	    }

        return $this->render('PaymentBundle:default:payment_form.html.twig', [
        	'form' 	=> $form->createView(),
        	'offer'	=> $offer,
        ]);
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
