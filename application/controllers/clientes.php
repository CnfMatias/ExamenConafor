<?php
date_default_timezone_set('America/Mexico_City');
defined('BASEPATH') OR exit('No direct script access allowed');

class clientes extends CI_Controller {

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

	//Funcion para crear select para las consultas
    public function crea_select($tabla, $id = null){
        $valores = "<option value=''>Selecciona</option>";
        $array =  $this->AM->all($tabla,'array');
        foreach ($array as $valor) {
            if ($id != null && $valor->id == $id)
               $valores .= '<option selected value="' . $valor->id . '">' . $valor->nombre . '</option>';
            else
               $valores .= '<option value="' . $valor->id . '">' . $valor->nombre . '</option>';
        }
        return $valores;
    }

	//Funcion de ver clientes en tabla
	public function index(){
		$data = $this->basicas();
		$data['clientes'] = $this->AM->all('clientes','json');
		$this->load->view('clientes/clientes',$data);
		$this->load->view('clientes/clientes_js');
		$this->load->view('footer',$data);
	}

	//Funcion para traer la vista de nuevo cliente
	public function nuevo(){
		$data = $this->basicas();
		//$data['puestos'] = $this->crea_select('c_puestos');
		$this->load->view('clientes/nuevo_clientes',$data);
		$this->load->view('clientes/clientes_js');
		$this->load->view('footer',$data);
	}

	//Funcion para ver los datos de un clientes
	public function ver($ide=null){
		$data = $this->basicas();
		$data['puestos'] = $this->crea_select('c_puestos');
		$condicion = array('id'=>$ide);
		$data['clientes'] = $this->AM->consulta_unica($condicion,'clientes');
		$this->load->view('clientes/ver_clientes',$data);
		$this->load->view('clientes/clientes_js');
		$this->load->view('footer',$data);
	}

	//Funcion para cargar la vista de edicion de un clientes
	public function editar($ide=null){
		$data = $this->basicas();
		$data['puestos'] = $this->crea_select('c_puestos');
		$condicion = array('id'=>$ide);
		$data['clientes'] = $this->AM->consulta_unica($condicion,'clientes');
		$this->load->view('clientes/editar_clientes',$data);
		$this->load->view('clientes/clientes_js');
		$this->load->view('footer',$data);
	}

	//Funcion para guadar los datos de un clientes
	public function save(){
		//cargamos configuraciones
		$config['upload_path'] = './frontend/emps/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1000;
		$config['file_name'] = md5(date('Y-m-d h:i:s'));
		//Cragamos libreria necesaria
		$this->load->library('upload', $config);
		//verificamos la carga del archivo
		/*if($this->upload->do_upload('foto_clientes')){
			$_POST['foto_emp'] = $this->upload->data()['file_name'];*/
			$res = $this->AM->insertar($_POST,'clientes');
			if($res['ban'])
				$this->codificar(array('ban'=>true,'msg'=>'Clientes Creado'));
			else
				$this->codificar(array('ban'=>false,'msg'=>'Error al guardar clientes','error'=>$res['error']));
	/*	}
		else{
			$this->codificar(array('ban'=>false,'msg'=>'Es necesaria foto para el clientes','error'=>$this->upload->display_errors()));
		}*/
	
	}

	//Funcion para activar o inactivar un clientes
	public function activar(){
		$condicion = $_POST['condicion'];
		$datos = $_POST['datos'];
		if($this->AM->actualizar($condicion,$datos,'clientes')){
			$this->codificar(array('ban'=>true,'msg'=>'Cambio aplicado'));
		}
		else
			$this->codificar(array('ban'=>false,'msg'=>'Cambios No aplicados'));
	}

	//Funcion para actualizar datos de un clientes
	public function actualizar(){
		//cargamos configuraciones
		$config['upload_path'] = './frontend/emps/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1000;
		$config['file_name'] = md5(date('Y-m-d h:i:s'));
		//Cragamos libreria necesaria
		$this->load->library('upload', $config);
		//verificamos la carga del archivo
		if($this->upload->do_upload('foto_clientes')){
			$_POST['foto_emp'] = $this->upload->data()['file_name'];
			$condicion = array('id'=>$_POST['id']);
			unset($_POST['id']);
			$res = $this->AM->actualizar($condicion,$_POST,'clientes');
			if($res['ban'])
				$this->codificar(array('ban'=>true,'msg'=>'Cliente Actualizado'));
			else
				$this->codificar(array('ban'=>false,'mgs'=>'Error al actualizar Cliente','error'=>$res['error']));
		}
		else{
			$condicion = array('id'=>$_POST['id']);
			unset($_POST['id']);
			$res = $this->AM->actualizar($condicion,$_POST,'clientes');
			if($res['ban'])
				$this->codificar(array('ban'=>true,'msg'=>'Cliente Actualizado'));
			else
				$this->codificar(array('ban'=>false,'msg'=>'Error al actualizar cliente','error'=>$res['error']));
		}

	}

	//Funcion para eliminar un Clientes
	public function eliminar($id){
		$condicion = array('id'=>$id);
		if($this->AM->eliminar($condicion,'clientes')){
			$this->codificar(array('ban'=>true,'msg'=>'Cliente Eliminado'));
		}
		else
			$this->codificar(array('ban'=>false,'msg'=>'Error'));
	}

}
