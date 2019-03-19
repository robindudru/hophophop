<?php

namespace App\Form;

use App\Entity\Hop;
use App\Entity\RecipeHops;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RecipeHopsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weight')
            ->add('boilTime')
            ->add('version', ChoiceType::class, [
                'choices' => [
                    'Cônes' => 'cones',
                    'Pellets' => 'pellets'
                ]
            ])
            ->add('hop', EntityType::class, [
                'class' => Hop::class,
                'placeholder'=> 'Choisis un houblon',
                'choice_label' => 'name',
                'group_by' => function($val, $key, $index) {
                    return $val->getType()->getName();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RecipeHops::class,
        ]);
    }
}
