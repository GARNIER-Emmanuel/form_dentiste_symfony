<?php

namespace App\Controller;
use App\Form\FilmType;
use App\Entity\Film;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use finfo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    #[Route('/film', name: 'app_film_liste')]
    public function liste(FilmRepository $filmRepository): Response
    {
        $films = $filmRepository->findAll();

        return $this->render('film/liste.html.twig', [
            'controller_name' => 'FilmController',
            'films' => $films
        ]);
    }

    
    #[Route('/film/liste', name: 'app_addfilm')]
    public function addFilm(Request $request, EntityManagerInterface $entityManager): Response
    {   
        $film = new Film();
                
        $form = $this->createForm(FilmType::class, $film);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($film);          
            $entityManager->flush();
        }

        return $this->render('film/ajouterFilm.html.twig', [
        'form' => $form->createView()
        ]);
    }


    #[Route('/film/modifFilm', name: 'app_modifFilm')]
    public function modif(?Film $film, Request $request, EntityManagerInterface $entityManager): Response
    {   
        if(!$film){
            $film = new Film();
        }

        $form = $this->createForm(FilmType::class, $film);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            if(!$film->getId()){
                $entityManager->persist($film);
            }
            
            $entityManager->flush();
        

        return $this->redirect($this->generateUrl('app_modifFilm',
         ['id' => $film->getId()]));
    }

        return $this->render('film/modifFilm.html.twig', [
            
        'form' => $form->createView()
        ]);
    }


    #[Route('/film/supp', name: 'app_supFilm')]
    public function supFilm(Request $request, EntityManagerInterface $entityManager): Response
    {   
        $film = new Film();
                
        $form = $this->createForm(FilmType::class, $film);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($film);          
            $entityManager->flush();
        }

        return $this->render('film/supFilm.html.twig', [
        'form' => $form->createView()
        ]);
    }

}

