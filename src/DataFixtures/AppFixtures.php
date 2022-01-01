<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Livre ; 
use App\Entity\Auteur ; 
use App\Entity\Genre ; 
use App\Entity\User ;

use Faker ; 


class AppFixtures extends Fixture 
{
    public function load(ObjectManager $manager): void
    {
        // la declaration de faker : 
        $faker = Faker\Factory::create();
        // la declaration des genres 
        $auteurs = [];
        for($i = 0 ; $i < 20 ; $i++ ){
            $auteur = new Auteur();
            $auteur->setNomPrenom($faker->name);
            $auteur->setSexe($faker->randomElement(['M', 'F']));
            $auteur->setDateNaissance($faker->dateTimeBetween('-30 years', 'now'));
            $auteur->setNationalite($faker->country);
            $manager->persist($auteur);
            $auteurs[] = $auteur ; 
        }

        // ajout des genres : 

        $genres = [] ; 
        for($i = 0 ; $i < 10; $i++){
            $genre = new Genre();
            $genre->setNom($faker->word) ;
            $manager->persist($genre);
            $genres[]=$genre ; 
        }
        
        // l'ajout des livres : 
        $livres = [] ;
        for($i = 0 ; $i < 50 ; $i++){
            $livre = new Livre() ;
            $livre->setIsbn($faker->isbn13);
            $livre->setTitre($faker->title) ;
            $livre->setNombrePages($faker->numberBetween($min = 50, $max = 9000));
            $livre->setDateDeParution($faker->dateTimeBetween('-15 years', 'now'));
            $livre->setNote($faker->numberBetween(0,20));
            $livre->addAuteur($auteurs[$faker->numberBetween(0,19)]);
            // here i have to add le genre : 
            $livre->addGenre($genres[$faker->numberBetween(0,9)]);

            $manager->persist($livre) ;
            $livres[] = $livre ; 
        }

        // Ajout de user : 
        $users = [] ;
        for($i = 0 ; $i < 50 ; $i++){
            $user = new User() ;
            $user->setNom($faker->name) ;
            $user->setRole("USER") ;
            $manager->persist($user) ;
            $users[] = $user ; 
        }
        
        $manager->flush();
    }
}
