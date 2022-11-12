<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Movie;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('releaseDate', BirthdayType::class)
            ->add('description')
            ->add('actors', EntityType::class, [
                'class' => Actor::class,
                'multiple' => true,
                'expanded' => true,
                /**'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->orderBy('a.name', 'asc');
                },**/
                'attr' => [
                    'class' => 'select2'
                ],
                'choice_label' => function ($actor) {
                    return $actor->__toString();
                },
                'by_reference' => false
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                /**'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'asc');
                },**/
                'attr' => [
                    'class' => 'select2'
                ],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
