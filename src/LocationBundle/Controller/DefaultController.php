<?php

namespace LocationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	/**
     * Homepage 
     *
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('LocationBundle:default:index.html.twig');
    }
}