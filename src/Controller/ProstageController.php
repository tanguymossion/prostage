<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

class ProstageController extends AbstractController
{
    public function index()
    {
        return $this->render('prostage/index.html.twig', [
            'controller_name' => 'ProstageController',
        ]);
    }

    public function bvn()
    {
        // Récupérer le repository de l'entité Stage
        $repStage = $this->getDoctrine()->getRepository(Stage::class);
        
        // Récupérer les stages enregistrés en BD
        $stages = $repStage->findAll();

        // Envoyer les stages récupérés à la vue chargée de les afficher
        return $this->render('prostage/bvn.html.twig',['name' => 'Accueil','stages' => $stages]);
    }

    public function entreprises()
    {
        // Récupérer le repository de l'entité Entreprise
        $repEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);
        
        // Récupérer les entreprises enregistrées en BD
        $entreprises = $repEntreprise->findAll();

        // Envoyer les entreprises récupérées à la vue chargée de les afficher
        return $this->render('prostage/entreprises.html.twig',['name' => 'Entreprises','entreprises' => $entreprises]);
    }

    public function formations()
    {
        // Récupérer le repository de l'entité Formation
        $repFormation = $this->getDoctrine()->getRepository(Formation::class);
        
        // Récupérer les entreprises enregistrées en BD
        $formations = $repFormation->findAll();

        // Envoyer les entreprises récupérées à la vue chargée de les afficher
        return $this->render('prostage/formations.html.twig',['name' => 'Formations','formations' => $formations]);
    }

    public function stages($id)
    {
        // Récupérer le repository de l'entité Stage
        $repStage = $this->getDoctrine()->getRepository(Stage::class);
        
        // Récupérer le stage correspondant à l'id enregistré en BD
        $stage = $repStage->find($id);

        // Envoyer le stage récupéré à la vue
        return $this->render('prostage/stages.html.twig',['name' => 'Stage','stage' => $stage]);
    }
    
    public function parEntreprise($id)
    {
        // Récupérer le repository de l'entité Entreprise
        $repEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);
        
        // Récupérer l'entreprise correspondant à l'id enregistré en BD
        $entreprise = $repEntreprise->find($id);

        // Envoyer l'entreprise récupérée à la vue
        return $this->render('prostage/parEntreprise.html.twig',['name' => 'Stages par entreprise','entreprise' => $entreprise]);
    }

    public function parFormation($id)
    {
        // Récupérer le repository de l'entité Formation
        $repFormation = $this->getDoctrine()->getRepository(Formation::class);
        
        // Récupérer la formation correspondant à l'id enregistré en BD
        $formation = $repFormation->find($id);

        // Envoyer la formation récupérée à la vue
        return $this->render('prostage/parFormation.html.twig',['name' => 'Stages par formation','formation' => $formation]);
    }

    public function aPropos()
    {
        return $this->render('prostage/aPropos.html.twig',['name' => 'A propos']);
    }
}
