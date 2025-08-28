<?php

namespace App\Controller;

use App\Entity\TypeOfCompany;
use App\Form\TypeOfCompanyType;
use App\Repository\TypeOfCompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/typeOfCompany')]
final class TypeOfCompanyController extends AbstractController
{
    #[Route(name: 'app_type_of_company_index', methods: ['GET'])]
    public function index(TypeOfCompanyRepository $typeOfCompanyRepository): Response
    {
        return $this->render('type_of_company/index.html.twig', [
            'type_of_companies' => $typeOfCompanyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_of_company_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeOfCompany = new TypeOfCompany();
        $form = $this->createForm(TypeOfCompanyType::class, $typeOfCompany);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeOfCompany);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_of_company_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_of_company/new.html.twig', [
            'type_of_company' => $typeOfCompany,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_of_company_show', methods: ['GET'])]
    public function show(TypeOfCompany $typeOfCompany): Response
    {
        return $this->render('type_of_company/show.html.twig', [
            'type_of_company' => $typeOfCompany,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_of_company_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeOfCompany $typeOfCompany, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeOfCompanyType::class, $typeOfCompany);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_of_company_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_of_company/edit.html.twig', [
            'type_of_company' => $typeOfCompany,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_of_company_delete', methods: ['POST'])]
    public function delete(Request $request, TypeOfCompany $typeOfCompany, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeOfCompany->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($typeOfCompany);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_of_company_index', [], Response::HTTP_SEE_OTHER);
    }
}
