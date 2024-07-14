<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {

	public function index()
	{
		$data ['prodi']= $this->db->get('tb05_prodi')->result();
        $this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/prodi/index', $data);
		$this->load->view('admin/templates/footer');
	}

	public function add()
	{
		$data = array(
			'kd_keahlian'=> $this->input->post('kd_keahlian'),
			'bdng_keahlian' => $this->input->post('bdng_keahlian'),
			'prgrm_keahlian' => $this->input->post('prgrm_keahlian'),
			'kmptnsi_keahlian' => $this->input->post('kmptnsi_keahlian'),
		);
		
		$this->db->insert('tb05_prodi', $data);
		$this->session->set_flashdata('pesan', ' <div class="alert alert-success alert-dismissible">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			  <h4><i class="icon fa fa-check"></i> Alert!</h4>
			  Success alert preview. This alert is dismissable.
			</div> 
			  ');
		return redirect('admin/Prodi');
	}

	public function detil($kd_keahlian)
	{
		$id=['kd_keahlian'=>$kd_keahlian];
		
		$data = [
			'kd_keahlian'=> $this->input->post('kd_keahlian'),
			'bdng_keahlian' => $this->input->post('bdng_keahlian'),
			'prgrm_keahlian' => $this->input->post('prgrm_keahlian'),
			'kmptnsi_keahlian' => $this->input->post('kmptnsi_keahlian'),
		];
		
		//var_dump($data);die();
	}

	public function delete ($kd_keahlian)
	{
		$id=['kd_keahlian'=>$kd_keahlian];
		
		$this->db->delete('tb05_prodi',$id);
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Data Prodi berhasil dihapus!
              </div>');
		return redirect ('admin/Prodi');
	}

	public function update($kd_keahlian)
	{
			// Validasi $kd_keahlian jika diperlukan
			
			$id=['kd_keahlian' => $kd_keahlian];
			$data['title'] = 'Master';
			$data['subtitle'] = 'Data Jurusan';

			$data ['prodi']= $this->M_prodi->getUpdate('tb05_prodi', $id)->row_array();

			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar', $data);
			$this->load->view('admin/prodi/update', $data);
			$this->load->view('admin/templates/footer');
			
	}

	public function updateAksi($kd_keahlian)
{
    $id = ['kd_keahlian' => $kd_keahlian];
    $data = array(
        'kd_keahlian'=> $this->input->post('kd_keahlian'),
        'bdng_keahlian' => $this->input->post('bdng_keahlian'),
        'prgrm_keahlian' => $this->input->post('prgrm_keahlian'),
        'kmptnsi_keahlian' => $this->input->post('kmptnsi_keahlian'),
    );
    
    // Panggil metode update pada model M_prodi
    $this->M_prodi->updateData('tb05_prodi', $data, $id);
    
	
	$this->load->library('session');
	$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-check"></i> Alert!</h4>
	Success alert preview. This alert is dismissable.
  	</div>');
    return redirect('admin/Prodi');
}

}