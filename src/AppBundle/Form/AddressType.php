<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'number',
                IntegerType::class,
                [
                    'label' => 'Numéro de voie',
                    'attr' => [
                        'placeholder' => 'Ex: 15'
                    ]
                ])
            ->add(
                'path',
                TextType::class,
                [
                    'label' => 'Type et nom de voix',
                    'attr' => [
                        'placeholder' => 'Ex: Rue des sports...'
                    ]
                ])
            ->add(
                'postcode',
                IntegerType::class,
                [
                    'label' => 'Code postal',
                    'attr' => [
                        'placeholder' => 'Ex: 59310'
                    ]
                ])
            ->add(
                'city',
                TextType::class,
                [
                    'label' => 'Ville',
                    'attr' => [
                        'placeholder' => 'Ex: Orchies'
                    ]
                ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Address'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_address';
    }


}
