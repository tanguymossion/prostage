<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Form\UserType;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_inscription")
     */
    public function inscription(Request $request, ObjectManager $manager)
    {
        // Création d'un user vierge qui sera rempli par le formulaire
        $user = new User();

        // Création du formulaire permettant de saisir un user
        $formulaireUser = $this->createForm(UserType::class, $user);
        
        /* On demande au formulaire d'analyser la dernière reqûete Http. 
        Si le tableau POST contenu dans cette requête contient des variables prenom, nom, etc.
        alors la méthode handleRequest() récupère les valeurs de ces variables et les affecte à l'objet $user*/
        $formulaireUser->handleRequest($request);
        
        if ($formulaireUser->isSubmitted() && $formulaireUser->isValid())
        {
            // Enregistrer l'user en base de données
            //$manager->persist($user);
            //$manager->flush();

            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('prostage_bvn');
        }

        // Afficher la page présentant le formulaire d'inscription
        return $this->render('security/inscription.html.twig',['vueFormulaire' => $formulaireUser->createView(), 'name' => 'Inscription']);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error, 'name' => 'Login']);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {

    }
}
