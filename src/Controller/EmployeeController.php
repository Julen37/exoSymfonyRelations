<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeesType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EmployeeController extends AbstractController
{
    #[Route('/employee', name: 'app_employee')]
    public function index(EmployeeRepository $employeeRepo): Response
    {
        $employees = $employeeRepo->findAll();
    
        return $this->render('employee/index.html.twig', [
            'controller_name' => 'EmployeeController',
            'employees'=> $employees,
        ]);
    }

    #[Route('/employeeNew', name: 'app_employee_new')]
    public function addEmployee(Request $request, EntityManagerInterface $entityManager): Response
    {
        $employee = new Employee();

        $form = $this->createForm(EmployeesType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){ 
            $entityManager->persist($employee);
            $entityManager->flush(); 

            $this->addFlash('success', 'The new employee have been added !');

            return $this->redirectToRoute('app_employee'); 
        }

        return $this->render('employee/addEmployee.html.twig', [ // a modifier
            'controller_name' => 'HomePageController',
            'form'=> $form->createView(),
        ]);
    }

    #[Route('/employee/{id}', name: 'app_employee_show', methods: ['GET'])]
    public function show(Employee $employee): Response
    {
        return $this->render('employee/show.html.twig', [
            'employee' => $employee,
        ]);
    }

    #[Route('/employeeDelete/{id}', name: 'app_employee_delete')]
    public function deleteCompanies(Employee $employee, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($employee);
        $entityManager->flush(); 

        $this->addFlash('danger', 'The employee have been deleted.');

        return $this->redirectToRoute('app_employee'); 
        
    }
}
