<?php
date_default_timezone_set('America/Mexico_City');
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

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
        $array = $this->AM->all($tabla,'array');
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
		$data['usuarios'] = $this->AM->all('vw_usuarios','json');
		$data['empleados'] = $this->AM->all('vw_empleados_sin_usuario','json');
		$this->load->view('usuarios/usuarios',$data);
		$this->load->view('usuarios/usuarios_js');
		$this->load->view('footer',$data);
	}
	//Funcion para traer la vista de nuevo empleado
	public function nuevo(){
		$data = $this->basicas();
		$data['empleados'] = $this->AM->all('vw_empleados_sin_usuario','json');
		$this->load->view('usuarios/nuevo_usuario',$data);
		$this->load->view('usuarios/usuarios_js');
		$this->load->view('footer',$data);
    }
    //funcion para buscar empleados en la asignacion
    public function buscar_empleado(){
        $condicion = $_POST['condicion'];
        $data['empleado'] = $this->AM->consulta_unica($condicion,'empleados');
        echo json_encode($data);
	}
	
	//Funcion para guadar los datos de un empleado
	public function save($num_emp){
		$_POST['num_empleado'] = $num_emp;
		unset($_POST['pass_conf']);
		unset($_POST['perfil']);
		$_POST['password'] = md5($_POST['password']);
		//var_dump($_POST);
		$res = $this->AM->insertar($_POST,'usuarios');
		if($res['ban'])
			$this->codificar(array('ban'=>true,'msg'=>'Usuario Creado'));
		else
			$this->codificar(array('ban'=>false,'msg'=>'Error al crear el usuario','error'=>$res['error']));
	}

	//Funcion para ver los datos de un usuario
	public function ver($ide=null){
		$data = $this->basicas();
		$condicion = array('id'=>$ide);
		$data['usuario'] = $this->AM->consulta_unica($condicion,'vw_usuarios');
		$data['empleados'] = json_encode('{}');
		$this->load->view('usuarios/ver_usuario',$data);
		$this->load->view('usuarios/usuarios_js');
		$this->load->view('footer',$data);
	}

	//Funcion para activar o inactivar un empleado
	public function activar(){
		$condicion = $_POST['condicion'];
		$datos = $_POST['datos'];
		if($this->AM->actualizar($condicion,$datos,'usuarios')){
			$this->codificar(array('ban'=>true,'msg'=>'Cambio aplicado'));
		}
		else
			$this->codificar(array('ban'=>false,'msg'=>'Cambios No aplicados','error'=>$res['error']));
	}

	//Funcion para eliminar un empleado
	public function eliminar($id){
		$condicion = array('id'=>$id);
		if($this->AM->eliminar($condicion,'usuarios')){
			$this->codificar(array('ban'=>true,'msg'=>'Usuario Eliminado'));
		}
		else
			$this->codificar(array('ban'=>false,'msg'=>$res['error']));
	}

	public function actualizar(){
		$condicion = "usuario='".$_POST['usuario']."'";
		$datos = array("password"=>md5($_POST['password']));
		if($this->AM->actualizar($condicion,$datos,'usuarios')){
			$this->codificar(array('ban'=>true,'msg'=>'Cambio aplicado'));
		}
		else
			$this->codificar(array('ban'=>false,'msg'=>'Cambios No aplicados','error'=>$res['error']));
	}

}
