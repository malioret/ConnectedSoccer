<?php

namespace Soccer\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SoccerEventBundle:Default:index.html.twig', array('name' => $name));
    }
}
