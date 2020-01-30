<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Repository\StageRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\FormationRepository;

class ProstageController extends AbstractController
{
    public function index()
    {
        return $this->render('prostage/index.html.twig', [
            'controller_name' => 'ProstageController',
        ]);
    }

    public function bvn(StageRepository $repStage)
    {
        // Récupérer les stages enregistrés en BD
        $stages = $repStage->findStagesEtEntreprises();

        // Envoyer les stages récupérés à la vue chargée de les afficher
        return $this->render('prostage/bvn.html.twig',['name' => 'Accueil','stages' => $stages]);
    }

    public function entreprises(EntrepriseRepository $repEntreprise)
    {
        // Récupérer les entreprises enregistrées en BD
        $entreprises = $repEntreprise->findAll();

        // Envoyer les entreprises récupérées à la vue chargée de les afficher
        return $this->render('prostage/entreprises.html.twig',['name' => 'Entreprises','entreprises' => $entreprises]);
    }

    public function formations(FormationRepository $repFormation)
    {
        // Récupérer les entreprises enregistrées en BD
        $formations = $repFormation->findAll();

        // Envoyer les entreprises récupérées à la vue chargée de les afficher
        return $this->render('prostage/formations.html.twig',['name' => 'Formations','formations' => $formations]);
    }

    public function stages(Stage $stage)
    {
        // Envoyer le stage récupéré à la vue
        return $this->render('prostage/stages.html.twig',['name' => 'Stage','stage' => $stage]);
    }
    
    public function parEntreprise(Entreprise $entreprise)
    {
        // Récupérer le repository de l'entité Entreprise	
        $repStage = $this->getDoctrine()->getRepository(Stage::class);

        // Récupérer l'entreprise correspondant à l'id enregistré en BD	
        $stages = $repStage->findByEntreprise($entreprise);
        
        // Envoyer l'entreprise récupérée à la vue
        return $this->render('prostage/parEntreprise.html.twig',['name' => 'Stages par entreprise','entreprise' => $entreprise, 'stages' => $stages]);
    }

    public function parFormation(Formation $formation)
    {
        // Récupérer le repository de l'entité Entreprise	
        $repStage = $this->getDoctrine()->getRepository(Stage::class);

        // Récupérer l'entreprise correspondant à l'id enregistré en BD	
        $stages = $repStage->findByFormation($formation);
        
        // Envoyer la formation récupérée à la vue
        return $this->render('prostage/parFormation.html.twig',['name' => 'Stages par formation','formation' => $formation, 'stages' => $stages]);
    }

    public function aPropos()
    {
        return $this->render('prostage/aPropos.html.twig',['name' => 'A propos']);
    }
}
