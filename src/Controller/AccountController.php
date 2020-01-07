<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Security\AccountVoter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class AccountController extends AbstractController
{
    /**
	 * @Route("/user-accounts", name="user-accounts")
	 */
    public function userAccount () {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('account/user.html.twig', [
			'users' => $users,
		]);
    }

	//* @IsGranted("ROLE_ADMIN")

    /**
	 * @Route("/account", name="account")
	 */
	public function index( Request $request): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

//		$account = new User;
//		$account->setValidTo(\DateTime::createFromFormat('Y-m-d', "2023-09-09"));
//		$account->setRoles(array("ROLE_EMPLOYEE"));
//
//        $form = $this->createForm(UserType::class, $account, [
//			'action' => $this->generateUrl('account'),
//		]);
//
//		$form->handleRequest($request);
//
//		if ( $form->isSubmitted() && $form->isValid() ) {
//			$em = $this->getDoctrine()->getManager();
//			$em->persist($account);
//			$em->flush();
//			$this->addFlash('success', 'Ucet vytvoren.');
//			return $this->redirectToRoute('account', [
//				'id' => $account->getId(),
//				]);
//			}
//
			return $this->render('account/index.html.twig', [
		//		'form' => $form->createView(),
				'users' => $users
		]);
	}
    /**
	 * @Route("/account-create", name="account-create")
	 */
	public function createUser( Request $request): Response
    {
		// $this->denyAccessUnlessGranted(AccountVoter::NEW, $this->getUser());
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

		$account = new User;
		$account->setValidTo(\DateTime::createFromFormat('Y-m-d', "2023-09-09"));
		$account->setRoles(array("ROLE_EMPLOYEE"));

        $form = $this->createForm(UserType::class, $account, [
			'action' => $this->generateUrl('user-accounts'),
		]);

		$form->handleRequest($request);

		if ( $form->isSubmitted() && $form->isValid() ) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($account);
			$em->flush();
			$this->addFlash('success', 'Ucet vytvoren.');
			return $this->redirectToRoute('account-create', [
				'id' => $account->getId(),
				]);
			}

			return $this->render('account/create.html.twig', [
				'form' => $form->createView(),
				'users' => $users
		]);
	}

	/**
	 * @Route("account/delete/{id}", name="account-delete")
	 */
    public function delete(Request $request)
    {
		$id = $request->get('id');
        $account = $this->getDoctrine()->getRepository(User::class)->find($id);

        // $this->denyAccessUnlessGranted(AccountVoter::DELETE, $account);

        $em = $this->getDoctrine()->getManager();
        $em->remove($account);
        $em->flush();

        return $this->redirectToRoute('user-accounts');
    }

}