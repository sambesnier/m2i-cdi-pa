<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserEditType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerUserAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(
            UserEditType::class,
            $user,
            [
                "method" => "post"
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            try {
                $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $this->addFlash("info", "Vous êtes bien inscrit");
                return $this->redirectToRoute('advert_index');
            } catch (UniqueConstraintViolationException $e) {
                $this->addFlash("danger", "Il existe déjà un utilisateur avec cet identifiant");
            }
        }

        return $this->render('AppBundle:Default:register.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route(
     *     "/login-user",
     *     name="login_user"
     * )
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
    {

        return $this->render("AppBundle:Default:login.html.twig", [
            "lastUserName" => $authenticationUtils->getLastUsername(),
            "error" => $authenticationUtils->getLastAuthenticationError()
        ]);
    }
}
