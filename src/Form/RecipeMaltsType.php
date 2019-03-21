<?php

namespace App\Form;

use App\Entity\Malt;
use App\Entity\RecipeMalts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class RecipeMaltsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weight', NumberType::class, [
                'attr' => [
                    'placeholder' => 'ex: 4.5'
                ],
                'label' => 'Poids (en kg)'
            ])
            ->add('malt', EntityType::class, [
                'class' => Malt::class,
                'placeholder' => 'Choisis un malt',
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
            'data_class' => RecipeMalts::class,
        ]);
    }
}
