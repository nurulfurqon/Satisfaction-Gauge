<?php
	//buat class
	class C_adm_use extends CI_Controller {
		
	
		function index(){
			$this->load->helper('form');
			$this->load->model('admin/user/m_adm_tampil_user','',TRUE);
			$data['tampil_data']=$this->m_adm_tampil_user->ambil_data();
			$this->load->view('admin/user/v_adm_tampil_user',$data);
		}
		public function tambah()
		{
			$this->load->helper(array('url','form'));
			$this->load->model('admin/user/m_adm_tambah_user','',TRUE);	
			$this->load->library('form_validation');
			$id = $this->input->post('id');
			$txt_kodepegawai = $this->input->post('txt_kodepegawai');						
			$txt_username = $this->input->post('txt_username');
			$txt_password = $this->input->post('txt_password');
			$btn_simpan = $this->input->post('btn_simpan');
			
			$data['error'] = "";
			//jika btn_simpan di klik
			if($btn_simpan)
			{
				//setting pesan error
				$this->form_validation->set_rules('txt_kodepegawai');
				$this->form_validation->set_rules('txt_username');
				$this->form_validation->set_rules('txt_password');
				
				if($this->form_validation->run()==TRUE)
				{
					if(empty($txt_kodepegawai)||empty($txt_username)||empty($txt_password))
						{
							$data['error'] = "Lengkapi Seluruh Data !";					
						}
						else
						{
				
							$simpan = $this->m_adm_tambah_user->simpandata($id,$txt_kodepegawai,$txt_username,$txt_password);
							
							if($simpan)
							{
							$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil ditambah</div>');
					//alihkan ke halaman display
							redirect('c_adm_use');
							}
							else
							{
								$data['error'] = "Data Sudah Pernah Tersimpan !";
							}
						}
				}
			}
			//tampil halaman simpan
			$data['tampil_data']=$this->m_adm_tambah_user->ambil_data();
			
			$this->load->view('admin/user/v_adm_tambah_user', $data,$id,$txt_kodepegawai,$txt_username,$txt_password);
			
		}
		public function hapus()
			{
				$this->load->helper('form');
				$this->load->model('admin/user/m_adm_hapus_user','',TRUE);	
				$idnya = $this->uri->segment(3);
				//pesan data sukses
				$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil dihapus</div>');
				//panggil model "hapusdata"
				$this->m_adm_hapus_user->hapusdata($idnya);
				
				//alihkan ke halaman display
				redirect('c_adm_use');
			}
		public function detail()
		{
			$this->load->helper('form');
			$this->load->model('admin/user/m_adm_detail_user','',TRUE);
			$this->load->library('form_validation');
			$idnya = $this->uri->segment(3);
			$data["pilih"] = $this->m_adm_detail_user->detail_data($idnya);
			
			$idnya = $this->input->post('pegawai_id');
			$txt_username = $this->input->post('txt_username');
			$txt_password = $this->input->post('txt_password');
			$btn_ubah = $this->input->post('btn_ubah');						
				
			$data["error"] = "";
			$data["act"] = "0";
			if($btn_ubah)
			{
				$data["act"] = "1";
				$this->form_validation->set_rules('txt_username');
				$this->form_validation->set_rules('txt_password');
				
				if($this->form_validation->run()==TRUE)
					{
						if(empty($txt_username)||empty($txt_password))
						{
							$data["error"] = "Lengkapi Seluruh Data !";					
						}
						else
						{
							$ubah = $this->m_adm_detail_user->ubah($idnya, $txt_username,$txt_password);	
							if($ubah)
							{
								$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil diubah</div>');
				//alihkan ke halaman display
				redirect('c_adm_use');	
							}
							
						}
						
					}
			}
			$this->load->view('admin/user/v_adm_detail_user',$data,$txt_username,$txt_password);
		}
		public function ubah()
		{
			$this->load->helper('form');
			$this->load->model('admin/user/m_adm_ubah_user','',TRUE);
			$this->load->library('form_validation');
			//jika btn_simpan di-klik
			if($this->input->post('btn_ubah'))
			{
				//setting pesan error
				
				$idnya = $this->uri->segment(3);
				//panggil model "ubahdata"
				$this->m_adm_ubah_user->ubahdata($idnya);
				$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil diubah</div>');
				//alihkan ke halaman display
				redirect('c_adm_use');
				
			}
		}
	}
	
?>