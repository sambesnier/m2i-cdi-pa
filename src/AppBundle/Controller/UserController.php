<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserEditType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editProfilAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
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

        if ($form->isSubmitted() && $form->isValid())
        {
            try {
                $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $this->addFlash("info", "Votre profil a bien été modifié");
                return $this->redirectToRoute('user_home');
            } catch (UniqueConstraintViolationException $e) {
                $this->addFlash("danger", "Il existe déjà un utilisateur avec cet identifiant");
            }
        }

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

        return $this->render('AppBundle:User:new-advert.html.twig', [

        ]);
    }

}
