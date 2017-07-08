<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserEditType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/user")
 *
 * @Security(
 *     "has_role('ROLE_VENDOR')"
 * )
 *
 * Class UserController
 * @package AppBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @Route(
     *     "/home",
     *     name="user_home")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:User:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route(
     *     "/edit-user",
     *     name="edit_user"
     * )
     */
    public function editProfilAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(
            UserEditType::class,
            $user,
            [
                "method" => "post"
            ]
        );

        $form->handleRequest($request);


        return $this->render('AppBundle:User:edit-profile.html.twig', [
            "formEdit" => $form->createView()
        ]);
    }

    /**
     * @Route(
     *     "/add-advert",
     *     name="user_advert_new"
     * )
     */
    public function addAdvert()
    {

    }

}
