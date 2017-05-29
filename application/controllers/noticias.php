<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City');
class noticias extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('model_noticias');
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
    $data['noticias'] = $this->model_noticias->ListarNoticias();
    $this->load->view('view_noticias', $data);
    $this->load->view('footer');
  }

  public function nuevo(){
    $this->Seguridad();
  	$this->ValidaCampos();
  	if($this->form_validation->run() == TRUE){
      $notcod = $this->model_noticias->BuscarLastCod() + 1;
      $NoticiasInsertar = $this->input->post();
      $NoticiasInsertar["notcod"] = $notcod;
      $this->model_noticias->SaveNoticias($NoticiasInsertar);
      $myArray = explode(',', $NoticiasInsertar['temas']);
      $this->model_noticias->updateTemaNoticia($notcod, $myArray);
      redirect("noticias?save=true");
    }else{
  	  $this->load->view('header');
      $data['datos_listatemas'] = $this->model_noticias->TemasNotiNueva();
  	  $this->load->view('view_nuevo_noticia',$data);
  	  $this->load->view('footer');
  	}
  }

  function ValidaCampos(){
    $this->form_validation->set_rules("nottit", "nottit", "trim|required");
    $this->form_validation->set_rules("notenc", "notenc", "trim|required");
    $this->form_validation->set_rules("notbod", "notbod", "trim|required");
    $this->form_validation->set_rules("notfec", "notfec", "trim|required");
  }

  public function editar($id = NULL){
    if ($id == NULL OR !is_numeric($id)){
			$data['Modulo']  = "Noticias";
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
				$id_insertado = $this->model_noticias->edit($datos_update,$id);
        $myArray = explode(',', $datos_update['temas']);
        $this->model_noticias->updateTemaNoticia($id, $myArray);
				redirect('noticias?update=true');
			}else{
        $this->Nuevo();
			}
		}else{
			$data['datos_noticias'] = $this->model_noticias->BuscarID($id);
      $data['datos_temas'] = $this->model_noticias->ListarTemasNoticias($id);
      $data['datos_listatemas'] = $this->model_noticias->MostrarTemas($id);
			if (empty($data['datos_noticias'])){
				$data['Modulo'] = "Noticias";
				$data['Error'] = "Error: El ID <strong>".$id."</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
				$this->load->view('header');
				$this->load->view('view_errors',$data);
				$this->load->view('footer');
			}else{
				$this->load->view('header');
				$this->load->view('view_nuevo_noticia',$data);
				$this->load->view('footer');
			}
		}

	}
	public function eliminar($id = NULL){
		if ($id == NULL OR !is_numeric($id)){
			$data['Modulo']  = "Noticias";
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
				redirect("noticias");
			}else{
        $this->model_noticias->Eliminar($id_eliminar);
				redirect("noticias?delete=true");
			}
		}else{
			$data['datos_noticias'] = $this->model_noticias->BuscarID($id);
			if (empty($data['datos_noticias'])){
				$data['Modulo']  = "Noticias";
				$data['Error']   = "Error: El ID <strong>".$id."</strong> No es Valido, Verifica tu Busqueda !!!!!!!";
				$this->load->view('header');
				$this->load->view('view_errors',$data);
				$this->load->view('footer');
			}else{
				$this->load->view('header');
				$this->load->view('view_delete_noticias',$data);
				$this->load->view('footer');
			}
		}
	}
}
