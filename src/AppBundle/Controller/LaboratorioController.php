<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\Laboratorio;
use AppBundle\Services\Helpers;
use AppBundle\Services\JwtAuth;


class LaboratorioController extends Controller{
	public function listAction(Request $request){
		$helpers = $this->get(Helpers::class);
		$jwt_auth = $this->get(JwtAuth::class);
		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkTokenusuario($token);
		if(true){
			$em = $this->getDoctrine()->getManager();
			$laboratorio = $em->getRepository('BackendBundle:Laboratorio')->findAll();
			$data = array(
				'data' => $laboratorio
			);
	}
		else{
			$data = array(
				'status' => 'error',
				'code' => 400,
				'mensaje' => 'El usuario no esta autorizado'
			);
		}
		return $helpers->json($data);
	}//listAction



	public function listResponsableAction(Request $request){
		$helpers = $this->get(Helpers::class);
		$jwt_auth = $this->get(JwtAuth::class);
		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkTokenresponsable($token);
		if($authCheck){

			$em = $this->getDoctrine()->getManager();
			$identity = $jwt_auth->checkTokenresponsable($token,true);
			if($identity->nivel == 1){
				$laboratorio = $em->getRepository('BackendBundle:Laboratorio')->findBy(array(
					'refResponsable' =>$identity->sub
				));
				$data = array(
					'data' => $laboratorio
				);
			}
			if($identity->nivel == 2){
				$laboratorio = $em->getRepository('BackendBundle:Laboratorio')->findAll();
				$data = array(
					'data' => $laboratorio
				);
			}
		}
		else{
			$data = array(
				'status' => 'error',
				'code' => 400,
				'mensaje' => 'El usuario no esta autorizado'
			);
		}
		return $helpers->json($data);
	}//listAction
	public function listTodosAction(Request $request){
		$helpers = $this->get(Helpers::class);
		$jwt_auth = $this->get(JwtAuth::class);
		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkTokenresponsable($token);
		if($authCheck){

			$em = $this->getDoctrine()->getManager();
			$identity = $jwt_auth->checkTokenresponsable($token,true);
			$laboratorio = $em->getRepository('BackendBundle:Laboratorio')->findAll();
			$data = array(
				'data' => $laboratorio
			);
	}
		else{
			$data = array(
				'status' => 'error',
				'code' => 400,
				'mensaje' => 'El usuario no esta autorizado'
			);
		}
		return $helpers->json($data);
	}//listAction

}//LaboratorioController
