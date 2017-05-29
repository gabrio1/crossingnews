<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City');
class newsletter extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('model_newsletter');
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
    $this->load->view('view_nuevo_newsletter');
    $this->load->view('footer');
  }

  public function GenerarNewsletter(){
    $this->Seguridad();
    $url = $_SERVER['REQUEST_URI'];
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    $data['datanewsletter'] = $this->model_newsletter->GenerarNewsletter($query['fecha']);
    $this->load->view('header');
    $this->load->view('view_newsletter_list',$data);
    $this->load->view('footer');
    //redirect("temas?save=true");
  }

}
