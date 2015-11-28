<?php

namespace Soccer\LandingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('SoccerLandingBundle:Home:index.html.twig', array());
    }
}
