<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    "label" => "Nom"
                ])
            ->add(
                'firstname',
                TextType::class,
                [
                    "label" => "Prénom"
                ])
            ->add(
                'email',
                EmailType::class,
                [
                    "label" => "Email"
                ])
            ->add(
                'plainPassword',
                RepeatedType::class,
                [
                    "type" => PasswordType::class,
                    "invalid_message" => "Les mots de passe doivent correspondre",
                    "options" => [
                        "attr" => [
                            "class" => "password-field"
                        ]
                    ],
                    "required" => false,
                    "first_options" => [
                        "label" => "Mot de passe"
                    ],
                    "second_options" => [
                        "label" => "Confirmation du mot de passe"
                    ]
                ])
            ->add(
                'address',
                AddressType::class,
                [
                    'label' => 'Adresse',
                    'required' => false
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    "label" => "Valider"
                ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
