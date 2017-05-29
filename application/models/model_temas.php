<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_temas extends CI_Model {

	public function ListarTemas(){
		$this->db->order_by('temcod DESC');
		return $this->db->get('temas')->result();
	}

	public function ExisteEmail($email){
    $this->db->from('usuarios');
    $this->db->where('EMAIL',$email);
    return $this->db->count_all_results();
  }

	public function SaveTemas($arrayTemas){
	 	$this->db->trans_start();
	 	$this->db->insert('temas', $arrayTemas);
	 	$this->db->trans_complete();
	}

 	function BuscarID($id){
		$query = $this->db->where('temcod',$id);
		$query = $this->db->get('temas');
		return $query->result();
	}

	function BuscarLastCod(){
		return $this->db->select('temcod')->order_by('temcod','desc')->limit(1)->get('temas')->row('temcod');
	}

	function edit($data,$id){
		$this->db->where('temcod',$id);
		$this->db->update('temas',$data);
	}

	function Eliminar($id){
		$this->db->where('temcod',$id);
		$this->db->delete('temas');
	}	

}
?>
