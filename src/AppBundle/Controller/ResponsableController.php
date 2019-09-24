<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\Responsable;
use AppBundle\Services\Helpers;

class ResponsableController extends Controller{

	public function newAction(Request $request){
		$helpers = $this->get(Helpers::class);
		$json = $request->get("json",null);
		$params = json_decode($json);
		echo 'hola';
		die();
	}

	

}