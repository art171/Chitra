<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function index()
	{
        $this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/profil/indexprofil');
		$this->load->view('admin/templates/footer');
	}

	public function detil($npsn)
	{		
		$data['profil']=$this->db->get_where('tb07_profilsklh', $id)->row_array();
		
		//var_dump($data);die();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/tendik/indexprofil',$data);
		$this->load->view('admin/templates/footer');
	}

	public function update($npsn)
	{
			// Validasi $id_tendik jika diperlukan
			
			$id=['npsn' => $npsn];
				
			// Data yang akan diupdate
			$data = [
				'nm_sekolah' => $this->input->post('nm_sekolah'),
				'npsn' => $this->input->post('npsn'),
				'jnjng_pnddknk' => $this->input->post('jnjng_pnddknk'),   
				'status_sklh' => $this->input->post('status_sklh'), 
				'alamat_sklh' => $this->input->post('alamat_sklh'),
				'kel' => $this->input->post('kel'), 
				'kec' => $this->input->post('kec'),
				'nip_kepsek' => $this->input->post('nip_kepsek'), 
				'nm_kepsek' => $this->input->post('nm_kepsek'),
				'golongan' => $this->input->post('golongan'),
			];
			// Memanggil model untuk melakukan pembaruan data
			$this->M_profil->updateData($data, $id);
			// Redirect ke halaman yang sesuai
			return redirect('admin/Profil');
	}
	
}