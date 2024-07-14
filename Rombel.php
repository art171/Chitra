<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rombel extends CI_Controller {

	public function index()
	{
		$data ['rombel']= $this->db->get('tb06_rombel')->result();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/rombel/indexrombel',$data);
		$this->load->view('admin/templates/footer');
	}

	public function add()
	{
		$data = array(
			'id_rombel'=> $this->input->post('id_rombel'),
			'nama_rombel' => $this->input->post('nama_rombel'),
			'tingkat_kelas' => $this->input->post('tingkat_kelas'),
			'ruangan' => $this->input->post('ruangan'),	
			'wali_kelas' => $this->input->post('wali_kelas'),
		);
		
		$this->db->insert('tb06_rombel', $data);
		$this->session->set_flashdata('pesan', ' <div class="alert alert-success alert-dismissible">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			  <h4><i class="icon fa fa-check"></i> Alert!</h4>
			  Success alert preview. This alert is dismissable.
			</div> 
			  ');
		return redirect('admin/Rombel');
	}

	public function detil($id_rombel)
	{
		$id=['id_rombel'=>$id_rombel];
		
		$data['rombel']=$this->db->get_where('tb06_rombel', $id)->row_array();
		//var_dump($data);die();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/rombel/detailrombel',$data);
		$this->load->view('admin/templates/footer');
	}

	public function delete ($id_rombel)
	{
		$id=['id_rombel'=>$id_rombel];
		
		$this->db->delete('tb06_rombel',$id);
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Data rombel berhasil dihapus!
              </div>');
		return redirect ('admin/Rombel');
	}

	public function update($id_rombel)
	{
		// Validasi $id_rombel jika diperlukan
		$id = ['id_rombel' => $id_rombel];
		// Data yang akan diupdate
		$data = array(
			'id_rombel'=> $this->input->post('id_rombel'),
			'nama_rombel' => $this->input->post('nama_rombel'),
			'tingkat_kelas' => $this->input->post('tingkat_kelas'),
			'ruangan' => $this->input->post('ruangan'),	
			'wali_kelas' => $this->input->post('wali_kelas'),
		);

		// Kondisi WHERE untuk memperbarui data yang sesuai
		$where = ['id_rombel' => $id_rombel];

		// Memanggil model untuk melakukan pembaruan data
		$this->M_rombel->updateData('tb06_rombel', $data, $where); 

		// Set flashdata untuk pesan sukses
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning 
			alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-check"></i> Sukses </h4>
				Data rombel berhasil diupdate!
			</div>');

		// Redirect ke halaman yang sesuai
		return redirect('admin/Rombel');
	}
}