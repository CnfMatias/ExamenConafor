<?php
date_default_timezone_set('America/Mexico_City');
defined('BASEPATH') OR exit('No direct script access allowed');

class Accesos extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Api_model','AM',true);
		$this->load->library('componentes');
		$this->load->helper(array('form', 'url'));
	}

	private function codificar($arr){
		echo json_encode($arr);
	}

	//Carga de componentes basicas
	private function basicas(){
		$data['logo'] = $this->componentes->logo();
		$data['boton_menu'] = $this->componentes->boton_menu();
		$data['ajustes_perfil'] = $this->componentes->ajustes_perfil();
		$this->load->view('header');
		$this->load->view('menu',$data);
		$this->load->view('funciones');
		return $data;
	}


	//Funcion de ver accesos en tabla
	public function index(){
		$data = $this->basicas();
		//$data['cliente_nom'] = $this->crea_select('clientes');
		$data['accesos'] = $this->AM->all('accesos','json');
		$this->load->view('accesos/accesos',$data);
		//$this->load->view('accesos/accesos_js');
		$this->load->view('footer',$data);
	}

	

}