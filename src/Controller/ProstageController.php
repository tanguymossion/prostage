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
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use App\Form\EntrepriseType;
use App\Form\StageType;

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

    public function ajouterEntreprise(Request $request, ObjectManager $manager)
    {
        // Création d'une entreprise vierge qui sera remplie par le formulaire
        $entreprise = new Entreprise();

        // Création du formulaire permettant de saisir une entreprise
        $formulaireEntreprise = $this->createForm(EntrepriseType::class, $entreprise);
        
        /* On demande au formulaire d'analyser la dernière reqûete Http. 
        Si le tableau POST contenu dans cette requête contient des variables nom, adresse, etc.
        alors la méthode handleRequest() récupère les valeurs de ces variables et les affecte à l'objet $entreprise*/
        $formulaireEntreprise->handleRequest($request);
        
        if ($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid())
        {
            // Enregistrer l'entreprise en base de données
            $manager->persist($entreprise);
            $manager->flush();

            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('prostage_bvn');
        }

        // Afficher la page présentant le formulaire d'ajout d'une entreprise
        return $this->render('prostage/ajouterModifierEntreprise.html.twig',['vueFormulaire' => $formulaireEntreprise->createView(),
        'action'=>"ajouter"]);
    }

    public function modifierEntreprise(Request $request, ObjectManager $manager, Entreprise $entreprise)
    {

        // Création du formulaire permettant de modifier une entreprise
        $formulaireEntreprise = $this->createForm(EntrepriseType::class, $entreprise);
        
        /* On demande au formulaire d'analyser la dernière reqûete Http. 
        Si le tableau POST contenu dans cette requête contient des variables nom, adresse, etc.
        alors la méthode handleRequest() récupère les valeurs de ces variables et les affecte à l'objet $entreprise*/
        $formulaireEntreprise->handleRequest($request);
        
        if ($formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid())
        {
            // Enregistrer l'entreprise en base de données
            $manager->persist($entreprise);
            $manager->flush();

            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('prostage_bvn');
        }

        // Afficher la page présentant le formulaire de modification d'une entreprise
        return $this->render('prostage/ajouterModifierEntreprise.html.twig',['vueFormulaire' => $formulaireEntreprise->createView(),
        'action'=>"modifier"]);
    }

    public function ajouterStage(Request $request, ObjectManager $manager)
    {
        // Création d'un stage vierge qui sera remplie par le formulaire
        $stage = new Stage();

        // Création du formulaire permettant de saisir un stage
        $formulaireStage = $this->createForm(StageType::class, $stage);
        
        /* On demande au formulaire d'analyser la dernière reqûete Http.
        Si le tableau POST contenu dans cette requête contient des variables titre, description, etc.
        alors la méthode handleRequest() récupère les valeurs de ces variables et les affecte à l'objet $stage*/
        $formulaireStage->handleRequest($request);
        
        if ($formulaireStage->isSubmitted() && $formulaireStage->isValid())
        {
            // Enregistrer le stage en base de données
            $manager->persist($stage);
            $manager->flush();

            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('prostage_bvn');
        }

        // Afficher la page présentant le formulaire d'ajout d'un stage
        return $this->render('prostage/ajouterStage.html.twig',['vueFormulaire' => $formulaireStage->createView(),
        'action'=>"ajouter"]);
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
