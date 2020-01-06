<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Role;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter value',
                    'class' => 'input_classs form-control'
                ]
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter value',
                    'class' => 'input_classs form-control'
                ]
            ])
            ->add('phoneNumber', TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter value',
                    'class' => 'input_classs form-control'
                ]
            ])
            ->add('function', TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter value',
                    'class' => 'input_classs form-control'
                ]
            ])
            ->add('email', TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter value',
                    'class' => 'input_classs form-control'
                ]
            ])
            ->add('webpage', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter value',
                    'class' => 'input_classs form-control'
                ]
            ])
            ->add('photo', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter value',
                    'class' => 'input_classs form-control'
                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter value',
                    'class' => 'input_classs form-control'
                ]
            ])
            ->add('role', EntityType::class, [
                'class' => Role::class,
                'expanded' => true,
                'multiple' => true,
                'attr' => [
                    'class' => 'roles',
                    ]
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success my-4 w-100'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
