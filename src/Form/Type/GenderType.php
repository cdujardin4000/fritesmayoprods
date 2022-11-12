<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenderType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => [
                'm' => 'm',
                'f' => 'f',
                'u' => 'u',
            ],
            'placeholder' => 'Choose an option',
            'attr' => [
                'class' => 'select2'
            ]
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}