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

class UserController extends FOSRestController
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
     * @param User $user
     * @return array
     * @View()
     * @ParamConverter("user", class="SubwayBuddyUserBundle:User")
     */
    public function getUserAction(User $user)
    {
        return array('user' => $user);
    }
    
    
    
    
    
    
    
    /**
     * Create a User from the submitted data.<br/>
     *
     * 
     *
     * @param ParamFetcher $paramFetcher Paramfetcher
     *
     * @RequestParam(name="username", nullable=false, strict=true, description="Username.")
     * @RequestParam(name="email", nullable=false, strict=true, description="Email.")
     * @RequestParam(name="nom", nullable=false, strict=true, description="Nom.")
     * @RequestParam(name="password", nullable=false, strict=true, description="Plain Password.")
     *
     * @return View
     */
    public function postUserAction(ParamFetcher $paramFetcher)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setUsername($paramFetcher->get('username'));
        $user->setEmail($paramFetcher->get('email'));
        $user->setPlainPassword($paramFetcher->get('password'));
        $user->setNom($paramFetcher->get('nom'));
        
        $user->setEnabled(true);
        $user->addRole('ROLE_API');
        $view = Vieww::create();
        $errors = $this->get('validator')->validate($user, array('Registration'));
        if (count($errors) == 0) {
            $userManager->updateUser($user);
            $view->setData($user)->setStatusCode(200);
            return $view;
        } else {
            $view = $this->getErrorsView($errors);
            return $view;
        }
    }
    
    
    
    
    /**
     *
     * Connection d'un utilisateur avec username et mot de passe
     * 
     * 
     * @param ParamFetcher $paramFetcher Paramfetcher
     *
     * @RequestParam(name="username", nullable=false, strict=true, description="Username.")
     * @RequestParam(name="password", nullable=false, strict=true, description="Plain Password.")
     *
     * @return View
     */
    public function postConnectAction(ParamFetcher $paramFetcher)
    {
       
       
             $repositoryUser = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('SubwayBuddyUserBundle:User')
            ;  
        
          $em = $this->getDoctrine()->getManager();

      
        if($paramFetcher->get('username') && $paramFetcher->get('password'))
        {
            
            $view = Vieww::create();
            $username=$paramFetcher->get('username') ;
            $password=$paramFetcher->get('password');
            
            
             $securityContext = $this->container->get('security.context');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            //return $securityContext->getToken()->getUser();
        }

        /* Validate the User */
        $user_manager = $this->container->get('fos_user.user_manager');
        $factory = $this->container->get('security.encoder_factory');
        $user = $user_manager->loadUserByUsername($username);
        $encoder = $factory->getEncoder($user);
        
        $validated = $encoder->isPasswordValid($user->getPassword(),$password,$user->getSalt());
        if (!$validated) {
          
             $view->setData($validated)->setStatusCode(400);
            return $view;
        } else {
            $token = new UsernamePasswordToken($user, null, "main", $user->getRoles());
            $this->container->get("security.context")->setToken($token); //now the user is logged in

            //now dispatch the login event
            $request = $this->container->get("request");
            $event = new InteractiveLoginEvent($request, $token);
            $this->container->get("event_dispatcher")->dispatch("security.interactive_login", $event);

            $view->setData($user)->setStatusCode(200);
            return $view;
        }
        }
       
       
       
    }
    
    
}
