<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Event;
use App\Entity\Artist;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        $moi = new User();
        $moi->setUsername('fab');
        $moi->setRoles(['ROLE_ADMIN']);
        $moi->setPassword($this->encoder->encodePassword($moi, '123456'));
        $moi->setName('Estrabaud');
        $moi->setFirstName('Fabien');
        $moi->setAddress('1 allee joyeuse');
        $moi->setZipCode('93390');
        $moi->setCity('Clichy-sous-bois');
        $moi->setPhone($faker->phoneNumber);
        $manager->persist($moi);

        for($i=0; $i < 30 ; $i++)
        {
            $user = new User();
            $user->setUsername($faker->unique()->jobTitle);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->encoder->encodePassword($user, '123456'));
            $user->setName($faker->lastName);
            $user->setFirstName($faker->firstName);
            $user->setAddress($faker->streetAddress);
            $user->setZipCode($faker->postCode);
            $user->setCity($faker->randomElement($array = array ('Paris','Bordeaux','Toulouse','Marseille','Lyon','Lille')));
            $user->setPhone($faker->phoneNumber);
            $manager->persist($user);
        }

        

        //Gestion des artist
        $artists = [];
        for($i = 0 ; $i < 30; $i++)
        {
            $artist = new Artist();
            $artist->setNom($faker->name);
            $artist->setPays($faker->country);
            $artist->setStyle($faker->randomElement($array = array ('Rap','Rnb','Rock','Electro','Variété Française','Raggae')));
            $artist->setPresentation($faker->catchPhrase);
            $manager->persist($artist);

            //on push ls artistes dans un tableau pour pouvoir les attribuer a des events
            $artists[] = $artist;
        }

        //Gestion des Events
        for($i = 0 ; $i < 15; $i++)
        {
            $event = new Event();
            $event->setType($faker->randomElement($array = array ('Festival','Concert','AfterWork','Boiler','Grosse soirée')));
            
            //gestion des dates
            $startDate = $faker->dateTimeBetween($startDate = 'now', $endDate = '+2 years');
            $event->setDateDebut($startDate);
            $duration  = mt_rand(3, 10);
            $endDate   = (clone $startDate)->modify("+$duration days");
            $event->setDateFin($endDate);
            
            $event->setLieu($faker->company);
            $event->setVille($faker->city);
            $event->setDescription($faker->catchPhrase);
            $event->setPrix($faker->numberBetween($min = 5, $max = 150));

            //attibution d'un objet artiste pour un evenement:
            $artist = $artists[mt_rand(0, count($artists) - 1)];
            $event->setArtistId($artist);

            $event->setImage($faker->imageUrl($width = 200, $height = 150, 'nightlife'));

            $manager->persist($event);

        }

        //Gestion des produits:
        for($i = 0 ; $i<50; $i++)
        {
            $product = new Produit();
            $product->setTitre($faker->companySuffix);
            $product->setDateProduction($faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now'));
            $product->setPresentation($faker->text($maxNbChars = 200));

            $artist = $artists[mt_rand(0, count($artists) - 1)];
            $product->setArtisteId($artist);
            $manager->persist($product);

        }
        


        $manager->flush();
    }

    //cette fonction doit sappeler comme ca 
    // elle permet de fixture 
    public static function getGroups(): array
    {
        return ['AppFixtures'];
    }
}
