<?php

class ModelNilai extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ModelNilai'); // Gunakan nama kelas model yang baru
    }

    public function index() {
        $data['title'] = '';
        $data['subtitle'] = 'Input Nilai Sesuai Jurusan';
        $data['nilai'] = $this->ModelNilai->getData('tb09_nilai')->result();
        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/sidebar', $data);
        $this->load->view('admin/nilai/index_nilai', $data);
        $this->load->view('admin/templates/footer');
    }
}

?>
