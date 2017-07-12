<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @Route(
     *     "/search",
     *     name="search"
     * )
     */
    public function searchAction(Request $request)
    {
        $defaultData = array('message' => 'Formulaire de recherche');

        $form = $this->createFormBuilder($defaultData)
            ->add(
                'project',
                EntityType::class,
                [
                    "class" => "AppBundle\Entity\Project",
                    "choice_label" => "project",
                    "placeholder" => "Choisissez un projet",
                    "label" => "Projet",
                    "required" => false
                ])
            ->add(
                'category',
                EntityType::class,
                [
                    "class" => "AppBundle\Entity\Category",
                    "choice_label" => "category",
                    "placeholder" => "Choisissez une catégorie",
                    "label" => "Catégorie",
                    "required" => false
                ]
            )
            ->add(
                'minPrice',
                IntegerType::class,
                [
                    "label" => "Prix minimum",
                    "required" => false
                ])
            ->add(
                'maxPrice',
                IntegerType::class,
                [
                    "label" => "Prix maximum",
                    "required" => false
                ]
            )
            ->add(
                'postcode',
                IntegerType::class,
                [
                    "label" => "Code postal",
                    "required" => false
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    "label" => "Rechercher"
                ]
            )
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $project = $data['project'];
            $category = $data['category'];
            $minPrice = $data['minPrice'];
            $maxPrice = $data['maxPrice'];
            $postCode = $data['postcode'];

            $repo = $this->getDoctrine()->getRepository('AppBundle:Advert');

            $adverts = $repo->searchAdverts($project, $category, $minPrice, $maxPrice, $postCode);

            return $this->render('AppBundle:Advert:index.html.twig', [
                "adverts" => $adverts
            ]);
        }

        return $this->render('AppBundle:Advert:search.html.twig', [
            "formSearch" => $form->createView()
        ]);
    }

}
