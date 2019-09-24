<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\Usuario;
use BackendBundle\Entity\Solicitud;
use BackendBundle\Entity\Horario;
use BackendBundle\Entity\Laboratorio;
use AppBundle\Services\Helpers;
use AppBundle\Services\JwtAuth;

class SolicitudController extends Controller{

	public function newAction(Request $request, $id = null){
		$helpers = $this->get(Helpers::class);
		$jwt_auth = $this->get(JwtAuth::class);
		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkTokenusuario($token);
		$authCheckR = $jwt_auth->checkTokenresponsable($token);
		if($authCheck || $authCheckR){
			if($authCheck){
				$identity = $jwt_auth->checkTokenusuario($token, true);
				$json = $request->get("json", null);
				if($json != null){
					//crear solicitud
					$params = json_decode($json);
					$ref_usuario = ($identity->sub != null) ? $identity->sub : null;
					$ref_horario =(isset($params->ref_horario)) ? $params->ref_horario : null;
					$borrado =(isset($params->borrado)) ? $params->borrado : null;
					$estado =(isset($params->estado)) ? $params->estado : null;

					//Obtener Usuario y Disponibilidad
					$em = $this->getDoctrine()->getManager();
					$usuario = $em->getRepository('BackendBundle:Usuario')->findOneBy(array(
						'idUsuario' =>$ref_usuario
					));
					$horario = $em->getRepository('BackendBundle:Horario')->findOneBy(array(
						'idHorario' =>$ref_horario
					));

					if($id == null){
						$solicitud = new Solicitud();
						$solicitud->setRefUsuario($usuario);
						$solicitud->setRefHorario($horario);
						$solicitud->setBorrado($borrado);
						$solicitud->setEstado($estado);
						$em->persist($solicitud);
						$em->flush();
					}
					$data = array(
						'status' => 'success',
						'code' => 200,
						'data' => $solicitud
					);
				}
				else{
					$data = array(
						'status' => 'error',
						'code' => 400,
						'mensaje' => 'La solicitud no se pudo crear'
					);
				}
			}
			if($authCheckR){
				$json = $request->get("json", null);
				$params = json_decode($json);
				$estado =(isset($params->estado)) ? $params->estado : null;
				$em = $this->getDoctrine()->getManager();
				$solicitud = $em->getRepository('BackendBundle:Solicitud')->findOneBy(array(
					"idSolicitud" => $id
				));
					$solicitud->setEstado($estado);
					$em->persist($solicitud);
					$em->flush();
					$data = array(
						'status' => 'success',
						'code' => 200,
						'data' => $solicitud
					);
			}
		}//if($authCheck)
		else{
			$data = array(
				'status' => 'error',
				'code' => 400,
				'mensaje' => 'El usuario no esta autorizado'
			);
		}

		return $helpers->json($data);
	}//newAction
	public function editAction(Request $request){
		$helpers = $this->get(Helpers::class);
		$jwt_auth = $this->get(JwtAuth::class);
		$token = $request->get('authorization', null);
		$authCheckR = $jwt_auth->checkTokenresponsable($token);
		$json = $request->get("json", null);
		$params = json_decode($json);
		$estado =(isset($params->estado)) ? $params->estado : null;
		$id =(isset($params->idSolicitud)) ? $params->idSolicitud: null;
		$em = $this->getDoctrine()->getManager();
		$solicitud = $em->getRepository('BackendBundle:Solicitud')->findOneBy(array(
			"idSolicitud" => $id
		));
			$solicitud->setEstado($estado);
			$em->persist($solicitud);
			$em->flush();
			$data = array(
				'status' => 'success',
				'code' => 200,
				'data' => $solicitud
			);
		return $helpers->json($data);
	}


	public function listAction(Request $request){
		$helpers = $this->get(Helpers::class);
		$jwt_auth = $this->get(JwtAuth::class);


		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkTokenusuario($token);
		if($authCheck){
			//Entity Manager
			$em = $this->getDoctrine()->getManager();
			//Conseguir los datos del usuario identificado via token
			$identity = $jwt_auth->checkTokenusuario($token,true);

			$solicitudes = $em->getRepository('BackendBundle:Solicitud')->findBy(array(
				'refUsuario' =>$identity->sub
			));
			$data = array(
			'data' => $solicitudes
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
	}

	public function listallAction(Request $request){
		$helpers = $this->get(Helpers::class);
		$jwt_auth = $this->get(JwtAuth::class);
		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkTokenusuario($token);
		if(true){
			//Entity Manager
			$em = $this->getDoctrine()->getManager();
			$solicitudes = $em->getRepository('BackendBundle:Solicitud')->findAll();
			$data = array(
			'data' => $solicitudes
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
	}






}//SolicitudController
