<?php

namespace App\Form;

use App\Entity\Malt;
use App\Entity\Style;
use App\Entity\Yeast;
use App\Form\MaltType;
use App\Entity\Recipes;
use App\Form\RecipeHopsType;
use App\Form\RecipeOthersType;
use App\Form\AddMaltToRecipeType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

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
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('style')
                        ->orderBy('style.name', 'ASC');
                },
            ])
            ->add('method', ChoiceType::class, [
                'choices' => [
                    'Kit' => 'kit',
                    'Tout Grain' => 'allgrain'
                ],
                'label' => 'Méthode de brassage',
                'placeholder' => 'Choisis la méthode du brassage'
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Une courte description de la recette qui s\'affichera dans la liste des recettes. Donne envie de brasser ta bière !'
                ]
            ])
            ->add('recipeMalts', CollectionType::class, [
                'entry_type' => RecipeMaltsType::class,
                'entry_options' => ['label' => false],
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'prototype' => true,
                'delete_empty' => true,
                'by_reference' => false
            ])
            ->add('recipeHops', CollectionType::class, [
                'entry_type' => RecipeHopsType::class,
                'entry_options' => ['label' => false],
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'prototype' => true,
                'delete_empty' => true,
                'by_reference' => false
            ])
            ->add('recipeOthers', CollectionType::class, [
                'entry_type' => RecipeOthersType::class,
                'entry_options' => ['label' => false],
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'prototype' => true,
                'delete_empty' => true,
                'by_reference' => false
            ])
            ->add('yeast', EntityType::class, [
                'class' => Yeast::class,
                'placeholder' => 'Choisis une levure',
                'choice_label' => 'name',
                'label' => 'Levure'
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
            ->add('mashGuide', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Notes additionnelles que tu souhaites ajouter; des détails sur les ingrédients exotiques, des techniques alternatives ou des ingrédients de remplacement. Tu peux aussi dire bonjour, ça fait toujours plaisir.'
                ],
                'required' => false,
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
