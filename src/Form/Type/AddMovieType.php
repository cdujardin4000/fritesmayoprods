<?php

use App\Entity\Actor;
use App\Entity\Movie;
use App\Form\ActorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddMovieType extends ActorType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('addMovie', EntityType::class, [
                'class' => Movie::class,
                /**'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('a')
                ->orderBy('a.name', 'asc');
                },**/
                'attr' => [
                    'class' => 'select2'
                ],
                'by_reference' => true
            ])
        ;
    }

}