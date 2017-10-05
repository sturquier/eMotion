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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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
     * @Security("has_role('ROLE_USER')")
     */
    public function paymentFormAction(Request $request, Offer $offer)
    {
    	$bill = new Bill();
    	$em = $this->getDoctrine()->getManager();

	    $form = $this->createPaymentForm();
	    $form->handleRequest($request);
	    $mail = $this->getUser()->getEmail();
	    dump($this->getUser());
	    if ($form->isSubmitted() && $form->isValid()) {
	        $data = $form->getData();
	        // paiement
	        \Stripe\Stripe::setApiKey('sk_test_sOYMH9QVjgTyYof1TCyOYWpb');

	        $user = $this->getUser();
	        $customerId = $user->getCustomerId();

	        $post = $_POST['stripeToken'];

	        if($customerId == null) {
		        // Create a Customer
				$customer = \Stripe\Customer::create(array(
					'email' => $mail,
					'description' => $data['customer'],
					'source' => $post
				));

				$charge = \Stripe\Charge::create(array(
			    	'customer' => $customer->id,
			    	'amount' => $_POST['amount']*100, // for add cents
			    	'currency' => 'eur',
			    	'description' => 'location',
			    	'receipt_email' => $mail, // to send automatically receipt (not working on test mode)
			    ));
			} else {
				// Retrieve the Customer
				$customer = \Stripe\Customer::retrieve($customerId);

				$charge = \Stripe\Charge::create(array(
			    	'customer' => $customer->id,
			    	'amount' => $_POST['amount']*100, // for add cents
			    	'currency' => 'eur',
			    	'description' => 'location',
			    	'receipt_email' => $mail, // to send automatically receipt (not working on test mode)
			    ));
			}

	        $bill->setCustomer($this->getUser());
	        $bill->setOffer($offer);
	        $bill->setAmount($offer->getPriceLocation());
	        $bill->setIsReturned(false);
	        $em->persist($bill);

	        $offer->setIsAvailable(false);
	        $em->persist($offer);

	        
	        $user->setCustomerId($customer->id);
	        $em->persist($user);

	        $em->flush();

	        $this->addFlash('success', 'Paiement bien effectué. Vous allez recevoir un mail récapitulatif');
	        return $this->redirectToRoute('view_orders');
	    }

        return $this->render('PaymentBundle:default:payment_form.html.twig', [
        	'form' 	=> $form->createView(),
        	'offer'	=> $offer,
        ]);
    }

    /**
     * Post location payment form view
     *
     * @Route("/offer/{id}/post_location_payment_form", name="offer_post_location_payment_form")
     * @ParamConverter("offer", class="LocationBundle:Offer")
     * @Security("has_role('ROLE_USER')")
     */
    public function postLocationPaymentFormAction(Request $request, Offer $offer)
    {
    	$bill = $offer->getBill();
    	dump($bill);

	    $form = $this->createPaymentForm();
	    $form->handleRequest($request);
	    $mail = $this->getUser()->getEmail();

	    if ($form->isSubmitted() && $form->isValid()) {
	        $data = $form->getData();
	        // paiement
	        \Stripe\Stripe::setApiKey('sk_test_sOYMH9QVjgTyYof1TCyOYWpb');

	        $user = $this->getUser();
	        $customerId = $user->getCustomerId();

	        $post = $_POST['stripeToken'];

	        
			// Retrieve the Customer
			$customer = \Stripe\Customer::retrieve($customerId);

			$charge = \Stripe\Charge::create(array(
		    	'customer' => $customer->id,
		    	'amount' => $_POST['amount']*100, 
		    	'currency' => 'eur',
		    	'description' => 'frais de location',
		    	'receipt_email' => $mail,
		    ));

	        $bill->setLatenessCost($_POST['amount']);
	        $em->persist($bill);

	        $em->flush();

	        $this->addFlash('success', 'Paiement bien effectué. Vous allez recevoir un mail récapitulatif');
	        return $this->redirectToRoute('view_orders');
	    }
    	
    	$hours_diff = date_diff($offer->getDateEnd(), $offer->getBill()->getDateReturn())->format('%h');

    	return $this->render('PaymentBundle:default:post_location_payment_form.html.twig', [
    		'form'			=> $form->createView(),
    		'offer' 		=> $offer,
    		'hours_diff'	=> $hours_diff,
		]);
    }
}
