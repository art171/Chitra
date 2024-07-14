<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Muat model M_tendik
        $this->load->model('M_mapel');
    }

	public function index()
	{
		$data ['mapel']= $this->db->get('tb08_mapel')->result();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/mapel/mapelindex',$data);
		$this->load->view('admin/templates/footer');
	}
	public function add()
	{
		$data = array(
			'id_mapel'=> $this->input->post('id_mapel'),
			'nm_pel' => $this->input->post('nm_pel'),
			'semester' => $this->input->post('semester'),
			'kmptnsi_keahlian' => $this->input->post('kmptnsi_keahlian'),
            'kls' => $this->input->post('kls'),
		);
		
		$this->db->insert('tb08_mapel', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Data tendik berhasil ditambahkan!
              </div>');
		return redirect('admin/Mapel');
	}

	public function delete ($id_mapel)
	{
		$id=['id_mapel'=>$id_mapel];
		
		$this->db->delete('tb08_mapel',$id);
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Data tendik berhasil dihapus!
              </div>');
		return redirect ('admin/Mapel');
	}

	public function detailmapel($id_mapel)
	{
		$id=['id_mapel' => $id_mapel];

		$data = [
			'id_mapel'=> $this->input->post('id_mapel'),
			'nm_pel' => $this->input->post('nm_pel'),
			'semester' => $this->input->post('semester'),
			'kmptnsi_keahlian' => $this->input->post('kmptnsi_keahlian'),
			'kls' => $this->input->post('kls'),
		];
		
		return redirect ('admin/Mapel');
	}

	public function update($id_mapel)
	{
			// Validasi $id_mapel jika diperlukan
			
			$id=['id_mapel' => $id_mapel];
			$data['title'] = 'Mata Pelajaran';
			$data['subtitle'] = 'Data mata Pelajaran';

			$data ['mapel']= $this->M_mapel->getUpdate('tb08_mapel', $id)->row_array();

			$this->load->view('admin/templates/header');
			$this->load->view('admin/templates/sidebar', $data);
			$this->load->view('admin/mapel/detailmapel', $data);
			$this->load->view('admin/templates/footer');
			
	}

	public function updateAksi($id_mapel)
{
    $id = ['id' => $id_mapel];
    $data = array(
		'id_mapel'=> $this->input->post('id_mapel'),
		'nm_pel' => $this->input->post('nm_pel'),
		'semester' => $this->input->post('semester'),
		'kmptnsi_keahlian' => $this->input->post('kmptnsi_keahlian'),
		'kls' => $this->input->post('kls'),
    );
    
    // Panggil metode update pada model M_prodi
    $this->M_mapel->updateData('tb08_mapel', $data, $id);
    
	
	$this->load->library('session');
	$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-check"></i> Alert!</h4>
	Success alert preview. This alert is dismissable.
  	</div>');
    return redirect('admin/Mapel');
}

	public function print($id_mapel)
{
    $data['tendik'] = $this->M_tendik->getDetail($id_mapel);
    if (!$data['tendik']) {
        show_404();
    }
    $this->load->view('admin/print_tendik_detail', $data);
}

}

