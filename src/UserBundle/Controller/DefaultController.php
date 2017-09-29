<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

class DefaultController extends Controller
{

	/**
     * Delete a user entity.
     *
     * @Route("/user/{id}/delete", name="delete_user")
     */
	public function deleteUserAction(Request $request, User $user)
	{
		$em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('homepage');
	}

    /**
     * Display all bills for a user
     *
     * @Route("/user/bills/view", name="view_bills")
     */
    public function viewBillsAction()
    {
        return $this->render('UserBundle:default:view_bills.html.twig');
    }   
}
