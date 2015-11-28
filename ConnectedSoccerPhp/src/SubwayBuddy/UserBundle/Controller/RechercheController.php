<?php

namespace SubwayBuddy\UserBundle\Controller;

use FOS\RestBundle\View\View as vieww;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\FOSRestController;
use SubwayBuddy\UserBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class RechercheController extends FOSRestController
{
    /**
     * @Get
     * @return array
     * @View()
     */
    public function getUsersAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('SubwayBuddyUserBundle:User')->findAll();

        
        return array('users' => $users);
        
        
    }

    
    
    
    
    
    
    
    /**
     *
     * Recherche utilisateurs par rapport à un username
     * 
     * 
     * @param ParamFetcher $paramFetcher Paramfetcher
     *
     * @RequestParam(name="username", nullable=false, strict=true, description="Username.")
     * 
     * @return View
     */
    public function postRechercheUsernameAction(ParamFetcher $paramFetcher)
    {
       $em = $this->getDoctrine()->getManager();

        $username=$paramFetcher->get('username');
        $users = $em->getRepository('SubwayBuddyUserBundle:User')->findAllUserByUsername($username);

        
        return array('users' => $users);
       
       
       
    }
    
    
}
