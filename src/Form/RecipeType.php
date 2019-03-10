<?php

namespace App\Form;

use App\Entity\Style;
use App\Entity\Recipes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom de la recette'
                ],
                'label' => 'Nom'
            ])
            ->add('style', EntityType::class, [
                'class'  => Style::class,
                'placeholder' => 'Choisis un style de bière', 
                'choice_label' => 'name'
            ])
            ->add('author', HiddenType::class)
            ->add('method', ChoiceType::class, [
                'choices' => [
                    'Kit' => 'kit',
                    'Tout Grain' => 'allgrain'
                ]
            ])
            ->add('boilTime', TextType::class, [
                'attr' => [
                    'placeholder' => 'en minutes'
                ],
                'label' => 'Temps d\'ébullition'
            ])
            ->add('batchSize', TextType::class, [
                'attr' => [
                    'placeholder' => 'en litres'
                ],
                'label' => 'Volume du brassin'
            ])
            ->add('originalGravity', TextType::class, [
                'attr' => [
                    'placeholder' => 'ex: 1.050'
                ],
                'label' => 'Densité initiale'
            ])
            ->add('finalGravity', TextType::class, [
                'attr' => [
                    'placeholder' => 'ex: 1.012'
                ],
                'label' => 'Densité finale'
            ])
            ->add('alcohol', HiddenType::class)
            ->add('color', HiddenType::class)
            ->add('thumbsUp', HiddenType::class)
            ->add('mashGuide', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Notes additionnelles que tu souhaites ajouter'
                ],
                'label' => 'Notes sur le brassage'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipes::class,
        ]);
    }
}
