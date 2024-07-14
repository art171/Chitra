<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class guru extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Muat model M_guru
        $this->load->model('M_guru');
    }

	public function index()
	{
		$data ['guru']= $this->db->get('tb04_guru')->result();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/guru/index',$data);
		$this->load->view('admin/templates/footer');
	}
	public function add()
	{
		$data = array(
			'id_guru'=> $this->input->post('id_guru'),
			'nama_guru' => $this->input->post('nama_guru'),
			'jnis_klamin' => $this->input->post('jnis_klamin'),
			'nuptk' => $this->input->post('nuptk'),	
			'tmpt_lahir' => $this->input->post('tmpt_lahir'), 
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'alamat' => $this->input->post('alamat'), 
			'pendidikan' =>$this->input->post('pendidikan'),
			'nm_pel' => $this->input->post('nm_pel'),
		);
		
		$this->db->insert('tb04_guru', $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Data guru berhasil ditambahkan!
              </div>');
		return redirect('admin/Guru');
	}
	
	public function detil($id_guru)
	{
		$id=['id_guru'=>$id_guru];
		
		$data['guru']=$this->db->get_where('tb04_guru', $id)->row_array();
		
		//var_dump($data);die();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/guru/detail',$data);
		$this->load->view('admin/templates/footer');
	}

	public function delete ($id_guru)
	{
		$id=['id_guru'=>$id_guru];
		
		$this->db->delete('tb04_guru',$id);
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Data guru berhasil dihapus!
              </div>');
		return redirect ('admin/Guru');
	}

	public function update($id_guru)
	{
			// Validasi $id_guru jika diperlukan
			
			$id=['id_guru' => $id_guru];
				
			// Data yang akan diupdate
			$data = [
				'nama_guru' => $this->input->post('nama_guru'),
				'jnis_klamin' => $this->input->post('jnis_klamin'),
				'nuptk' => $this->input->post('nuptk'),   
				'tmpt_lahir' => $this->input->post('tmpt_lahir'), 
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'alamat' => $this->input->post('alamat'), 
				'pendidikan' => $this->input->post('pendidikan'),
				'nm_pel' => $this->input->post('nm_pel'),
			];
			// Memanggil model untuk melakukan pembaruan data
			$this->M_guru->updateData($data, $id);
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Data guru berhasil diUpdate!
              </div>');
			// Redirect ke halaman yang sesuai
			return redirect('admin/Guru');
	}

	public function updatePhoto($id_guru)
	{
		$id = ['id_guru' => $id_guru];		
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
		);
		//timpa data photo
		$item = $this->db->get_where('guru', $id_guru)->row();
		
		if($item->photo !=NULL){
			$target_file = './assets/img/uploads/'.$item->photo;
			unlink ($target_file);
			
		}
		$this->db->update('guru', $data, $id_guru);
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning 
			alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses </h4>
                Photo berhasil diupdate!
              </div>');
		return redirect($_SERVER['HTTP_REFERER']);
	}

	public function print($id_guru)
{
    $data['guru'] = $this->M_guru->getDetail($id_guru);
    if (!$data['guru']) {
        show_404();
    }
    $this->load->view('admin/print_guru_detail', $data);
}

}

