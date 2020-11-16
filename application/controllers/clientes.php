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
		//$data['clientes'] = $this->crea_select('clientes');
		//$data['empleado'] = $this->crea_select('empleados');
		$data['estados'] = $this->crea_select('c_estados');
		$data['municipios'] = $this->crea_select('cat_municipio');
		$data['publicidad'] = $this->crea_select('c_publicidad');
		$this->load->view('clientes/nuevo_cliente',$data);
		$this->load->view('clientes/clientes_js');
		$this->load->view('footer',$data);
	}

	//Funcion para ver los datos de un cliente
	public function ver($ide=null){
		$data = $this->basicas();
		$condicion = array('id'=>$ide);
		$data['cliente'] = $this->AM->consulta_unica($condicion,'vw_clientes');
		$this->load->view('clientes/ver_cliente',$data);
		$this->load->view('clientes/clientes_js');
		$this->load->view('footer',$data);
	}

	//Funcion para cargar la vista de edicion de un cliente
	public function editar($ide=null){
		$data = $this->basicas();
		$data['estados'] = $this->crea_select('c_estados');
		$data['publicidad'] = $this->crea_select('c_publicidad');
		//$data['municipios'] = $this->crea_select('cat_municipio');
		$condicion = array('id'=>$ide);
		$data['cliente'] = $this->AM->consulta_unica($condicion,'clientes');
		$this->load->view('clientes/editar_cliente',$data);
		$this->load->view('clientes/clientes_js');
		$this->load->view('footer',$data);
	}

	//Funcion para guadar los datos de un cliente
	public function save(){
		//Pasos para guardar cliente
		//Ejecutar función para generar folio de cliente
		//Ejecutar función para insertar clientes quitando del POST los telefonos 
		//Obtener el id del cliente insertado 
		//Utilizar id de cliente e insertar los telefonos en la tabla r_clientes_tel (insertar usuario creador y fecha creación)
	
			$res = $this->AM->insertar($_POST,'clientes');
			if($res['ban'])
				$this->codificar(array('ban'=>true,'msg'=>'cliente Creado'));
			else
				$this->codificar(array('ban'=>false,'msg'=>'Error al guardar cliente','error'=>$res['error']));

	
	}

	//Funcion para activar o inactivar un cliente
	public function activar(){
		$condicion = $_POST['condicion'];
		$datos = $_POST['datos'];
		if($this->AM->actualizar($condicion,$datos,'clientes')){
			$this->codificar(array('ban'=>true,'msg'=>'Cambio aplicado'));
		}
		else
			$this->codificar(array('ban'=>false,'msg'=>'Cambios No aplicados'));
	}

	//Funcion para actualizar datos de un cliente
	public function actualizar(){
			$condicion = array('id'=>$_POST['id']);
			unset($_POST['id']);
			$res = $this->AM->actualizar($condicion,$_POST,'clientes');
			if($res['ban'])
				$this->codificar(array('ban'=>true,'msg'=>'cliente Actualizado'));
			else
				$this->codificar(array('ban'=>false,'mgs'=>'Error al actualizar cliente','error'=>$res['error']));
	


	}

	//Funcion para eliminar un cliente
	public function eliminar($id){
		$condicion = array('id'=>$id);
		if($this->AM->eliminar($condicion,'clientes')){
			$this->codificar(array('ban'=>true,'msg'=>'cliente Eliminado'));
		}
		else
			$this->codificar(array('ban'=>false,'msg'=>'Error'));
	}

}

