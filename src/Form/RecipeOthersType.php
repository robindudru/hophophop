<?php

namespace App\Form;

use App\Entity\RecipeOthers;
use App\Entity\OtherIngredient;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RecipeOthersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weight', NumberType::class, [
                'attr' => [
                    'placeholder' => 'ex: 15.5'
                ],
                'label' => 'Poids (en g)'
            ])
            ->add('otherIngredient', EntityType::class, [
                'class' => OtherIngredient::class,
                'placeholder' => 'Choisis un autre ingrédient',
                'choice_label' => 'name', 
                'label' => 'Ingrédient',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('otherIngredient')
                        ->where('otherIngredient.approved = true');
                },
            ])
            ->add('boilTime', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'ex: 30'
                ],
                'label' => 'Temps d\'ébullition'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RecipeOthers::class,
        ]);
    }
}
