<?php

namespace App\Form;

use App\Entity\Hop;
use App\Entity\HopTypes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class HopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom du houblon, sans les AA'
                ],
                'label' => 'Nom'
            ])
            ->add('type', EntityType::class, [
                'class'  => HopTypes::class,
                'placeholder' => 'Choisis un type de houblon', 
                'choice_label' => 'name'
            ])
            ->add('alphaAcid', NumberType::class, [
                'attr' => [
                    'placeholder' => 'Valeur des AA du houblon'
                ],
                'label' => 'Acides Alpha'
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
            'data_class' => Hop::class,
        ]);
    }
}
