<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;
use App\Entity\Actor;
use App\Entity\Category;
use App\Repository\MovieRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $movies = [
            [
                'title' => 'Eternal Sunchine Of The Spotless Mind',
                'description' => `L'idylle entre Clementine et Joel a pris fin, en raison de leurs caractères trop différents et de la routine. Pour apaiser ses souffrances, Clementine a recours à Lacuna, un procédé révolutionnaire qui efface certains souvenirs. Désespéré, Joel décide de `,
                'category' => 'drame',
                'releaseDate' => '2004-10-12',
                'actors' => [
                    'Jim Carrey',
                    'Kate Winslet',
                ]
            ],
            [
                'title' => `Vol au-dessus d'un nid de coucou`,
                'description' => `Pour échapper à la prison, Randall P. McMurphy se fait volontairement interner dans une clinique psychiatrique. Il y découvre injustice et oppression`,
                'category' => 'drame',
                'releaseDate' => '1976-12-01',
                'actors' => [
                    'Jack Nicholson',
                    'Louise Fetcher',
                ]
            ],
            [
                'title' => `Requiem for a Dream`,
                'description' => `Pour échapper à la prison, Randall P. McMurphy se fait volontairement interner dans une clinique psychiatrique. Il y découvre injustice et oppression`,
                'category' => 'drame',
                'releaseDate' => '2001-03-21',
                'actors' => [
                    'Jared Leto',
                    'Ellen Burstyn',
                ]
            ],
            [
                'title' => `De battre mon coeur s'est arreté`,
                'description' => `A 28 ans, Tom semble marcher sur les traces de son père dans l'immobilier véreux. Mais une rencontre fortuite le pousse à croire qu'il pourrait être le pianiste concertiste de talent qu'il rêvait de devenir, à l'image de sa mère. Sans cesser ses activités`,
                'category' => 'drame',
                'releaseDate' => '2005-03-16',
                'actors' => [
                    'Romain Duris',
                    'Niels Arestrup',
                ]
            ],
            [
                'title' => `The Big Lebowski`,
                'description' => `À Los Angeles, Jeffrey Lebowski, alias le Dude, mène une vie nonchalante. Il passe le plus clair de son temps à ne rien faire en robe de chambre ou à jouer au bowling du coin avec ses copains Walter, un vétéran du Vietnam, et Donny. Un jour, alors qu'il..`,
                'category' => 'comédie',
                'releaseDate' => '1998-04-22',
                'actors' => [
                    'Jeff Bridges',
                    'John Goodman',
                ]
            ],
            [
                'title' => `Fight Club`,
                'description' => `Insomniaque, désillusionné par sa vie personnelle et professionnelle, un jeune cadre expert en assurances, mène une vie monotone et sans saveur. Face à la vacuité de son existence, son médecin lui conseille de suivre une thérapie afin de relativiser son..`,
                'category' => 'comédie',
                'releaseDate' => '1999-11-10',
                'actors' => [
                    'Brad Pitt',
                    'Edward Norton',
                ]
            ],
            [
                'title' => `The Butterfly Effect`,
                'description' => `Evan Treborn a le pouvoir de remonter le temps pour corriger ses erreurs. C'est sans compter sur l'effet papillon qui engendre des déconvenues non prévues.`,
                'category' => 'science-fiction',
                'releaseDate' => '2004-03-10',
                'actors' => [
                    'Ashton Kutcher',
                    'Amy Smart',
                ]
            ],
        ];

        foreach($movies as $movie) {
            $m = new Movie();
            $m->setTitle($movie['title']);
            $m->setDescription($movie['description']);
            $m->setReleaseDate($movie['releaseDate']);
            $m->setCategory($this->getReference($movie['category']));

            foreach($movie['actors'] as $actor) {
                $m->addActor($this->getReference($actor));
            }
            $this-> addReference($movie['title'],$m);

            $manager->persist($m);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            ActorFixtures::class,
        ];
    }
}