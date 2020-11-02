<?php
date_default_timezone_set('America/Mexico_City');
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados extends CI_Controller {

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

	//Funcion de ver empleados en tabla
	public function index(){
		$data = $this->basicas();
		$data['empleados'] = $this->AM->all('empleados','json');
		$this->load->view('empleados/empleados',$data);
		$this->load->view('empleados/empleados_js');
		$this->load->view('footer',$data);
	}

	//Funcion para traer la vista de nuevo empleado
	public function nuevo(){
		$data = $this->basicas();
		$data['perfiles'] = $this->crea_select('c_perfiles', 1);
		$data['sueldos'] = $this->crea_select('c_sueldos', 1);
		$data['estatus_genera_id']= $this->crea_select('c_estaus_general', 1);
		$this->load->view('empleados/nuevo_empleado',$data);
		$this->load->view('empleados/empleados_js');
		$this->load->view('footer',$data);
	}

	//Funcion para ver los datos de un empleado
	public function ver($ide=null){
		$data = $this->basicas();
		//$data['puestos'] = $this->crea_select('c_perfiles');
		$condicion = array('id'=>$ide);
		$data['empleado'] = $this->AM->consulta_unica($condicion,'empleados');
		$this->load->view('empleados/ver_empleado',$data);
		$this->load->view('empleados/empleados_js');
		$this->load->view('footer',$data);
	}

	//Funcion para cargar la vista de edicion de un empleado
	public function editar($ide=null){
		$data = $this->basicas();
		$data['perfiles'] = $this->crea_select('c_perfiles');
		$data['sueldos'] = $this->crea_select('c_sueldos');
		$condicion = array('id'=>$ide);
		$data['empleado'] = $this->AM->consulta_unica($condicion,'empleados');
		$this->load->view('empleados/editar_empleado',$data);
		$this->load->view('empleados/empleados_js');
		$this->load->view('footer',$data);
	}

	//Funcion para guadar los datos de un empleado
	public function save(){
		//cargamos configuraciones
		$config['upload_path'] = './frontend/emps/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1000;
		$config['file_name'] = md5(date('Y-m-d h:i:s'));
		//Cragamos libreria necesaria
		$this->load->library('upload', $config);
		//verificamos la carga del archivo
		/*if($this->upload->do_upload('foto_empleado')){
			$_POST['foto_emp'] = $this->upload->data()['file_name'];*/
			$res = $this->AM->insertar($_POST,'empleados');
			if($res['ban'])
				$this->codificar(array('ban'=>true,'msg'=>'Empleado Creado'));
			else
				$this->codificar(array('ban'=>false,'msg'=>'Error al guardar empleado','error'=>$res['error']));
	/*	}
		else{
			$this->codificar(array('ban'=>false,'msg'=>'Es necesaria foto para el empleado','error'=>$this->upload->display_errors()));
		}*/
	
	}

	//Funcion para activar o inactivar un empleado
	public function activar(){
		$condicion = $_POST['condicion'];
		$datos = $_POST['datos'];
		if($this->AM->actualizar($condicion,$datos,'empleados')){
			$this->codificar(array('ban'=>true,'msg'=>'Cambio aplicado'));
		}
		else
			$this->codificar(array('ban'=>false,'msg'=>'Cambios No aplicados'));
	}

	//Funcion para actualizar datos de un empleado
	public function actualizar(){
		//cargamos configuraciones
		$config['upload_path'] = './frontend/emps/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1000;
		$config['file_name'] = md5(date('Y-m-d h:i:s'));
		//Cragamos libreria necesaria
		$this->load->library('upload', $config);
		//verificamos la carga del archivo
		if($this->upload->do_upload('foto_empleado')){
			$_POST['foto_emp'] = $this->upload->data()['file_name'];
			$condicion = array('id'=>$_POST['id']);
			unset($_POST['id']);
			$res = $this->AM->actualizar($condicion,$_POST,'empleados');
			if($res['ban'])
				$this->codificar(array('ban'=>true,'msg'=>'Empleado Actualizado'));
			else
				$this->codificar(array('ban'=>false,'mgs'=>'Error al actualizar empleado','error'=>$res['error']));
		}
		else{
			$condicion = array('id'=>$_POST['id']);
			unset($_POST['id']);
			$res = $this->AM->actualizar($condicion,$_POST,'empleados');
			if($res['ban'])
				$this->codificar(array('ban'=>true,'msg'=>'Empleado Actualizado'));
			else
				$this->codificar(array('ban'=>false,'msg'=>'Error al actualizar empleado','error'=>$res['error']));
		}

	}

	//Funcion para eliminar un empleado
	public function eliminar($id){
		$condicion = array('id'=>$id);
		if($this->AM->eliminar($condicion,'empleados')){
			$this->codificar(array('ban'=>true,'msg'=>'Empleado Eliminado'));
		}
		else
			$this->codificar(array('ban'=>false,'msg'=>'Error'));
	}

}
