<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route(
     *     "/",
     *     name="homepage")
     */
    public function homeAction()
    {
        return $this->render('AppBundle:Default:home.html.twig', array(
            // ...
        ));
    }

}
