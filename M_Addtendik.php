<?php

	class M_addtendik extends CI_Model {
		public function getData() 
		{
			$this->db->order_by('tb04_tendik','ASC');
			$query = $this->db->get('tendik');
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
			$this->db->update('tendik',$data, $id);
		}
	}

?>