<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello', name: 'app_hello')]
    public function index(): Response
    {
        return $this->render('hello/index.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }

    #[Route('/film/liste', name: 'app_film')]
    public function addFilm(): Response
    {
        return $this->render('film/ajouterFilm.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }

    
    
}
