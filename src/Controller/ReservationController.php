<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
	public function listAction (Request $request) {
		$reservations = $this->getDoctrine()->getRepository(Reservation::class)->findAll();

        return $this->render( 'reservation/index.html.twig' ,  [
			'reservations' => $reservations,
			]
		);

		}
}
