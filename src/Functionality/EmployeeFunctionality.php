<?php

namespace App\Functionality;


use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;

class EmployeeFunctionality
{
	protected $em;

	public function __construct ( EntityManagerInterface $em )
	{
		$this->em = $em;
	}

	public function save(Employee $employee)
	{
		$employee->getCategory()->addEmployee($employee);
		$employee->getAuthor()->addEmployee($employee);

		$this->em->persist($employee);
		$this->em->flush();
	}

	public function remove (Employee $employee)
	{
		$employee->getCategory()->removeEmployee($employee);
		$employee->getAuthor()->removeEmployee($employee);

		$this->em->remove($employee);
		$this->em->flush();
	}
}
