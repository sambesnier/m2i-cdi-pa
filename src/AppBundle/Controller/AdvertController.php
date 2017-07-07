<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route(
 *     "/adverts"
 * )
 *
 * Class AdvertController
 * @package AppBundle\Controller
 */
class AdvertController extends Controller
{
    /**
     * @Route(
     *     "/index",
     *     name="advert_index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Advert:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route(
     *     "/details/{id}",
     *     name="advert_details")
     */
    public function detailsAction()
    {
        return $this->render('AppBundle:Advert:details.html.twig', array(
            // ...
        ));
    }

}
