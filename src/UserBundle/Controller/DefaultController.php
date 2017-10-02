<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{

	/**
     * Delete a user entity.
     *
     * @Route("/user/{id}/delete", name="delete_user")
     * @Security("has_role('ROLE_ADMIN')")
     */
	public function deleteUserAction(Request $request, User $user)
	{
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
}
