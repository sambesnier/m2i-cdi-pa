<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @Route(
     *     "/login-user",
     *     name="login_user"
     * )
     */
    public function loginUserAction()
    {
        return $this->render('AppBundle:Default:login.html.twig', [

        ]);
    }

    /**
     * @Route(
     *     "/register-user",
     *     name="register_user"
     * )
     */
    public function registerUserAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(
            UserType::class,
            $user,
            [
                "method" => "post"
            ]
        );

        $form->handleRequest($request);

        return $this->render('AppBundle:Default:register.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
