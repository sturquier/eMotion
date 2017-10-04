<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use UserBundle\Entity\User;
use PaymentBundle\Entity\Bill;
use UserBundle\Service\UserChecker;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

class DefaultController extends Controller
{

	/**
     * Delete a user entity.
     *
     * @Route("/user/{id}/delete", name="delete_user")
     */
	public function deleteUserAction(User $user, UserChecker $checker)
	{  
        if (!$checker->check($user, $this->getUser())) {
            $this->addFlash('error', 'Vous ne pouvez pas supprimer un autre utilisateur que vous-meme');
            return $this->redirectToRoute('homepage');
        }

		$em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('homepage');
	}

    /**
     * Display all placed orders for a user
     *
     * @Route("/user/orders/view", name="view_orders")
     * @Security("has_role('ROLE_USER')")
     */
    public function viewOrdersAction()
    {
        return $this->render('UserBundle:default:view_orders.html.twig');
    }  

    /**
     * Generate a bill
     *
     * @Route("/user/orders/{id}/generate", name="create_bill")
     * @Security("has_role('ROLE_USER')")
     */
    public function createPDFAction(Bill $bill)
    {
        $html = $this->renderView('UserBundle:default:bill_template.html.twig', array(
                'bill'  =>  $bill
        ));

        return new \PdfResponse($this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'bill.pdf'
        );
    } 
}
