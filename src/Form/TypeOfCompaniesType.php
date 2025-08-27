<?php

namespace App\Form;

use App\Entity\TypeOfCompany;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeOfCompaniesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', null, [
                'required'=>'true',
                'attr'=>['class'=>'form form-control mb-2 mt-1', 'placeholder'=>'Type of company']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeOfCompany::class,
        ]);
    }
}
