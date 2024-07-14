<?php

	class M_addsiswa extends CI_Model {
		public function getData() 
		{
			$this->db->order_by('tb01_siswa','ASC');
			$query = $this->db->get('siswa');
			return $query;
		}
		
		public function insertData($data, $table)
		{
			$this->db->insert($data, $table);
		}
		
		public function getDetil($table, $id)
		{
			return $this->db->get_where($table, $id);
		}
		public function updateData($data, $id)
		{
			$this->db->update('siswa',$data, $id);
		}
	}

?>