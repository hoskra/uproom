<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\Role;
use App\Form\EmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Twig_Error;


class EmployeeController extends AbstractController {

	/**
	 * @Route("/", name="index")
	 */
	public function listAction (Request $request) {
		return $this->forward( 'App\Controller\RoomController::listAction' );

		$employees = $this->getDoctrine()->getRepository(Employee::class)->findAll();

		$user = $this->getUser();

		//dump($request);
    		// $employees = $this->database->getEmployees();
		return $this->render( 'index.html.twig' ,  [
			'employees' => $employees,
			'user' => $user]
		);

		}

	/**
	 * @Route("/employee/detail/{id}", name="employee-detail")
	 */
	public function detailEmployee ( Request $request ) {
		$id = $request->get('id');
		$employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);
		$roles = $employee->getRole();

		return $this->render('employee/index.html.twig', [
			'employee' => $employee,
			'roles' => $roles
		]);
	}

    /**
	 * @Route("/employee/edit/{id}", name="employee-edit")
	 */
    public function editEmployee ( Request $request ) {
		$id = $request->get('id');
		$employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);

		$form = $this->createForm(EmployeeType::class, $employee);
		$form->handleRequest($request);

		if ( $form->isSubmitted() ) {
			$em = $this->getDoctrine()->getManager();

			$em->persist($employee);
			$em->flush();
			$this->addFlash('success', 'Zamestnanec upraven.');
			return $this->redirectToRoute('employee-detail', [
				'id' => $employee->getId(),
			]);
		}

		return $this->render('employee/edit.html.twig' , [
			'form' => $form->createView(),
			'id' => $id,
			'employee' => $employee
		]);
	}

	/**
	 * @Route("employee/create", name="employee-create")
	 */
	public function createEmployee ( Request $request )
	{
		$employee = new Employee();

		$employee->setSurname('test');
		$employee->setLastName('test');
		$employee->setFunction('test');
		$employee->setPhoneNumber('test');
		$employee->setEmail('test');
		$employee->setWebpage('test');
		$employee->setPhoto('test');
		$employee->setDescription('test');
		// $role = $this->getDoctrine()->getRepository(Role::class)->find(1);
		// $employee->addRole($role);

		$form = $this->createForm(EmployeeType::class, $employee, [
			'action' => $this->generateUrl('employee-create'),
			// post is by default ...
			'method' => 'POST'
		]);

		$form->handleRequest($request);

		if ( $form->isSubmitted() && $form->isValid() ) {

			$em = $this->getDoctrine()->getManager();

			$em->persist($employee);
			$em->flush();
			$this->addFlash('success', 'Zamestnanec vytvoren.');
			return $this->redirectToRoute('employee-detail', [
				'id' => $employee->getId(),
			]);
		}

		return $this->render('employee/create.html.twig', [
			'form' => $form->createView()
		]);
	}
}