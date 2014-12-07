<?php 
	class City_model extends CI_Model{
		public function getCity(){
			$this->db->select();
			$this->db->from('cities');
			$this->db->order_by('city_title');
			$q=$this->db->get();

			return $q->result();
		}
	}
?>