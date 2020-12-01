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
	//Funcion para crear select de los estados y municipios
	public function crea_select_array($array,$id=null){
		$valores = "<option value=''>Selecciona</option>";
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
		$data['clientes'] = $this->AM->all('vw_clientes','json');
		$this->load->view('clientes/clientes',$data);
		$this->load->view('clientes/clientes_js');
		$this->load->view('footer',$data);
	}

	//Funcion para traer la vista de nuevo cliente
	public function nuevo(){
		$data = $this->basicas();
		$data['estados'] = $this->crea_select('vw_estados');
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
		$estado_id = $data['cliente']->cve_ent;
		$data['estados_id'] = $this->crea_select('vw_estados',$estado_id);
		$municipio_id = $data['cliente']->cve_mun;
		$condicion = array('cve_ent' => $estado_id,'id'=>$municipio_id);
		$data['municipios_id'] = $this->crea_select_array($this->AM->consulta($condicion,'vw_municipios'),$municipio_id);
		$this->load->view('clientes/clientes_js');
		$this->load->view('clientes/ver_cliente',$data);
		$this->load->view('footer',$data);
	}

	//Funcion para cargar la vista de edicion de un cliente
	public function editar($ide=null){
		$data = $this->basicas();
		$condicion = array('id'=>$ide);
		$data['cliente'] = $this->AM->consulta_unica($condicion,'vw_clientes');
		var_dump($data['cliente']);
		$estado_id = $data['cliente']->cve_ent;
		$data['estados_id'] = $this->crea_select('vw_estados',$estado_id);
		$municipio_id = $data['cliente']->cve_mun;
		$condicion = array('cve_ent' => $estado_id,'id'=>$municipio_id);
		$data['municipios_id'] = $this->crea_select_array($this->AM->consulta($condicion,'vw_municipios'),$municipio_id);
		$publicidad_id = $data['cliente']->publicidad_id;
		$data['publicidad'] = $this->crea_select('c_publicidad',$publicidad_id);
		$condicion = array('id'=>$ide);
		$data['cliente'] = $this->AM->consulta_unica($condicion,'vw_clientes');
		$this->load->view('clientes/editar_cliente',$data);
		$this->load->view('clientes/clientes_js');
		$this->load->view('footer',$data);
	}

	//Funcion para guadar los datos de un cliente
	public function save(){
		//Pasos para guardar cliente
		$condicion = array('estado_id'=>$_POST['estado_id']);
		$_POST['folio_cliente'] = $this->AM->consulta_unica($condicion,'vw_folio_clientes')->folio;
		$tels['tel'] = $_POST['tel'];
		$tels['cel'] = $_POST['cel'];
		unset($_POST['direccion_api']);
		unset($_POST['tel']);
		unset($_POST['cel']);
		$_POST['usuario_registro'] = 200;
		$_POST['fecha_registro'] = date('Y-m-d H:i:s');
		//Ejecutar función para insertar clientes quitando del POST los telefonos
		$res = $this->AM->insertar($_POST,'clientes');
		if($res['ban']){
			$tels['cliente_id'] = $res['id'];
			$tels['usuario_registro'] = 200;
			$tels['fecha_registro'] = date('Y-m-d H:i:s');
			$res2 = $this->AM->insertar($tels,'r_cliente_tel');
			if($res2['ban']){
				$this->codificar(array('ban'=>true,'msg'=>'Cliente creado'));
			}
		}
		else{
			$this->codificar(array('ban'=>false,'msg'=>'Error al guardar cliente','error'=>$res['error']));
		}
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
			$tels['tel'] = $_POST['tel'];
			$tels['cel'] = $_POST['cel'];
			unset($_POST['direccion_api']);
			unset($_POST['tel']);
			unset($_POST['cel']);
			$tels['cliente_id'] = $_POST['id'];
			$tels['usuario_registro'] = 200;
			$tels['fecha_registro'] = date('Y-m-d H:i:s');
			$res2 = $this->AM->insertar($tels,'r_cliente_tel');
			if($res2['ban']){
				unset($_POST['id']);
				$res = $this->AM->actualizar($condicion,$_POST,'clientes');
				if($res['ban'])
					$this->codificar(array('ban'=>true,'msg'=>'cliente Actualizado'));
				else
					$this->codificar(array('ban'=>false,'mgs'=>'Error al actualizar cliente','error'=>$res['error']));
			}
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

	public function municipios_get(){
		$condicion = array('cve_ent'=>$_POST['cve_ent']);
		echo $this->crea_select_array($this->AM->consulta($condicion,'vw_municipios'));
	}

}

