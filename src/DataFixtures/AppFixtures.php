<?php

namespace App\DataFixtures;

use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Formations dans une liste
        
        // Définiion des entreprises
        // for nb d'entreprise aléatoire
        // Création d'une entreprise
        // persist
        // Définition des stages
        // for nb de stages aléatoire
        // Création d'un stage
        // Ajout d'une formation à un stage
        // Ajout du stage à la formation
        // Ajout du stage à l'entreprise


        // Création d'un générateur de données Faker
        $faker = \Faker\Factory::create('fr_FR');

        /******************************************
         ******** CREATION DES FORMATIONS *********     
         ******************************************/
        
        //////////////////////////////////////////////////////////////////////////////
        // Création d'une nouvelle formation
        $formationDUTInfo = new Formation();
        // Définition des attributs
        $formationDUTInfo->setNomCourt("DUT Informatique");
        $formationDUTInfo->setNomLong("Diplome Universitaire Technologique Informatique");
        // Enregistrement de la formation créée
        $manager->persist($formationDUTInfo);

        //////////////////////////////////////////////////////////////////////////////
        // Création d'une nouvelle formation
        $formationLicenceProMul = new Formation();
        // Définition des attributs
        $formationLicenceProMul->setNomCourt("LP Multimédia");
        $formationLicenceProMul->setNomLong("Licence Professionnelle Multimédia");
        // Enregistrement de la formation créée
        $manager->persist($formationLicenceProMul);

        //////////////////////////////////////////////////////////////////////////////
        // Création d'une nouvelle formation
        $formationDUTIC = new Formation();
        // Définition des attributs
        $formationDUTIC->setNomCourt("DU TIC");
        $formationDUTIC->setNomLong("Diplome Universitaire TIC");
        // Enregistrement de la formation créée
        $manager->persist($formationDUTIC);


        /******************************************
         ******** CREATION DES ENTREPRISES ********     
         ******************************************/
        
        // Création d'une nouvelle entreprise
        $entrepriseWeb = new Entreprise();
        // Définition des attributs
        $entrepriseWeb->setNom($faker->company($maxNbChars = 20));
        $entrepriseWeb->setAdresse($faker->address($maxNbChars = 50));
        $entrepriseWeb->setActivite("Web");
        $entrepriseWeb->setSite($faker->url($maxNbChars = 30));
        // Enregistrement de l'entreprise créée
        $manager->persist($entrepriseWeb);

        // Création d'une nouvelle entreprise
        $entrepriseSecu = new Entreprise();
        // Définition des attributs
        $entrepriseSecu->setNom($faker->company($maxNbChars = 20));
        $entrepriseSecu->setAdresse($faker->address($maxNbChars = 50));
        $entrepriseSecu->setActivite("Sécurité");
        $entrepriseSecu->setSite($faker->url($maxNbChars = 30));
        // Enregistrement de l'entreprise créée
        $manager->persist($entrepriseSecu);

        // Création d'une nouvelle entreprise
        $entrepriseDev = new Entreprise();
        // Définition des attributs
        $entrepriseDev->setNom($faker->company($maxNbChars = 20));
        $entrepriseDev->setAdresse($faker->address($maxNbChars = 50));
        $entrepriseDev->setActivite("Développement d'applications mobiles");
        $entrepriseDev->setSite($faker->url($maxNbChars = 30));
        // Enregistrement de l'entreprise créée
        $manager->persist($entrepriseDev);


        /******************************************
         ******** CREATION DES STAGES *************     
         ******************************************/

        // Création d'une nouvelle stage
        $stageCafe = new Stage();
        // Définition des attributs
        $stageCafe->setTitre("Stage de production d'application optimiser la production de produit caféiné H/F");
        $stageCafe->setDescription($faker->paragraph($nbSentences = 10));
        $stageCafe->setEmail($faker->companyEmail($maxNbChars = 30));
        $stageCafe->addMesFormation($formationDUTIC);
        $stageCafe->setMonEntreprise($entrepriseDev);
        // Enregistrement du stage créé
        $manager->persist($stageCafe);

        /*
        // Création d'une nouvelle stage
        $stageElearn = new Stage();
        // Définition des attributs
        $stageElearn->setTitre("Développement d'une solution e-learning H/F");
        $stageElearn->setDescription($faker->paragraph($nbSentences = 10));
        $stageElearn->setEmail($faker->companyEmail($maxNbChars = 30));
        // Enregistrement du stage créé
        $manager->persist($stageElearn);

        // Création d'une nouvelle stage
        $stageInge = new Stage();
        // Définition des attributs
        $stageInge->setTitre("Stagiaire ingénieur informatique H/F");
        $stageInge->setDescription($faker->paragraph($nbSentences = 10));
        $stageInge->setEmail($faker->companyEmail($maxNbChars = 30));
        // Enregistrement du stage créé
        $manager->persist($stageInge);*/

        
        
        // Envoyer les données en BD
        $manager->flush();
    }
}
