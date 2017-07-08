<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
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
        $repo = $this->getDoctrine()->getRepository('AppBundle:Advert');
        $adverts = $repo->getAllAdverts();

        return $this->render('AppBundle:Advert:index.html.twig', array(
            "adverts" => $adverts
        ));
    }

    /**
     * @Route(
     *     "/details/{id}",
     *     name="advert_details")
     */
    public function detailsAction($id)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Advert');
        $advert = $repo->findOneById($id);

        return $this->render('AppBundle:Advert:details.html.twig', array(
            "advert" => $advert
        ));
    }

    /**
     * @Route(
     *     "/by-user/{id}",
     *     name="advert_by_user"
     * )
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function advertsByUserAction(User $user)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Advert');

        $adverts = $repo->getAdvertsByUser($user);

        return $this->render('AppBundle:Advert:index.html.twig', [
            "adverts" => $adverts
        ]);
    }

}
