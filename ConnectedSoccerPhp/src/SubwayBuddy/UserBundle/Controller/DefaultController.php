<?php

namespace SubwayBuddy\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SubwayBuddyUserBundle:Default:index.html.twig', array());
    }
    
   
}
