<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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
        return $this->render('prostage/bvn.html.twig');
    }

    public function entreprises()
    {
        return $this->render('prostage/entreprises.html.twig');
    }

    public function formations()
    {
        return $this->render('prostage/formations.html.twig');
    }

    public function stages($id)
    {
        return new Response("<html><body><h1>Cette page affichera le descriptif du stage ayant pour identifiant $id</h1></body></html>");
    }
    
}
