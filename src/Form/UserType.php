<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Role;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter value',
                    'class' => 'input_classs form-control',
                    // 'disabled'  => true
                ]
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter value',
                    'class' => 'input_classs form-control'
                ]
            ])
            ->add('password', TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter value',
                    'class' => 'input_classs form-control'
                ]
            ])
            ->add('validTo', DateTimeType::class, [
                'attr' => [
                    'placeholder' => 'Enter value'
                ]
            ])
            // ->add('roles', EntityType::class, [
            //     'class' => Role::class,
            //     'expanded' => true,
            //     'multiple' => true,
            //     'attr' => [
            //         'class' => 'roles',
            //         ]
            // ])
            ->add('Vytvorit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success my-4 w-100'
                ]
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
