<?php

namespace App\Form;

use App\Entity\RecipeOthers;
use App\Entity\OtherIngredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeOthersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weight')
            ->add('otherIngredient', EntityType::class, [
                'class' => OtherIngredient::class,
                'placeholder' => 'Choisis un autre ingrédient',
                'choice_label' => 'name', 
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
