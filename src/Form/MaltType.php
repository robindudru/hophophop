<?php

namespace App\Form;

use App\Entity\Malt;
use App\Entity\MaltTypes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class MaltType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom du malt, sans l\'EBC'
                ],
                'label' => 'Nom'
            ])
            ->add('type', EntityType::class, [
                'class'  => MaltTypes::class,
                'placeholder' => 'Choisis un type de malt', 
                'choice_label' => 'name'
            ])
            ->add('ebc', NumberType::class, [
                'attr' => [
                    'placeholder' => 'Valeur de l\'EBC du malt'
                ],
                'label' => 'EBC'
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
            'data_class' => Malt::class,
        ]);
    }
}
