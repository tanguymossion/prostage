<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Stage;

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
        return $this->render('prostage/entreprises.html.twig',['name' => 'Entreprises']);
    }

    public function formations()
    {
        return $this->render('prostage/formations.html.twig',['name' => 'Formations']);
    }

    public function stages($id)
    {
        return $this->render('prostage/stages.html.twig', 
        ['name' => 'Stages','idStage' => $id]);
    }
    
}
