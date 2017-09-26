<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use UserBundle\Entity\User;

class UserController extends Controller
{

	/**
	 * @Route("/admin/users/view", name="admin_view_users")
	 * @Security("has_role('ROLE_ADMIN')")
	 */
	public function adminViewUsersAction()
	{
		$em = $this->getDoctrine()->getManager();
		$users = $em->getRepository('UserBundle:User')->findAll();

		return $this->render('AdminBundle:user:admin_view_users.html.twig', [
			'users' => $users,
		]);
	}
}
