<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

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

	/**
     * Delete a user entity.
     *
     * @Route("admin/user/{id}/delete", name="admin_delete_user")
     */
	public function adminDeleteUserAction(Request $request, User $user)
	{
		$em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('admin_view_users');
	}   
}
