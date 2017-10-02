<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use UserBundle\Entity\User;
use UserBundle\Service\UserChecker;

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
            $this->addFlash('error', 'Vous ne pouvez pas supprimer une autre utilisateur que vous-meme');
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
}
