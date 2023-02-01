<?php

namespace App\Controller;
use App\Form\UsersType;
use App\Entity\Users;
use App\Repository\UsersRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnexionControlleurController extends AbstractController
{
    #[Route('/connexion/controlleur', name: 'app_connexion_controlleur')]
    public function index(): Response
    {
        return $this->render('connexion_controlleur/index.html.twig', [
            'controller_name' => 'ConnexionControlleurController',
        ]);
    }

    #[Route('/createaccount', name: 'app_register')]
    public function addaccount(Request $request, EntityManagerInterface $entityManager): Response
    {   
        $Connexion = new Users();
                
        $form = $this->createForm(UsersType::class, $Connexion);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($Connexion);          
            $entityManager->flush();
        }

        return $this->render('connexion_controlleur/register.html.twig', [
        'form' => $form->createView()
        ]);
    }


}
