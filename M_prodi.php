<?php

	class M_prodi extends CI_Model {

		public function __construct()
		{
			parent::__construct();
		}

		public function getData() 
		{
			$this->db->order_by('kd_keahlian','ASC');
			$query = $this->db->get('prodi');
			return $query;
		}
		
		public function insertData($data, $table)
		{
			$this->db->insert($data, $table);
		}

		public function getUpdate($table, $id)
		{
			return $this->db->get_where($table, $id);		
		}
		
		public function updateData($table, $data, $where)
		{
			$this->db->where($where);
			$this->db->update($table, $data);
		}

	}

?>