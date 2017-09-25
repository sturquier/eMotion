<?php

namespace LocationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	/**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('LocationBundle:Default:index.html.twig');
    }
}
