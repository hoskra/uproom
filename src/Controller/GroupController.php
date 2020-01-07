<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends AbstractController
{
    /**
     * @Route("/group", name="group")
     */
	public function listAction (Request $request) {
		$groups = $this->getDoctrine()->getRepository(UserGroup::class)->findAll();

        return $this->render( 'group/index.html.twig' ,  [
			'groups' => $groups,
			]
		);

		}
}
