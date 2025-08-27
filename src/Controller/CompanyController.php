<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\TypeOfCompany;
use App\Form\CompaniesType;
use App\Form\TypeOfCompaniesType;
use App\Repository\CompanyRepository;
use App\Repository\TypeOfCompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CompanyController extends AbstractController
{
    #[Route('/company', name: 'app_company')]
    public function company(CompanyRepository $companyRepo): Response
    {
        $companies = $companyRepo->findAll();

        return $this->render('company/index.html.twig', [ 
            'controller_name' => 'HomePageController',
            'companies' => $companies,
        ]);
    }

    #[Route('/companyNew', name: 'app_company_new')]
    public function addCompany(Request $request, EntityManagerInterface $entityManager): Response
    {
        $company = new Company();

        $form = $this->createForm(CompaniesType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){ 
            $entityManager->persist($company);
            $entityManager->flush(); 

            $this->addFlash('success', 'The new company have been added !');

            return $this->redirectToRoute('app_company'); 
        }

        return $this->render('company/addCompany.html.twig', [ // a modifier
            'controller_name' => 'HomePageController',
            'formCompany'=> $form->createView(),
        ]);
    }

    #[Route('/company/{id}', name: 'app_company_show', methods: ['GET'])]
    public function show(Company $company): Response
    {
        return $this->render('company/show.html.twig', [
            'company' => $company,
        ]);
    }

    #[Route('/companyDelete/{id}', name: 'app_company_delete')]
    public function deleteCompanies(Company $company, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($company);
        $entityManager->flush(); 

        $this->addFlash('danger', 'The company have been deleted.');

        return $this->redirectToRoute('app_company'); 
        
    }
// ---------------------------------------------------------------------------------------------------------------------------------
#region TYPE OF
    #[Route('/company/typeOf', name: 'app_company_typeOf')]
    public function companyTypeOf(TypeOfCompanyRepository $typeOfRepo): Response
    {
        $typesOf = $typeOfRepo->findAll();

        return $this->render('company/TypeOfCompanies.html.twig', [ 
            'controller_name' => 'HomePageController',
            'types' => $typesOf,
        ]);
    }

    #[Route('/company/typeOfNew', name: 'app_company_typeOf_new')]
    public function addCompanyTypeOf(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeOf = new TypeOfCompany();

        $form = $this->createForm(TypeOfCompaniesType::class, $typeOf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){ 
            $entityManager->persist($typeOf);
            $entityManager->flush(); 

            $this->addFlash('success', 'The new type of company have been added !');

            return $this->redirectToRoute('app_company_typeOf'); 
        }

        return $this->render('company/addCompanyTypeOf.html.twig', [ // a modifier
            'controller_name' => 'HomePageController',
            'formTypeOf'=> $form->createView(),
        ]);
    }

    #[Route('/company/typeOf/{id}', name: 'app_company_typeOf_show', methods: ['GET'])]
    public function showTypeOf(TypeOfCompany $typeOf): Response
    {
        return $this->render('company/showTypeOf.html.twig', [
            'typeOf' => $typeOf,
        ]);
    }

    #[Route('/company/typeOfDelete/{id}', name: 'app_company_typeOf_delete')]
    public function deleteCompaniesTypeOf(TypeOfCompany $typeOf, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($typeOf);
        $entityManager->flush(); 

        $this->addFlash('danger', 'The type of company have been deleted.');

        return $this->redirectToRoute('app_company_typeOf'); 
        
    }

}
