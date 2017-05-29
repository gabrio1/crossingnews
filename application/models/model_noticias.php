<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_noticias extends CI_Model {

	public function ListarNoticias(){
		$this->db->order_by('notcod DESC');
		return $this->db->get('noticias')->result();
	}

	public function ListarTemasNoticias($id){
		$SqlInfo = "select tn.idtema,tn.idnoticia,n.nottit,n.notenc,n.notfec,t.temnom, t.temcod
			from temanot tn,temas t,noticias n
			where tn.idtema=t.temcod and tn.idnoticia=n.notcod and tn.idnoticia=$id
			order by n.notcod desc";
		return $this->db->query($SqlInfo)->result_array();
	}

	public function MostrarTemas($id){
		$SqlInfo = "select temnom,temcod from temas where not temcod in (
			select tn.idtema
			from temanot tn,temas t,noticias n
			where tn.idtema=t.temcod and tn.idnoticia=n.notcod and tn.idnoticia=$id
			order by n.notcod desc)";
		return $this->db->query($SqlInfo)->result_array();
	}

	public function TemasNotiNueva(){
		$SqlTemas = "SELECT * FROM temas";
		return $this->db->query($SqlTemas)->result_array();
	}


	public function SaveNoticias($arrayNoticias){
	 	$this->db->trans_start();
	 	$this->db->insert('noticias', $arrayNoticias);
	 	$this->db->trans_complete();
	}

 	function BuscarID($id){
		$query = $this->db->where('notcod',$id);
		$query = $this->db->get('noticias');
		return $query->result();
	}

	function BuscarLastCod(){
		return $this->db->select('notcod')->order_by('notcod','desc')->limit(1)->get('noticias')->row('notcod');
	}

	function edit($data,$id){
		$this->db->where('notcod',$id);
		$this->db->update('noticias',$data);
	}

	function Eliminar($id){
		$this->db->where('notcod',$id);
		$this->db->delete('noticias');
	}

	function updateTemaNoticia($idNoticia, $arrayTemaNot){
		$this->db->where('idnoticia',$idNoticia);
		$this->db->delete('temanot');
		$arrayTemaNot = is_array($arrayTemaNot) ? $arrayTemaNot : array($arrayTemaNot);
		foreach ($arrayTemaNot as $val){
				$SqlInfo = 'insert into temanot(idtemanot,idtema,idnoticia)
				values(0,'.$val.','.$idNoticia.')';
				$this->db->query($SqlInfo);
		}
	}
}
?>
