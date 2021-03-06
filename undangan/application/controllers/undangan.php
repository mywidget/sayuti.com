<?php
class undangan extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_undangan');
	}
	function index(){
        $x['id'] = $this->m_undangan->getID();
		$this->load->view('v_undangan',$x);
	}

	function data_undangan(){
		$data=$this->m_undangan->undangan_list();
		echo json_encode($data);
	}

	function get_undangan(){
		$id=$this->input->get('id');
		$data=$this->m_undangan->get_undangan_by_kode($id);
		echo json_encode($data);
	}

	function simpan_undangan(){
		$id=$this->input->post('id');
		$ncp=$this->input->post('ncp');
		$ncw=$this->input->post('ncw');
		$icp=$this->input->post('icp');
		$icw=$this->input->post('icw');
		$acp=$this->input->post('acp');
		$acw=$this->input->post('acw');
		$data=$this->m_undangan->simpan_undangan($id,$ncp,$ncw,$icp,$icw,$acp,$acw);
		//$this->session->set_flashdata('success', 'Anda Berhasil Menampilkan data User');
		echo json_encode($data);
	}

	function update_undangan(){
		$kobar=$this->input->post('kobar');
		$nabar=$this->input->post('nabar');
		$harga=$this->input->post('harga');
		$data=$this->m_undangan->update_undangan($kobar,$nabar,$harga);
		echo json_encode($data);
	}

	function hapus_undangan(){
		$kobar=$this->input->post('kode');
		$data=$this->m_undangan->hapus_undangan($kobar);
		echo json_encode($data);
	}
function upload_image(){
 		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 500;
		$config['max_width']            = 2048;
		$config['max_height']           = 1000;
		$config['encrypt_name'] 		= true;
		$this->load->library('upload',$config);
		//$keterangan_berkas = $this->input->post('keterangan_berkas');
		$jumlah_berkas = count($_FILES['berkas']['name']);
		for($i = 0; $i < $jumlah_berkas;$i++)
		{
            if(!empty($_FILES['berkas']['name'][$i])){

				$_FILES['file']['name'] = $_FILES['berkas']['name'][$i];
				$_FILES['file']['type'] = $_FILES['berkas']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['berkas']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['berkas']['error'][$i];
				$_FILES['file']['size'] = $_FILES['berkas']['size'][$i];
	   
				if($this->upload->do_upload('file')){
					
					$uploadData = $this->upload->data();
					$data['nama_berkas'] = $uploadData['file_name'];
					//$data['keterangan_berkas'] = $keterangan_berkas[$i];
					$data['tipe_berkas'] = $uploadData['file_ext'];
					$data['ukuran_berkas'] = $uploadData['file_size'];
					//$this->db->insert('tb_berkas',$data);
				}
			}
		}
		redirect('undangan');
}



}