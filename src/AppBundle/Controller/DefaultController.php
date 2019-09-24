<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Services\Helpers;
use AppBundle\Services\JwtAuth;

class DefaultController extends Controller{

    public function indexAction(Request $request){
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }//indexAction

    public function loginUsuarioAction(Request $request){
        $helpers = $this->get(Helpers::class);
        //Recibir JSON por POST
        $json = $request->get('json',null);
        $data = array(
            'status' => 'error',
            'data' => 'No se ha recibido ningun usuario'
        );
         if($json !=null){
            //login
            //Convierte un json a un objeto de php
            $params = json_decode($json);
            $correo = (isset($params->correo)) ? $params->correo : null;
            $clave = (isset($params->clave)) ? $params->clave : null;
            $getHash = (isset($params->getHash)) ? $params->getHash : null;
            $correoConstraint = new Assert\Email();
            $correoConstraint->message = "El email no es valido";
            $validate_correo = $this->get("validator")->validate($correo,$correoConstraint);

            $cifrador = hash('sha256', $clave);
            if($correo!= null && count($validate_correo) == 0 && $clave !=null){


                $jwt_auth = $this->get(JwtAuth::class);
                if($getHash == null || $getHash == false){
                    $signup = $jwt_auth->signupusuario($correo,$cifrador);
                }
                else{
                    $signup = $jwt_auth->signupusuario($correo,$cifrador,$getHash);
                }
                return $this->json($signup);
            }
            else{
                $data = array(
                    'status' => 'error',
                    'data' => 'Email Incorrecto'
                );
            }
        }

        return $helpers->json($data);
    }//loginUsuarioAction

    public function pruebasusuarioAction(Request $request){
        $helpers = $this->get(Helpers::class);
        $jwt_auth = $this->get(JwtAuth::class);
        $token = $request->get("authorization",null);

        if($token && $jwt_auth->checkTokenusuario($token)==true){
            $em = $this->getDoctrine()->getManager();
            $userRepo = $em->getRepository('BackendBundle:Usuario');
            $users = $userRepo->findAll();

            return $helpers->json(array(
                'status' => 'success',
                'users' => $users
                ));
        }
        else{
            return $helpers->json(array(
                'status' => 'error',
                'data' => 'Login fallido'
                ));
        }
    }//pruebasusuarioAction

    public function loginResponsableAction(Request $request){
        $helpers = $this->get(Helpers::class);
         //Recibir JSON por POST
         $json = $request->get('json',null);
         $data = array(
            'status' => 'error',
            'data' => 'No se ha recibido ningun usuario'
        );
         if($json !=null){
            //login
            //Convierte un json a un objeto de php
            $params = json_decode($json);
            $correo = (isset($params->correo)) ? $params->correo : null;
            $clave = (isset($params->clave)) ? $params->clave : null;
            $getHash = (isset($params->getHash)) ? $params->getHash : null;
            $correoConstraint = new Assert\Email();
            $correoConstraint->message = "El email no es valido";
            $validate_correo = $this->get("validator")->validate($correo,$correoConstraint);

            if($correo!= null && count($validate_correo) == 0 && $clave !=null){


                $jwt_auth = $this->get(JwtAuth::class);
                if($getHash == null || $getHash == false){
                    $signup = $jwt_auth->signupresponsable($correo,$clave);
                }
                else{
                    $signup = $jwt_auth->signupresponsable($correo,$clave,true);
                }
                return $this->json($signup);
            }
            else{
                $data = array(
                    'status' => 'error',
                    'data' => 'Email Incorrecto'
                );
            }
        }
        return $helpers->json($data);
    }//loginResponsableAction

    public function pruebaresponsableAction(Request $request){
        $helpers = $this->get(Helpers::class);
        $jwt_auth = $this->get(JwtAuth::class);
        $token = $request->get("authorization",null);

        if($token && $jwt_auth->checkTokenresponsable($token)==true){
            $em = $this->getDoctrine()->getManager();
            $userRepo = $em->getRepository('BackendBundle:Responsable');
            $users = $userRepo->findAll();

            return $helpers->json(array(
                'status' => 'success',
                'users' => $users
                ));
        }
        else{
            return $helpers->json(array(
                'status' => 'error',
                'data' => 'Login fallido'
                ));
        }
    }//pruebaresponsableAction


}//DefaultController
