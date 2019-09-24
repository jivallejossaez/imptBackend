<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\Usuario;
use AppBundle\Services\Helpers;
use AppBundle\Services\JwtAuth;

class UsuarioController extends Controller{

	public function newAction(Request $request){
		$helpers = $this->get(Helpers::class);

		$json = $request->get("json",null);
		$params = json_decode($json);

		$data = array(
			'status' => 'error',
			'code' => 400,
			'mensaje' => 'El usuario no ha sido creado'
			);
		if($json != null){
		    $rut =(isset($params->rut)) ? $params->rut : null;
		    $nivel =(isset($params->nivel)) ? $params->nivel : null;
		    $nombre =(isset($params->nombre)) ? $params->nombre : null;
		    $apellido =(isset($params->apellido)) ? $params->apellido : null;
				$numeroTelefono =(isset($params->numeroTelefono)) ? $params->numeroTelefono : null;
				$correo =(isset($params->correo)) ? $params->correo : null;
				$dependencia =(isset($params->dependencia)) ? $params->dependencia : null;
				$tipoPersona =(isset($params->tipoPersona)) ? $params->tipoPersona : null;
				$borrado =(isset($params->borrado)) ? $params->borrado : null;
				$clave =(isset($params->clave)) ? $params->clave : null;

				$usuario = new Usuario();
				$usuario->setRut($rut);
				$usuario->setNivel($nivel);
				$usuario->setNombre($nombre);
				$usuario->setApellido($apellido);
				$usuario->setNumeroTelefono($numeroTelefono);
				$usuario->setCorreo($correo);
				$usuario->setDependencia($dependencia);
				$usuario->setTipoPersona($tipoPersona);
				$usuario->setBorrado($borrado);

			//Cifrar Contraseña
			$cifrador = hash('sha256', $clave);
			$usuario->setClave($cifrador);


			//buscar si el usuario existe (cambiar por rut)
			$em = $this->getDoctrine()->getManager();
			$isset_usuario = $em->getRepository('BackendBundle:Usuario')->findby(array(
				"rut" =>$rut
				));
			if(count($isset_usuario) == 0 ){
				$em->persist($usuario);
				$em->flush();
				$data = array(
				'status' => 'success',
				'code' => 200,
				'mensaje' => 'Se ha Registrado el usuario satisfactoriamente',
				"usuario" => $usuario
				);
			}
			else{
				$data = array(
					'status' => 'error',
					'code' => 400,
					'mensaje' => 'El usuario ya se encuentra registrado en la base de datos'
				);
			}
		}
		return $helpers->json($data);
	}//newAction

	public function editAction(Request $request){
		$helpers = $this->get(Helpers::class);
		$jwt_auth = $this->get(JwtAuth::class);


		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkTokenusuario($token);
		if($authCheck){
			//Entity Manager
			$em = $this->getDoctrine()->getManager();
			//Conseguir los datos del usuario identificado via token
			$identity = $jwt_auth->checkTokenusuario($token,true);
			//conseguir el objeto a actualizar
			$usuario = $em->getRepository('BackendBundle:Usuario')->findOneBy(array(
				'idUsuario' =>$identity->sub
			));

			//recoger datos post
			$json = $request->get("json",null);
			$params = json_decode($json);

			//Arreglo de error
			$data = array(
				'status' => 'error',
				'code' => 400,
				'mensaje' => 'El usuario no se ha podido modificar'
				);
			if($json != null){
			    $rut =(isset($params->rut)) ? $params->rut : null;
			    $nivel =(isset($params->nivel)) ? $params->nivel : null;
			    $nombre =(isset($params->nombre)) ? $params->nombre : null;
			    $apellido =(isset($params->apellido)) ? $params->apellido : null;
				$numeroTelefono =(isset($params->numeroTelefono)) ? $params->numeroTelefono : null;
				$correo =(isset($params->correo)) ? $params->correo : null;
				$dependencia =(isset($params->dependencia)) ? $params->dependencia : null;
				$tipoPersona =(isset($params->tipoPersona)) ? $params->tipoPersona : null;
				$borrado =(isset($params->borrado)) ? $params->borrado : null;
				$clave =(isset($params->clave)) ? $params->clave : null;
				//poner condicion que los datos no sean nulos!
				$usuario->setRut($rut);
				$usuario->setNivel($nivel);
				$usuario->setNombre($nombre);
				$usuario->setApellido($apellido);
				$usuario->setNumeroTelefono($numeroTelefono);
				$usuario->setCorreo($correo);
				$usuario->setDependencia($dependencia);
				$usuario->setTipoPersona($tipoPersona);
				$usuario->setBorrado($borrado);
				//Cifrar Contraseña
				$cifrador = hash('sha256', $clave);
				$usuario->setClave($cifrador);

				$isset_usuario = $em->getRepository('BackendBundle:Usuario')->findby(array(
					"rut" =>$rut
					));
				if(count($isset_usuario) == 0 || $identity->rut == $rut){
					$em->persist($usuario);
					$em->flush();
					$data = array(
					'status' => 'success',
					'code' => 200,
					'mensaje' => 'Se ha actualizado correctamente el usuario',
					"usuario" => $usuario
					);
				}
				else{
					$data = array(
						'status' => 'error',
						'code' => 400,
						'mensaje' => 'No se pudo actualizar los datos del usuario'
					);
				}
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
	}//editAction

}
