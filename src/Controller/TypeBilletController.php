<?php

namespace App\Controller;

use App\Entity\TypeBillet;
use App\Form\TypeBilletType;
use App\Repository\TypeBilletRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/type/billet')]
final class TypeBilletController extends AbstractController{
    #[Route(name: 'app_type_billet_index', methods: ['GET'])]
    public function index(TypeBilletRepository $typeBilletRepository): Response
    {
        return $this->render('type_billet/index.html.twig', [
            'type_billets' => $typeBilletRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_billet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeBillet = new TypeBillet();
        $form = $this->createForm(TypeBilletType::class, $typeBillet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeBillet);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_billet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_billet/new.html.twig', [
            'type_billet' => $typeBillet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_billet_show', methods: ['GET'])]
    public function show(TypeBillet $typeBillet): Response
    {
        return $this->render('type_billet/show.html.twig', [
            'type_billet' => $typeBillet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_billet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeBillet $typeBillet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeBilletType::class, $typeBillet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_billet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_billet/edit.html.twig', [
            'type_billet' => $typeBillet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_billet_delete', methods: ['POST'])]
    public function delete(Request $request, TypeBillet $typeBillet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeBillet->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($typeBillet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_billet_index', [], Response::HTTP_SEE_OTHER);
    }
}
