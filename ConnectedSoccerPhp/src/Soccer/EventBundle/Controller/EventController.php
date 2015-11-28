<?php

namespace Soccer\EventBundle\Controller;


use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View as Vieww;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\FOSRestController;
use Soccer\EventBundle\Entity\Event;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class EventController extends FOSRestController
{
    /**
     * @Get
     * @return array
     * @View()
     */
    public function getEventsAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        
        // Va récupérer toutes les lignes de la table 'event'.
        $events = $em->getRepository('SoccerEventBundle:Event')->findAll();

        
        return array('events' => $events);
        
        
    }

    
    
    /**
     * @param Event $event
     * @return array
     * @View()
     * @ParamConverter("event", class="SoccerEventBundle:Event")
     */
    public function getEventAction(Event $event)
    {
        return array('event' => $event);
    }
    
    
    
    
    /** @param ParamFetcher $paramFetcher Paramfetcher
     *
     * @RequestParam(name="nom", nullable=false, strict=true, description="nom.")
     * @RequestParam(name="lieu", nullable=false, strict=true, description="lieu.")
     * @RequestParam(name="date", nullable=false, strict=true, description="date.")
     *
     * @return View
     */
    public function postEventAction(ParamFetcher $paramFetcher)
    {
        $event=new Event();
        
         $em = $this->getDoctrine()->getManager();

        
        $event->setNom($paramFetcher->get('nom'));
        $event->setLieu($paramFetcher->get('lieu'));
        $event->setDate($paramFetcher->get('date'));
       
        $view = Vieww::create();
      
        
           $em->persist($event);
            $em->flush();
            $view->setData($event)->setStatusCode(200);
            return $view;
        
    }
    
    
    
    
    
    


    
}
