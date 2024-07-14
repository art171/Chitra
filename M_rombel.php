<?php

	class M_rombel extends CI_Model {
		
		public function getData() 
		{			
			$this->db->select('*');
			$this->db->from('tb06_rombel', 'tb06_rombel.nama_tendik = tb04_tendik.nama_tendik','left');
			$this->db->order_by('nama_tendik','ASC');
			$query = $this->db->get('rombel');
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

		public function updateData($id, $data)
		{
			$this->db->update('tb06_rombel', $id, $data); 
		}

		public function print($data, $id)
		{
			return $this->db->get_where($table, $id);
		}
	}

?>