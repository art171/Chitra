<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class addtendik extends CI_Controller {

	public function index()
	{
		$data ['tendik']= $this->db->get('tb04_tendik')->result();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/tendik/add',$data);
		$this->load->view('admin/templates/footer');
	}
	public function add()
	{
		$data = array(
			'id_tendik'=> $this->input->post('id_tendik'),
			'nama_tendik' => $this->input->post('nama_tendik'),
			'jnis_klamin' => $this->input->post('jnis_klamin'),
			'nuptk' => $this->input->post('nuptk'),	
			'tmpt_lahir' => $this->input->post('tmpt_lahir'), 
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'alamat' => $this->input->post('alamat'), 
			'pendidikan' =>$this->input->post('pendidikan'),
			'mapel' => $this->input->post('mapel'),
		);
		
		$this->M->insertData('tendik', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Data tendik berhasil ditambahkan!
              </div>');
		return redirect('admin/tendik');
	}
	public function detil($id_tendik)
	{
		$id=['id_tendik'=>$id_tendik];
		
		$data['tendik']=$this->db->get_where('tb04_tendik', $id)->row_array();
		//var_dump($data);die();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/tendik/detail',$data);
		$this->load->view('admin/templates/footer');
	
	}
	public function delete ($id_tendik)
	{
		$id=['id_tendik'=>$id_tendik];
		
		$this->db->delete('tb04_tendik',$id);
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Data tendik berhasil dihapus!
              </div>');
		return redirect ('admin/Tendik');
	}

	public function update($id_tendik)
	{
		$id = ['id_tendik' => $id_tendik];
			$data = [
				'id_tendik'=> $this->input->post('id_tendik'),
				'nama_tendik' => $this->input->post('nama_tendik'),
				'jnis_klamin' => $this->input->post('jnis_klamin'),
				'nuptk' => $this->input->post('nuptk'),	
				'tmpt_lahir' => $this->input->post('tmpt_lahir'), 
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat'), 
				'pendidikan' =>$this->input->post('pendidikan'),
				'mapel' => $this->input->post('mapel'),
			
			];
		
		$this->M_tendik->updateData('tb04_tendik', $data); 
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Data tendik berhasil diupdate!
              </div>');
		return redirect('admin/Tendik');
	}
}