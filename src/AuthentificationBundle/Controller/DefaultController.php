<?php

namespace AuthentificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        // var_dump($this->getUser()->hasRole("ROLE_ADMIN"));die();
        return $this->render('@Authentification/Default/index.html.twig');
    }


    /**
     * @Route("/dashboard")
     */
    public function dashboardAction()
    {
        // var_dump($this->getUser()->hasRole("ROLE_ADMIN"));die();
        return $this->render('@Authentification/Default/index.html.twig');
    }
}
