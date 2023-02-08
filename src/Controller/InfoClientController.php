<?php

namespace App\Controller;

use App\Entity\InfoClient;
use App\Form\InfoClientType;
use App\Repository\InfoClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/infoclient')]
class InfoClientController extends AbstractController
{
    #[Route('/', name: 'app_infoclient_index', methods: ['GET'])]
    public function index(InfoClientRepository $infoClientRepository): Response
    {
        return $this->render('c_ontrolleur_info_client_crud/index.html.twig', [
            'info_clients' => $infoClientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_infoclient_new', methods: ['GET', 'POST'])]
    public function new(Request $request, InfoClientRepository $infoClientRepository): Response
    {
        $infoClient = new InfoClient();
        $form = $this->createForm(InfoClientType::class, $infoClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoClientRepository->save($infoClient, true);

            return $this->redirectToRoute('app_infoclient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('c_ontrolleur_info_client_crud/new.html.twig', [
            'info_client' => $infoClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_ontrolleur_info_client_crud_show', methods: ['GET'])]
    public function show(InfoClient $infoClient): Response
    {
        return $this->render('c_ontrolleur_info_client_crud/show.html.twig', [
            'info_client' => $infoClient,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_c_ontrolleur_info_client_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InfoClient $infoClient, InfoClientRepository $infoClientRepository): Response
    {
        $form = $this->createForm(InfoClientType::class, $infoClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoClientRepository->save($infoClient, true);

            return $this->redirectToRoute('app_infoclient_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('c_ontrolleur_info_client_crud/edit.html.twig', [
            'info_client' => $infoClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_ontrolleur_info_client_crud_delete', methods: ['POST'])]
    public function delete(Request $request, InfoClient $infoClient, InfoClientRepository $infoClientRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infoClient->getId(), $request->request->get('_token'))) {
            $infoClientRepository->remove($infoClient, true);
        }

        return $this->redirectToRoute('app_infoclient_index', [], Response::HTTP_SEE_OTHER);
    }
}
