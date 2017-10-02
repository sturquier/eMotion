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
	        ->add('customer', TextType::class, array(
	        	'required' => true,
	        	'constraints' => array(
	        		new NotBlank(),
	        		new  Assert\Regex(array(
			            'pattern' => '/\d/',
			            'match'   => false
			        )),
	        		new Assert\Length(array('min' => 2))
	        	),
	        	'label' => 'Nom du titulaire de la carte',
                'attr' => [
                    'placeholder' => 'Prénom Nom',
                ]
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
    	$bill = new Bill();
    	$em = $this->getDoctrine()->getManager();

	    $form = $this->createPaymentForm();
	    $form->handleRequest($request);

	    if ($form->isSubmitted() && $form->isValid()) {
	        $data = $form->getData();
	        //dump($data);
	        // paiement
	        \Stripe\Stripe::setApiKey('sk_test_sOYMH9QVjgTyYof1TCyOYWpb');

	        $post = $_POST['stripeToken'];

			// Create a Customer:
			$customer = \Stripe\Customer::create(array(
			  "description" => $data['customer'],
			  "source" => $post,
			));

		    $charge = \Stripe\Charge::create(array(
		    	'customer' => $customer->id,
		    	'amount' => $_POST['amount']*100,
		    	'currency' => 'eur'
		    ));


	        // TODO : envoyer un mail et payer avec Stripe
	        $bill->setCustomer($this->getUser());
	        $bill->setOffer($offer);
	        $em->persist($bill);

	        $offer->setIsAvailable(false);
	        $em->persist($offer);

	        $em->flush();

	        $this->addFlash('success', 'Paiement bien effectué. Vous allez recevoir un mail récapitulatif');
	        return $this->redirectToRoute('homepage');
	    }

        return $this->render('PaymentBundle:default:payment_form.html.twig', [
        	'form' 	=> $form->createView(),
        	'offer'	=> $offer,
        ]);
    }
}
