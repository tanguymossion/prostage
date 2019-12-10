<?php

namespace App\DataFixtures;

use App\Entity\Formation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Création d'un générateur de données Faker
        $faker = \Faker\Factory::create('fr_FR');

        $nbFormations = 5;

        for($i=1; $i <= $nbFormations ; $i++)
        {
            // Création d'une nouvelle formation
            $formationDUTInfo = new Formation();
            // Définition d'un nom de formation
            $formationDUTInfo->setNom($faker->realText($maxNbChars = 20, $indexSize = 2));
            // Enregistrement de la formation créée
            $manager->persist($formationDUTInfo);
        }

        // Envoyer les données en BD
        $manager->flush();
    }
}
