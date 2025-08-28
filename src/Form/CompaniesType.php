<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\TypeOfCompany;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompaniesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'required'=>'true',
                'attr'=>['class'=>'form form-control mb-2 mt-1', 'placeholder'=>'Name']
            ])
            ->add('fondationDate', null, [
                'required'=>'true',
                'attr'=>['class'=>'form form-control mb-2 mt-1']
            ])
            ->add('_type', EntityType::class, [
                'class' => TypeOfCompany::class,
                'choice_label' => 'type',
                'required'=>'true',
                'attr'=>['class'=>'form form-control mb-2 mt-1']
            ])
            ->add('isClosed', null, [
                'label'=> 'is Closed',
                'attr'=>['class'=>'mx-2'],
                'required'=>'true',
                'attr'=>['class'=>'form form-control mb-2 mt-1']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
