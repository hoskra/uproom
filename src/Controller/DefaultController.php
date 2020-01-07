<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
	extends AbstractController {

	public function actionIndex () {
		return $this->forward( 'App\Controller\RoomController::listAction' );
	}
}