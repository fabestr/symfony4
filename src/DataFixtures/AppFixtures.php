<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        for($i = 0 ; $i < 30; $i++)
        {
            $artist = new Artist();
            $artist->setNom($faker->name);
            $artist->setPays($faker->country);
            $artist->setStyle($faker->jobTitle);
            $artist->setPresentation($faker->catchPhrase);
            $manager->persist($artist);
        }


        for($i = 0 ; $i < 10; $i++)
        {
            $event = new Event();
            $event->setType($faker->companySuffix);
            $event->setDateDebut($faker->dateTime($max = 'now', $timezone = null));
            $event->setDateFin($faker->dateTime($max = 'now', $timezone = null));
            $event->setLieu($faker->company);
            $event->setVille($faker->city);
            $event->setDescription($faker->catchPhrase);
            $event->setPrix($faker->numberBetween($min = 5, $max = 150));
            $manager->persist($event);

        }
        


        $manager->flush();
    }
}
