<?php

	class M_profil extends CI_Model {

		public function __construct()
		{
			parent::__construct();
		}

		public function getData() 
		{
			$this->db->order_by('npsn','ASC');
			$query = $this->db->get('profil');
			return $query;
		}
		
		public function getDetil($table, $id)
		{
			return $this->db->get_where($table, $id);
		}

		public function updateData($data, $id)
		{
			$this->db->update('tb07_profilsklh', $data, $id);			
		}

	}

?>