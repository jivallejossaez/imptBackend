<?php
namespace AppBundle\Services;

use Firebase\JWT\JWT;

class JwtAuth{
	public $manager;
	public $keyusuario;
	public $keyresponsable;

	public function __construct($manager){
		$this->manager = $manager;
		$this->keyusuario = 'usuario2017';
		$this->keyresponsable = 'responsable2017';
	}

	public function signupusuario($correo, $clave, $getHash = "false"){
		$usuario = $this->manager->getRepository('BackendBundle:Usuario')->findOneBy(array(
				"correo"=> $correo,
				"clave"=> $clave
			));
		$signup = false;
		if(is_object($usuario)){
			$signup = true;
		}
		if($signup == true){
			//Generar Tocken JWT
			$token = array(
				"sub" => $usuario->getIdUsuario(),
				"rut" => $usuario->getRut(),
				"nombre" => $usuario->getNombre(),
				"apellido" => $usuario->getApellido(),
				"numeroTelefono" => $usuario->getNumeroTelefono(),
				"correo" => $usuario->getCorreo(),
				"dependencia" => $usuario->getDependencia(),
				"tipoPersona" => $usuario->getTipoPersona(),
				"nivel" => $usuario->getNivel(),
				"clave" => $usuario->getClave(),
				"iat" => time(),
				"exp" => time() +(60*60)
			);
			$jwt = JWT::encode($token, $this->keyusuario, 'HS256');
			$decoded = JWT::decode($jwt, $this->keyusuario, array('HS256'));
			if($getHash == "false"){
				$data = $jwt;
			}
			else{
				$data = $decoded;
			}
		}
		else{
			$data= array(
				'status'=>'error',
				'data' =>'Login failed'
			);
		}
		return $data;
	}

	public function checkTokenusuario($jwt,$getIdentity = false){
		$auth = false;
		try{
			$decoded = JWT::decode($jwt, $this->keyusuario, array('HS256'));
		}
		catch(\UnexpectedValueException $e){
			$auth =false;
		}
		catch(\DomainException $e){
			$auth=false;
		}
		if(isset($decoded) && is_object($decoded) && isset($decoded->sub)){
			$auth=true;
		}
		else{
			$auth=false;
		}

		if($getIdentity == false){
			return $auth;
		}
		else{
			return $decoded;
		}
	}
	
	public function checkTokenresponsable($jwt,$getIdentity = false){
		$auth = false;
		try{
			$decoded = JWT::decode($jwt, $this->keyresponsable, array('HS256'));
		}
		catch(\UnexpectedValueException $e){
			$auth =false;
		}
		catch(\DomainException $e){
			$auth=false;
		}
		if(isset($decoded) && is_object($decoded) && isset($decoded->sub)){
			$auth=true;
		}
		else{
			$auth=false;
		}

		if($getIdentity == false){
			return $auth;
		}
		else{
			return $decoded;
		}
	}

	public function signupresponsable($correo, $clave, $getHash = null){
		$responsable = $this->manager->getRepository('BackendBundle:Responsable')->findOneBy(array(
				"correo"=> $correo,
				"clave"=> $clave
			));
		$signup = false;
		if(is_object($responsable)){
			$signup = true;
		}
		if($signup == true){
			//Generar Tocken JWT
			$token = array(
				"sub" => $responsable->getIdResponsable(),
				"rut" => $responsable->getRut(),
				"nombre" => $responsable->getNombre(),
				"apellido" => $responsable->getApellido(),
				"numeroTelefono" => $responsable->getNumeroTelefono(),
				"correo" => $responsable->getCorreo(),
				"nivel" => $responsable->getNivel(),
				"clave" => $responsable->getClave(),
				"iat" => time(),
				"exp" => time() +(60*60)
			);
			$jwt = JWT::encode($token, $this->keyresponsable, 'HS256');
			$decoded = JWT::decode($jwt, $this->keyresponsable, array('HS256'));
			if($getHash ==null){
				$data = $jwt;
			}
			else{
				$data = $decoded;
			}
		}
		else{
			$data= array(
				'status'=>'error',
				'data' =>'Login failed'
			);
		}
		return $data;
	}

}