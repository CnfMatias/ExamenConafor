<?php
date_default_timezone_set('America/Mexico_City');
defined('BASEPATH') OR exit('No direct script access allowed');

class Tecnicos extends CI_Controller {

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

	//Funcion de ver tecnicos en tabla
	public function index(){
		$data = $this->basicas();
		//$data['tecnicos'] = $this->AM->all('tecnicos','json');
		$data['tecnicos'] = $this->AM->all('vw_tecnicos','json');
		$this->load->view('tecnicos/tecnicos',$data);
		$this->load->view('tecnicos/tecnicos_js');
		$this->load->view('footer',$data);
	}

	//Funcion para traer la vista de nuevo tecnico
	public function nuevo(){
		$data = $this->basicas();
		$data['empleado'] = $this->crea_select('empleados');
		$data['estatus_genera_id']= $this->crea_select('c_estatus_general');
		$this->load->view('tecnicos/nuevo_tecnico',$data);
		$this->load->view('tecnicos/tecnicos_js');
		$this->load->view('footer',$data);
	}

	//Funcion para ver los datos de un tecnico
	public function ver($ide=null){
		$data = $this->basicas();
		$data['nombre'] = $this->crea_select('empleados');
		$condicion = array('id'=>$ide);
		$data['tecnico'] = $this->AM->consulta_unica($condicion,'vw_tecnicos');
		$this->load->view('tecnicos/ver_tecnico',$data);
		$this->load->view('tecnicos/tecnicos_js');
		$this->load->view('footer',$data);
	}

	//Funcion para cargar la vista de edicion de un tecnico
	public function editar($ide=null){
        $data = $this->basicas();
        $data['empleado'] = $this->crea_select('empleados');
		//$data['perfiles'] = $this->crea_select('c_perfiles');
		//$data['sueldos'] = $this->crea_select('c_sueldos');
		$condicion = array('id'=>$ide);
		$data['tecnico'] = $this->AM->consulta_unica($condicion,'tecnicos');
		$this->load->view('tecnicos/editar_tecnico',$data);
		$this->load->view('tecnicos/tecnicos_js');
		$this->load->view('footer',$data);
	}

	//Funcion para guadar los datos de un tecnico
	public function save(){
		//cargamos configuraciones
		$config['upload_path'] = './frontend/emps/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1000;
		$config['file_name'] = md5(date('Y-m-d h:i:s'));
		//Cragamos libreria necesaria
		$this->load->library('upload', $config);
		//verificamos la carga del archivo
		/*if($this->upload->do_upload('foto_tecnico')){
			$_POST['foto_emp'] = $this->upload->data()['file_name'];*/
			$res = $this->AM->insertar($_POST,'tecnicos');
			if($res['ban'])
				$this->codificar(array('ban'=>true,'msg'=>'tecnico Creado'));
			else
				$this->codificar(array('ban'=>false,'msg'=>'Error al guardar tecnico','error'=>$res['error']));
	/*	}
		else{
			$this->codificar(array('ban'=>false,'msg'=>'Es necesaria foto para el tecnico','error'=>$this->upload->display_errors()));
		}*/
	
	}

	//Funcion para activar o inactivar un tecnico
	public function activar(){
		$condicion = $_POST['condicion'];
		$datos = $_POST['datos'];
		if($this->AM->actualizar($condicion,$datos,'tecnicos')){
			$this->codificar(array('ban'=>true,'msg'=>'Cambio aplicado'));
		}
		else
			$this->codificar(array('ban'=>false,'msg'=>'Cambios No aplicados'));
	}

	//Funcion para actualizar datos de un tecnico
	public function actualizar(){
		//cargamos configuraciones
		$condicion = array('id'=>$_POST['id']);
			$res = $this->AM->actualizar($condicion,$_POST,'tecnicos');
			if($res['ban'])
				$this->codificar(array('ban'=>true,'msg'=>'Tecnico Actualizado'));
			else
				$this->codificar(array('ban'=>false,'mgs'=>'Error al actualizar Cliente','error'=>$res['error']));

	}

	//Funcion para eliminar un tecnico
	public function eliminar($id){
		$condicion = array('id'=>$id);
		if($this->AM->eliminar($condicion,'tecnicos')){
			$this->codificar(array('ban'=>true,'msg'=>'tecnico Eliminado'));
		}
		else
			$this->codificar(array('ban'=>false,'msg'=>'Error'));
	}

}
