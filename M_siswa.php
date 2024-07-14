<?php

	class M_siswa extends CI_Model {
		
		public function getData() 
		{
			$this->db->select('*');
			$this->db->from('tb02_ortu', 'tb02_ortu.nm_siswa = tb01_ssw.nm_siswa', 'tb05_prodi', 'tb05_prodi.kmptnsi_keahlian = tb01_ssw.kmptnsi_keahlian','left');
			$this->db->order_by('nm_siswa','kmptnsi_keahlian','ASC');
			$query = $this->db->get('siswa');
			return $query;
			//$this->db->SELECT ('t1.column1, t1.column2, t2.column1')//Digunakan untuk memilih kolom yang ingin Anda ambil dari tabel.
			//$this->db->FROM ('table1 AS t1')//Menentukan tabel-tabel yang akan digunakan.
			//$this->db->INNER_JOIN ('table2 AS t2') ON ('t1.common_column = t2.common_column');//Menghubungkan baris-baris dari tabel pertama dengan baris-baris yang cocok di tabel kedua berdasarkan kolom yang sama.
			//$query = $this->db->get('siswa');
			//return $query;
		}
		
		public function insertData($data, $table)
		{
			$this->db->insert('tb01_ssw', $data, $table);
		}
		
		public function getDetil($table, $id)
		{
			// Memilih kolom yang ingin diambil dari tabel
			$this->db->select('tb01_ssw.nm_siswa, tb01_ssw.kmptnsi_keahlian, tb02_ortu.nm_siswa, tb05_prodi.kmptnsi_keahlian');
	
			// Menentukan tabel utama yang akan digunakan
			$this->db->from('tb01_ssw');
	
			// Menghubungkan baris dari tabel tb01_ssw dengan tb02_ortu berdasarkan kolom nm_siswa yang sama
			$this->db->join('tb02_ortu', 'tb01_ssw.nm_siswa = tb02_ortu.nm_siswa', 'inner');
	
			// Menghubungkan baris dari tabel tb01_ssw dengan tb05_prodi berdasarkan kolom kmptnsi_keahlian yang sama
			$this->db->join('tb05_prodi', 'tb01_ssw.kmptnsi_keahlian = tb05_prodi.kmptnsi_keahlian', 'inner');
			
			// Menjalankan query
			$query = $this->db->get();
	
			// Mengembalikan hasil query dengan kondisi tertentu
			return $this->db->get_where($data, $id);
		}

		public function __construct() {
			parent::__construct();
		}
	
		public function updateData($data, $id) {
			$this->db->where($id);
			return $this->db->update('tb01_ssw', $data);
		}

		public function print($data, $id)
		{
			return $this->db->get_where($table, $id);
		}
	}

?>