<?php
date_default_timezone_set('America/Mexico_City');
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuraciones extends CI_Controller {

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

	//Funcion inicial
	public function index(){
		$data = $this->basicas();
		$this->load->view('configuraciones/configuraciones');
		$this->load->view('footer',$data);
    }
    
    public function catalogos(){
        $data = $this->basicas();
		$this->load->view('configuraciones/catalogos');
		$this->load->view('footer',$data);
    }

    public function get_cat($tabla){
        $res['ban'] = false;
        $res['data'] = $this->AM->all($tabla,'array');
        if(count($res['data'])>0){
            $res['ban'] =  true;
        }
        else{
            $res['msg'] = 'No hay registros en la base';
        }
        echo json_encode($res);
	}

	public function nuevo_catalogo(){
		//var_dump($_POST);
		$tabla = $_POST['tabla'];
		if(isset($_POST['monto']))
			$_POST['monto'] = str_replace(',','',$_POST['monto']);
		unset($_POST['tabla']);
		$res = $this->AM->insertar($_POST,$tabla);
			if($res['ban'])
				$this->codificar(array('ban'=>true,'msg'=>'Registro Creado'));
			else
				$this->codificar(array('ban'=>false,'msg'=>'Error al guardar el registro','error'=>$res['error']));
	}
	
	public function save_catalogos($tabla){
		//var_dump($_POST);
		$condicion = array('id'=>$_POST['id']);
		switch ($tabla) {
			case 'vw_puestos':
				$_POST['nombre'] = $_POST['puesto'];
				$_POST['tipo_ingreso'] = ($_POST['ingreso'] == 'Sueldo')?1:2;
				$_POST['activo'] = (strtolower($_POST['activo']) == 'activo')?1:0;
				$_POST['monto'] = $_POST['s/c'];
				unset($_POST['id']);
				unset($_POST['puesto']);
				unset($_POST['ingreso']);
				unset($_POST['s/c']);
				$res = $this->AM->actualizar($condicion,$_POST,'c_puestos');
			break;
			case 'vw_tipo_proveedor':
				$_POST['nombre'] = $_POST['tipo'];
				$_POST['estatus'] = (strtolower($_POST['estatus']) == 'activo')?1:0;
				unset($_POST['tipo']);
				unset($_POST['id']);
				//var_dump($_POST);
				$res = $this->AM->actualizar($condicion,$_POST,'c_tipo_proveedores');
			break;
			case 'vw_productos_servicios':
				$_POST['estatus'] = (strtolower($_POST['estatus']) == 'activo')?1:0;
				unset($_POST['id']);
				$res = $this->AM->actualizar($condicion,$_POST,'c_productos_servicios');
			break;
			case 'vw_tipo_pago':
				$_POST['estatus'] = (strtolower($_POST['estatus']) == 'activo')?1:0;
				unset($_POST['id']);
				$res = $this->AM->actualizar($condicion,$_POST,'c_tipo_pago');
			break;
			case 'vw_metodos_pago':
				$_POST['estatus'] = (strtolower($_POST['estatus']) == 'activo')?1:0;
				unset($_POST['id']);
				$res = $this->AM->actualizar($condicion,$_POST,'c_metodos_pago');
			break;
			case 'vw_colores':
				$_POST['estatus'] = (strtolower($_POST['estatus']) == 'activo')?1:0;
				unset($_POST['id']);
				$res = $this->AM->actualizar($condicion,$_POST,'c_colores');
			break;
		}
		if($res['ban'])
			$this->codificar(array('ban'=>true,'msg'=>'Datos Actualizados'));
		else
			$this->codificar(array('ban'=>false,'msg'=>'Error al actualizar la información','error'=>$res['error']));
	}

	public function eliminar(){
		$condicion = array('id'=>$_POST['id']);
		switch ($_POST['tabla']) {
			case 'vw_puestos':
				$res = $this->AM->eliminar($condicion,'c_puestos');
			break;
			case 'vw_tipo_proveedor':
				$res = $this->AM->eliminar($condicion,'c_tipo_proveedores');
			break;
			case 'vw_productos_servicios':
				$res = $this->AM->eliminar($condicion,'c_productos_servicios');
			break;
			case 'vw_tipo_pago':
				$res = $this->AM->eliminar($condicion,'c_tipo_pago');
			break;
			case 'vw_metodos_pago':
				$res = $this->AM->eliminar($condicion,'c_metodos_pago');
			break;
			case 'vw_colores':
				$res = $this->AM->eliminar($condicion,'c_colores');
			break;
		}
		if($res){
			$this->codificar(array('ban'=>true,'msg'=>'Registro Eliminado'));
		}
		else
			$this->codificar(array('ban'=>false,'msg'=>$res['error']));
	}
}