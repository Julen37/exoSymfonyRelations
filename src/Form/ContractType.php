<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\Contract;
use App\Entity\Employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContractType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startingDate', null, [
                'required'=>'true',
                'attr'=>['class'=>'form form-control mb-2 mt-1']
            ])
            ->add('endDate', null, [
                'required'=>'true',
                'attr'=>['class'=>'form form-control mb-2 mt-1']
            ])
            ->add('company', EntityType::class, [
                'class' => Company::class,
                'choice_label' => 'name',
                'required'=>'true',
                'attr'=>['class'=>'form form-control mb-2 mt-1']
            ])
            ->add('_employee', EntityType::class, [
                'class' => Employee::class,
                'choice_label' => 'firstName',
                'required'=>'true',
                'attr'=>['class'=>'form form-control mb-2 mt-1']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contract::class,
        ]);
    }
}
