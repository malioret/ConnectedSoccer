<?php

namespace Soccer\LandingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SoccerLandingBundle:Default:index.html.twig', array('name' => $name));
    }
}
