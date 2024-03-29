<?php
namespace AppBundle\Services;

class Helpers{
	public $manager;
	public function __construct($manager){
		$this->manager = $manager;
	}



	public function json($data){
		$normalizers = array(new \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer());
		$encoders = array("json" => new \Symfony\Component\Serializer\Encoder\JsonEncoder());
		$serializer = new \Symfony\Component\Serializer\Serializer($normalizers, $encoders);
		$json = $serializer->serialize($data, 'json');
		$response = new \Symfony\Component\HttpFoundation\Response();
		$response-> setContent($json);
		$response->headers->set('Content-Type','application/json',"Access-Control-Allow-Origin");
		$response->headers->set('Access-Control-Allow-Origin', '*');

		return $response;
	}
}