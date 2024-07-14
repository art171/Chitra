<?php

	class M_guru extends CI_Model {

		public function __construct()
		{
			parent::__construct();
		}

		public function getData() 
		{
			$this->db->order_by('id_guru','ASC');
			$query = $this->db->get('guru');
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
			$this->db->update('tb04_guru', $data, $id);			
		}

	}

?>