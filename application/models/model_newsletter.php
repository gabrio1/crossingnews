<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_newsletter extends CI_Model {

	public function GenerarNewsletter($dateSelected){
		$SqlInfo = "SELECT * from noticias where notfec=$dateSelected";
		return $this->db->query($SqlInfo)->result_array();
	}
}

?>
