<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City');
class temas extends CI_Controller{

  public function __construct(){
    parent::__construct();
    //Cargo el modelo del controlador
    $this->load->model('model_temas');
    $this->load->model('model_seguridad');
    $this->load->model('model_login');
  }

  function Seguridad(){
    $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $this->model_seguridad->SessionActivo($url);
  }

  public function index(){
    $this->Seguridad();
    $this->load->view('header');
    $data['temas'] = $this->model_temas->ListarTemas();
    $this->load->view('view_temas', $data);
    $this->load->view('footer');
  }

  public function nuevo(){
    $this->Seguridad();
  	$this->ValidaCampos();
  	if($this->form_validation->run() == TRUE){
      $notcod = $this->model_temas->BuscarLastCod() + 1;
      $TemasInsertar = $this->input->post();
      $TemasInsertar["temcod"] = $temcod;
      $this->model_temas->SaveTemas($TemasInsertar);
      redirect("temas?save=true");
    }else{
  	  $this->load->view('header');
  	  $this->load->view('view_nuevo_tema');
  	  $this->load->view('footer');
  	}
  }

  function ValidaCampos(){
    $this->form_validation->set_rules("temnom", "temnom", "trim|required");
  }

  public function editar($id = NULL){
    if ($id == NULL OR !is_numeric($id)){
			$data['Modulo']  = "Temas";
			$data['Error']   = "Error: El ID <strong>".$id."</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
			$this->load->view('header');
			$this->load->view('view_errors',$data);
			$this->load->view('footer');
			return;
		}
		if ($this->input->post()) {
      $this->ValidaCampos();
			if ($this->form_validation->run() == TRUE){
				$datos_update = $this->input->post();
				$id_insertado = $this->model_temas->edit($datos_update,$id);
				redirect('temas?update=true');        
			}else{
        $this->Nuevo();
			}
		}else{
			$data['datos_temas'] = $this->model_temas->BuscarID($id);
			if (empty($data['datos_temas'])){
				$data['Modulo'] = "Temas";
				$data['Error'] = "Error: El ID <strong>".$id."</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
				$this->load->view('header');
				$this->load->view('view_errors',$data);
				$this->load->view('footer');
			}else{
				$this->load->view('header');
				$this->load->view('view_nuevo_tema',$data);
				$this->load->view('footer');
			}
		}

	}
	public function eliminar($id = NULL){
		if ($id == NULL OR !is_numeric($id)){
			$data['Modulo']  = "Temas";
			$data['Error']   = "Error: El ID <strong>".$id."</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
			$this->load->view('header');
			$this->load->view('view_errors',$data);
			$this->load->view('footer');
			return;
		}
		if ($this->input->post()) {
			$id_eliminar = $this->input->post('ID');
			$boton = strtoupper($this->input->post('btn_guardar'));
			if($boton=="NO"){
				redirect("temas");
			}else{
        $this->model_temas->Eliminar($id_eliminar);
				redirect("temas?delete=true");
			}
		}else{
			$data['datos_temas'] = $this->model_temas->BuscarID($id);
			if (empty($data['datos_temas'])){
				$data['Modulo'] = "Temas";
				$data['Error'] = "Error: El ID <strong>".$id."</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
				$this->load->view('header');
				$this->load->view('view_errors',$data);
				$this->load->view('footer');
			}else{
				$this->load->view('header');
				$this->load->view('view_delete_temas',$data);
				$this->load->view('footer');
			}
		}
	}

  public function actualizarTemasNoticia($idNoticia){

  }
}
