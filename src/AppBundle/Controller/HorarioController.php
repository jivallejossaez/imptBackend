<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use BackendBundle\Entity\Horario;
use BackendBundle\Entity\Laboratorio;
use AppBundle\Services\Helpers;
use AppBundle\Services\JwtAuth;

class HorarioController extends Controller{
  public function generateAction(Request $request){
    $helpers = $this->get(Helpers::class);
		$jwt_auth = $this->get(JwtAuth::class);
    $valor = $request->get('valor',null);
    $fechas = array('2017-11-20','2017-11-21','2017-11-22','2017-11-23','2017-11-24');
    $horas = array('08:10','09:50','11:30','14:10','15:50','17:30');
    $em = $this->getDoctrine()->getManager();
    for ($i=1; $i <=6 ; $i++) {
      $laboratorio = $em->getRepository('BackendBundle:Laboratorio')->findOneBy(array('idLaboratorio' =>$i));
      foreach ($horas as $hora){
        foreach ($fechas as $dia) {
          $horario = new Horario();
          $horario->setDia($dia);
          $horario->setHora($hora);
          $horario->setBorrado(0);
          $horario->setRefLaboratorio($laboratorio);
          $em->persist($horario);
					$em->flush();
        }
      }
    }
    $data = array(
      'mensaje' => 'Se crearon exitosamente los horarios');
    return $helpers->json($data);
  }




  public function listAction(Request $request){
    $helpers = $this->get(Helpers::class);
		$jwt_auth = $this->get(JwtAuth::class);
		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkTokenusuario($token);
		if($authCheck){
			$em = $this->getDoctrine()->getManager();
      $horarios =  $em->getRepository('BackendBundle:Horario')->findAll();
			$data = array(
				'data' => $horarios
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




}
