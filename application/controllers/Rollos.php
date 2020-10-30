<?php
date_default_timezone_set('America/Mexico_City');
defined('BASEPATH') OR exit('No direct script access allowed');

class Rollos extends CI_Controller {

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
               $valores .= "<option selected value='" . $valor->id . "'>" . $valor->nombre . "</option>";
            else
               $valores .= "<option value='" . $valor->id . "'>" . $valor->nombre . "</option>";
        }
        return $valores;
	}
	
	public function crea_select_color($tabla, $id = null){
        $valores = "<option value=''>Selecciona</option>";
        $array =  $this->AM->all($tabla,'array');
        foreach ($array as $valor) {
            if ($id != null && $valor->id == $id)
               $valores .= "<option selected rel='".$valor->color_hex."' value='" . $valor->id . "'>" . $valor->nombre . "</option>";
            else
               $valores .= "<option rel='".$valor->color_hex."' value='" . $valor->id . "'>" . $valor->nombre . "</option>";
        }
        return $valores;
    }

	//Funcion de ver rollos en tabla
	public function index(){
		$data = $this->basicas();
		$data['rollos'] = $this->AM->all('vw_rollos','json');
		$data['colores'] = $this->crea_select_color('vw_colores');
		$this->load->view('rollos/rollos',$data);
		$this->load->view('rollos/rollos_js',$data);
		$this->load->view('footer',$data);
	}

	//Funcion para traer la vista de nuevo rollo
	public function nuevo(){
		$data = $this->basicas();
		$data['puestos'] = $this->crea_select('c_puestos');
		$this->load->view('rollos/nuevo_rollo',$data);
		$this->load->view('rollos/rollos_js');
		$this->load->view('footer',$data);
    }
    
    //Funcion para guadar los datos de un empleado
	public function save(){
        $_POST['fecha_creacion'] = date('Y-m-d H:i:s');
        $hrs = explode(':',$_POST['horas_proceso'])[0];
        $min = explode(':',$_POST['horas_proceso'])[1];
        $date1 = date('Y-m-d H:i:s', strtotime($_POST['fecha_creacion'] . ' + '.$hrs.' hours'));
        $date2 = date('Y-m-d H:i:s', strtotime($date1 . ' + '.$min.' minute'));
        $_POST['fecha_termino_potencial'] = $date2;
        $_POST['operador'] = '200';
		$res = $this->AM->insertar($_POST,'rollos');
		if($res['ban'])
			$this->codificar(array('ban'=>true,'msg'=>'Producción Iniciada'));
		else
			$this->codificar(array('ban'=>false,'msg'=>'Error al iniciar producción movimiento','error'=>$res['error']));
	}

	//Funcion para ver los datos de un empleado
	public function ver($ide=null){
		$data = $this->basicas();
		$condicion = array('id'=>$ide);
		$data['rollos'] = $this->AM->consulta_unica($condicion,'vw_rollos');
		$this->load->view('rollos/ver_rollos',$data);
		$this->load->view('rollos/rollos_js');
		$this->load->view('footer',$data);
	}

	//Funcion para activar o inactivar un empleado
	public function editar($ide=null){
        $data = $this->basicas();
		$condicion = array('id'=>$ide);
		$data['rollos'] = $this->AM->consulta_unica($condicion,'vw_rollos');
		$this->load->view('rollos/editar_rollos',$data);
		$this->load->view('rollos/rollos_js');
		$this->load->view('footer',$data);
    }
    
    public function actualizar($ide=null){
        $condicion = array('id'=>$ide);
        $data['halgodon'] = $_POST['halgodon'];
        $data['hlicra'] = $_POST['hlicra'];
        $data['halgodon_defecto'] = $_POST['halgodon_defecto'];
        $data['hlicra_defecto'] = $_POST['hlicra_defecto'];
        $data['observaciones'] = $_POST['observaciones'];

		$res = $this->AM->actualizar($condicion,$data,'rollos');
		if($res['ban'])
			$this->codificar(array('ban'=>true,'msg'=>'Rollo Actualizado'));
		else
			$this->codificar(array('ban'=>false,'mgs'=>'Error al actualizar información de rollos','error'=>$res['error']));
	}
	
	public function finalizar($id){
		$data = $this->basicas();
		$condicion = array('id'=>$id);
		$data['rollos'] = $this->AM->consulta_unica($condicion,'vw_rollos');
		$this->load->view('rollos/finalizar_rollos',$data);
		$this->load->view('rollos/rollos_js');
		$this->load->view('footer');
	}

	public function terminar($id){
		$condicion = array('id'=>$id);
		$_POST['fecha_termino'] = date('Y/m/d ').$_POST['fecha_termino'];
		$_POST['estatus_general_id'] = 13;
		$res = $this->AM->actualizar($condicion,$_POST,'rollos');
		if($res['ban'])
			$this->codificar(array('ban'=>true,'msg'=>'Producción Finalizada'));
		else
			$this->codificar(array('ban'=>false,'mgs'=>'Error al actualizar información de rollos','error'=>$res['error']));
	}

	public function save_envio(){
		$rollos = explode(',',$_POST['rollos']);
		$ban = false;


		for ($i=0; $i < count($rollos) ; $i++) { 
			$condicion = array('id'=>$rollos[$i]);
			$data['fec_envio_prov'] = $_POST['fec_envio_prov'];
			$data['num_tonga'] = $_POST['num_tonga'];
			$data['estatus_general_id'] = 14;
			$res = $this->AM->actualizar($condicion,$data,'rollos');
			if($res['ban'])
				$ban = true;
			else
				$ban=false;
		}
		if($ban)
			$this->codificar(array('ban'=>true,'msg'=>'Rollos Actualizados'));
		else
			$this->codificar(array('ban'=>false,'mgs'=>'Error al actualizar información de rollos','error'=>$res['error']));
	}

	public function save_entrada(){
		$colores = json_decode($_POST['colores']);
		$ban = false;
		$data['grupo_rollos'] = uniqid();
		foreach ($colores as $val) {
			$condicion = array('id'=>$val->id);
			$data['fec_entrega'] = $_POST['fec_entrega'];
			$data['fec_registro'] = date('Y-m-d h:i:s');
			$data['color_id_entregado'] = $val->color;
			$data['peso_entregado'] = $val->peso;
			$data['receptor'] = 200;
			$data['estatus_general_id'] = 15;
			$res = $this->AM->actualizar($condicion,$data,'rollos');
			if($res['ban'])
				$ban = true;
			else
				$ban=false;
		}
		if($ban)
			$this->codificar(array('ban'=>true,'msg'=>'Rollos Actualizados'));
		else
			$this->codificar(array('ban'=>false,'mgs'=>'Error al actualizar información de rollos','error'=>$res['error']));
	}


}
