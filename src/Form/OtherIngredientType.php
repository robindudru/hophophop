<?php

namespace App\Form;

use App\Entity\OtherIngredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OtherIngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom de l\'ingrédient'
                ],
                'label' => 'Nom'
            ])
            ->add('SBUrl', TextType::class, [
                'attr' => [
                    'placeholder' => 'Lien vers la page Saveur Bière',
                ],
                'required' => false,
                'label' => 'Acheter sur Saveur Bière'
            ])
            ->add('BLUrl', TextType::class, [
                'attr' => [
                    'placeholder' => 'Lien vers la page Brouwland'
                ],
                'required' => false,
                'label' => 'Acheter sur Brouwland'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OtherIngredient::class,
        ]);
    }
}
