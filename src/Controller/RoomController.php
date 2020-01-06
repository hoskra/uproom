<?php

namespace App\Controller;

use App\Entity\Room;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomController extends AbstractController
{
    /**
     * @Route("/room", name="room")
     */
	public function listAction (Request $request) {
		$rooms = $this->getDoctrine()->getRepository(Room::class)->findAll();

        return $this->render( 'room/index.html.twig' ,  [
			'rooms' => $rooms,
			]
		);

		}
}
