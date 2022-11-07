<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Actor;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $actors = [
            [
                'firstName' => 'Kutcher',
                'lastName' => 'Ashton',
                'birthDate' => '1978-02-10',
                'gender' => 'm',
            ],
            [
                'firstName' => 'Smart',
                'lastName' => 'Amy',
                'birthDate' => '1976-03-26',
                'gender' => 'f'
            ],
            [
                'firstName' => 'Norton',
                'lastName' => 'Edward',
                'birthDate' => '1969-08-18',
                'gender' => 'm',
            ],
            [
                'firstName' => 'Pitt',
                'lastName' => 'Brad',
                'birthDate' => '1963-12-18',
                'gender' => 'm',
            ],
            [
                'firstName' => 'Bridges',
                'lastName' => 'Jeff',
                'birthDate' => '1949-12-04',
                'gender' => 'm',
            ],
            [
                'firstName' => 'Goodman',
                'lastName' => 'John',
                'birthDate' => '1952-06-20',
                'gender' => 'm',
            ],
            [
                'firstName' => 'Carrey',
                'lastName' => 'Jim',
                'birthDate' => '1962-01-17',
                'gender' => 'm',
            ],
            [
                'firstName' => 'Winslet',
                'lastName' => 'Kate',
                'birthDate' => '1975-05-10',
                'gender' => 'f',
            ],
            [
                'firstName' => 'Nicholson',
                'lastName' => 'Jack',
                'birthDate' => '1937-04-22',
                'gender' => 'm',
            ],
            [
                'firstName' => 'Fetcher',
                'lastName' => 'Louise',
                'birthDate' => '1934-09-23',
                'gender' => 'f',
            ],
            [
                'firstName' => 'Burstyn',
                'lastName' => 'Ellen',
                'birthDate' => '1932-12-07',
                'gender' => 'f',
            ],
            [
                'firstName' => 'Leto',
                'lastName' => 'Jared',
                'birthDate' => '1971-12-26',
                'gender' => 'm',
            ],
            [
                'firstName' => 'Duris',
                'lastName' => 'Romain',
                'birthDate' => '1974-05-28',
                'gender' => 'm',
            ],
            [
                'firstName' => 'Arestrup',
                'lastName' => 'Niels',
                'birthDate' => '1949-02-08',
                'gender' => 'm',
            ],
        ];

        foreach($actors as $actor) {
            $a = new Actor();
            $a->setFirstname($actor['firstName']);
            $a->setLastname($actor['lastName']);
            $a->setGender($actor['gender']);
            $a->setBirthDate(new DateTime($actor['birthDate']));

            $manager->persist($a);
        }

        $manager->flush();
    }

}
