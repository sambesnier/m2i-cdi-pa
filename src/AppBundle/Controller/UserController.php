<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Advert;
use AppBundle\Form\AdvertType;
use AppBundle\Form\UserEditType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\ORMException;
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
     *     "/home/{page}",
     *     name="user_home")
     */
    public function indexAction($page = 1)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Advert');

        $adverts = $repo->getAdvertsByUser($this->getUser(), $page);

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($adverts) / 10),
            'routeName' => 'advert_index',
            'paramsRoute' => array()
        );

        return $this->render('AppBundle:User:index.html.twig', array(
            "adverts" => $adverts,
            "pagination" => $pagination
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
                if (!empty($user->getPlainPassword())) {
                    $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                    $user->setPassword($password);
                }

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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAdvert(Request $request)
    {
        $user = $this->getUser();
        $advert = new Advert();
        $form = $this->createForm(
            AdvertType::class,
            $advert,
            [
                "method" => "post"
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            try {
                $em = $this->getDoctrine()->getManager();
                $advert->setUser($user);
                $images = $form['images']->getData();
                foreach ($images as $image) {
                    $image->setAdvert($advert);
                    $advert->addImage($image);
                }
                $em->persist($advert);
                $em->flush();

                $this->addFlash("info", "L'annonce a bien été ajoutée");
                return $this->redirectToRoute("user_home");
            } catch (ORMException $e) {
                $this->addFlash("danger", "Un problème est survenu lors de l'ajout de l'annonce");
            }
        }

        return $this->render('AppBundle:User:new-advert.html.twig', [
            "formNewAdvert" => $form->createView()
        ]);
    }

    /**
     * @Route(
     *     "/delete-advert/{id}",
     *     name="user_advert_remove"
     * )
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAdvertAction($id)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Advert');
        $advert = $repo->findOneById($id);

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($advert);
            $em->flush();

            $this->addFlash("info", "Annonce supprimée");
            return $this->redirectToRoute('user_home');

        } catch (EntityNotFoundException $e) {
            $this->addFlash("danger", "Annonce introuvable");
        }
        return $this->redirectToRoute("user_home");
    }

    /**
     * @Route(
     *     "/edit-advert/{id}",
     *     name="user_advert_edit"
     * )
     * @param Request $request
     * @param Advert $advert
     * @return \Symfony\Component\HttpFoundation\Response* @internal param $id
     */
    public function editAdvertAction(Request $request, Advert $advert)
    {
        $form = $this->createForm(
            AdvertType::class,
            $advert,
            [
                "method" => "post"
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($advert);
                $em->flush();

                $this->addFlash("info", "Annonce mise à jour");
                return $this->redirectToRoute("user_home");

            } catch (ORMException $e) {
                $this->addFlash("danger", "Impossible de modifier l'annonce");
            }
        }

        return $this->render("AppBundle:User:edit-advert.html.twig", [
            "formAdvert" => $form->createView()
        ]);
    }

}
