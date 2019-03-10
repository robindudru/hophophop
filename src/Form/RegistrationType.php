<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'placeholder' => 'ex: BierrotGourmand'
                ],
                'label' => 'Pseudonyme'
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'mon@email.com'
                ],
                'label' => 'Adresse e-mail'
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'placeholder' => 'min. 8 caractères'
                ],
                'label' => 'Mot de passe'
            ])
            ->add('confirmPassword', PasswordType::class, [
                'attr' => [
                    'placeholder' => 'retape ton mot de passe'
                ],
                'label' => 'Confirmation du mot de passe'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
