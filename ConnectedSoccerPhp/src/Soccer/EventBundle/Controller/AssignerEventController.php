<?php

namespace Soccer\EventBundle\Controller;


use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View as Vieww;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\FOSRestController;
use Soccer\EventBundle\Entity\Event;
use SubwayBuddy\UserBundle\Entity\User;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AssignerEventController extends FOSRestController
{
    
    
    
    
    
     /**
     * Update a User from the submitted data by ID.<br/>
     *
     *
     * 
     * @param ParamFetcher $paramFetcher Paramfetcher
     *
     * @RequestParam(name="id", nullable=false, strict=true, description="id.")
     * @RequestParam(name="id_user", nullable=false, strict=true, description="id_user.")
     *
     * @return View
     */
    public function putAssignerEventAction(ParamFetcher $paramFetcher)
    {
        
             $repositoryEvent = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('SoccerEventBundle:Event')
            ;  
            
            $event=$repositoryEvent->findOneById($paramFetcher->get('id'));
        
          $em = $this->getDoctrine()->getManager();

      
        if($paramFetcher->get('id_user'))
        {
             $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('SubwayBuddyUserBundle:User')
            ;  

      
         $user=$repository->findOneById($paramFetcher->get('id_user'));
            $event->addAmi($user); 
            
        }
        $view = Vieww::create();
        
           $em->persist($event);
            $em->flush();
            $view->setData($event)->setStatusCode(200);
            return $view;
       
    }



    
}
