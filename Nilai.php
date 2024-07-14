<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	public function index()
	{
		$data ['nilai']= $this->db->get('tb09_nilai')->result();
        $this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/nilai/indexNilai', $data);
		$this->load->view('admin/templates/footer');
	}

	public function add()
{
    // Menggunakan $id_mapel jika diperlukan dalam logika Anda
    $data = array(
        'nm_siswa' => $this->input->post('nm_siswa'),
		'nm_pel' =>$this->input->post('nm_pel'),
        'nilai' => $this->input->post('nilai'),
    );
    
    $this->db->insert('tb09_nilai', $data);
    $this->session->set_flashdata('pesan', ' <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
          Success alert preview. This alert is dismissable.
        </div> 
          ');
    return redirect('admin/Nilai');
}


}