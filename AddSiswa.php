<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
	
	public function index()
	{
		$data ['siswa']= $this->db->get('tb01_ssw')->result();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/siswa/index',$data);
		$this->load->view('admin/templates/footer');
	}
	public function add()
	{
		$data = array(
			'kmptnsi_keahlian'=> $this->input->post('kmptnsi_keahlian'),
			'nm_siswa' => $this->input->post('nm_siswa'),
			'jk' => $this->input->post('jk'),
			'nis' => $this->input->post('nis'),
		);
		
		$this->db->insert('tb01_ssw', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Data Siswa berhasil ditambahkan!
              </div>');
		return redirect('admin/Siswa');
	}
	
	public function detil($nm_siswa) 
	{
		$id=['nm_siswa'=>$nm_siswa];

		$data ['siswa']= $this->db->get_where('tb01_ssw')->row_array();
		//var_dump($data);die();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/siswa/detail',$data);
		$this->load->view('admin/templates/footer');
	}
	
	public function delete ($nm_siswa)
	{
		$id=['nm_siswa'=>$nm_siswa];
		
		$this->db->delete('tb01_ssw',$id);
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Data Siswa berhasil dihapus!
              </div>');
		return redirect ('admin/Siswa');
	}

	public function update($nm_siswa)
	{
		$id = ['nm_siswa' => $nm_siswa];
			$data = [
				'tingkat' => $this->input->post('tingkat'),
				'kmptnsi_keahlian'=> $this->input->post('kmptnsi_keahlian'),
				'nm_siswa' => $this->input->post('nm_siswa'),
				'jk' => $this->input->post('jk'),
				'nis' => $this->input->post('nis'),
			
			];
		
		$this->M_siswa->updateData($data, $id); 
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Data Siswa berhasil diupdate!
              </div>');
		return redirect('admin/Siswa');
	}
	
	public function updatePhoto($nm_siswa)
	{
		$id = ['nm_siswa' => $nm_siswa];		
		$photo = $_FILES['photo']['name'];
				if($photo){
					$config['upload_path'] = './assets/img/uploads';
					$config['allowed_types'] = 'jpeg|jpg|png';
					
					$this->load->library('upload', $config);
					
					if($this->upload->do_upload('photo')){
							$photo = $this->upload->data('file_name');
							$this->db->set('photo', $photo);
					}else{
						echo "photo gagal diupdate!";
					}
				}
		$data = array(
				'photo' => $photo,
				'update_at' => date('y-m-d')
		);
		//timpa data photo
		$item = $this->db->get_where('siswa', $nm_siswa)->row();
		
		if($item->photo !=NULL){
			$target_file = './assets/img/uploads/'.$item->photo;
			unlink ($target_file);
			
		}
		$this->db->update('siswa', $data, $nm_siswa);
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Photo berhasil diupdate!
              </div>');
		return redirect($_SERVER['HTTP_REFERER']);
	}

	public function print ($nm_siswa)
	{
		$data['siswa'] = $this->M_siswa-> getDetil ("tb01_ssw")->result();
		$this->load->view('print_siswa, $data');
	}

}

