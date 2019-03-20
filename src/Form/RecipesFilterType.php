<?php

namespace App\Form;

use App\Entity\Style;
use App\Entity\RecipesFilter;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RecipesFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('style', EntityType::class, [
                'class'  => Style::class,
                'required' => false,
                'label' => false,
                'placeholder' => 'Filtrer par style de bière', 
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
                'placeholder' => 'Filtrer par méthode',
                'required' => false,
                'label' => false,
            ])
            ->add('difficulty', ChoiceType::class, [
                'choices' => [
                    'Débutant' => 'beginner',
                    'Confirmé' => 'confirmed',
                    'Expert' => 'expert'
                ],
                'placeholder' => 'Filtrer par difficulté',
                'required' => false,
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RecipesFilter::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
