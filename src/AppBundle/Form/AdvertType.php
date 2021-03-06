<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    "label" => "Titre"
                ])
            ->add(
                'content',
                TextareaType::class,
                [
                    "label" => "Description",
                    "attr" => [
                        "rows" => 6
                    ]
                ]);
        // Add images only if we are in creation mode
        if ($options['mode'] == "new") {
            $builder->add(
                'images',
                CollectionType::class,
                [
                    "entry_type" => ImageType::class,
                    "label" => false,
                    "allow_add" => true,
                    "allow_delete" => true
                ]
            );
        }

        $builder
            ->add(
                'project',
                EntityType::class,
                [
                    "class" => "AppBundle\Entity\Project",
                    "choice_label" => "project",
                    "placeholder" => "Choisissez un projet",
                    "label" => "Projet"
                ])
            ->add(
                'category',
                EntityType::class,
                [
                    "class" => "AppBundle\Entity\Category",
                    "choice_label" => "category",
                    "placeholder" => "Choisissez une catégorie",
                    "label" => "Catégorie"
                ]
            )
            ->add(
                'year',
                DateType::class,
                [
                    "label" => "Année de construction",
                    "widget" => "single_text"
                ])
            ->add(
                'price',
                IntegerType::class,
                [
                    "label" => "Prix"
                ])
            ->add(
                'area',
                IntegerType::class,
                [
                    "label" => "Superficie"
                ])
            ->add(
                'address',
                AddressType::class,
                [
                    "label" => "Adresse"
                ])
            ->add(
                'submit',
                SubmitType::class,
                [
                    "label" => "Valider",
                    "attr" => [
                        "class" => "btn-lg btn-primary"
                    ]
                ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Advert',
            'mode' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_advert';
    }


}
