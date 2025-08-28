<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', null, [
                'required'=>'true',
                'attr'=>['class'=>'form form-control mb-2 mt-1', 'placeholder'=>'First name']
            ])
            ->add('lastName', null, [
                'required'=>'true',
                'attr'=>['class'=>'form form-control mb-2 mt-1', 'placeholder'=>'Last name']
            ])
            ->add('birthDate', null, [
                'required'=>'true',
                'attr'=>['class'=>'form form-control mb-2 mt-1']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
