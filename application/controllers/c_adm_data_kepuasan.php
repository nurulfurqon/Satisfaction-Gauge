<?php
	//buat class
	class C_adm_data_kepuasan extends CI_Controller {
		
	
		function index(){
			$this->load->helper('form');
			$this->load->model('admin/data_kepuasan/m_adm_tampil_data_kepuasan','',TRUE);
			$data['tampil_data']=$this->m_adm_tampil_data_kepuasan->ambil_data();
			$this->load->view('admin/data_kepuasan/v_adm_tampil_data_kepuasan',$data);
		}
		public function tambah()
		{
			$this->load->helper(array('url','form'));
			$this->load->model('admin/data_kepuasan/m_adm_tambah_data_kepuasan','',TRUE);	
			$this->load->library('form_validation');
			$jenis_complain=$this->input->post('cbo_jenis_complain');
			$pengukuran=$this->input->post('txt_pengukuran');
			
			$data['error'] = "";
			//jika btn_simpan di klik
			if($this->input->post('btn_simpan'))
			{
				//setting pesan error
				$this->form_validation->set_rules('cbo_jenis_complain');
				$this->form_validation->set_rules('txt_pengukuran');
			
				if($this->form_validation->run()==TRUE)
				{
					if(empty($jenis_complain)||empty($pengukuran))
					{
						$data['error'] = "Lengkapi Seluruh Data !";	
					}
					else
					{
						//panggil model "simpandata"
						$simpan = $this->m_adm_tambah_data_kepuasan->simpandata($jenis_complain,$pengukuran);
						if($simpan)
						{
							$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil ditambah</div>');
							//alihkan ke halaman display
							redirect('c_adm_data_kepuasan');
						}
						else
						{
							$data['error'] = "Data Sudah Pernah Tersimpan !";
						}
					}
				}
			}
			//tampil halaman simpan
			$data['tampil_data']=$this->m_adm_tambah_data_kepuasan->ambil_data();
			
			$this->load->view('admin/data_kepuasan/v_adm_tambah_data_kepuasan', $data,$jenis_complain,$pengukuran);
		}
		
		public function hapus()
			{
				$this->load->helper('form');
				$this->load->model('admin/data_kepuasan/m_adm_hapus_data_kepuasan','',TRUE);	
				$idnya = $this->uri->segment(3);
				//pesan data sukses
				$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil dihapus</div>');
				//panggil model "hapusdata"
				$this->m_adm_hapus_data_kepuasan->hapusdata($idnya);
				
				//alihkan ke halaman display
				redirect('c_adm_data_kepuasan');
			}
		
		public function detail()
		{
			$this->load->helper('form');
			$this->load->model('admin/data_kepuasan/m_adm_detail_data_kepuasan','',TRUE);
			$this->load->library('form_validation');
			$idnya = $this->uri->segment(3);
			$data['tampil_data']=$this->m_adm_detail_data_kepuasan->ambil_data();
			
			$data["pilih"] = $this->m_adm_detail_data_kepuasan->detail_data($idnya);
			$idnya=$this->input->post('id');
			$jenis_complain=$this->input->post('cbo_jenis_complain');
			$pengukuran=$this->input->post('txt_pengukuran');
			$btn_ubah = $this->input->post('btn_ubah');
			
			$data["error"] = "";
			$data["act"] = "0";
			if($btn_ubah)
			{
				$data["act"] = "1";
				$this->form_validation->set_rules('txt_pengukuran');
				
				if($this->form_validation->run()==TRUE)
					{
						if(empty($pengukuran))
						{
							$data["error"] = "Lengkapi Seluruh Data !";					
						}
						else
						{
							$ubah = $this->m_adm_detail_data_kepuasan->ubahdata($idnya,$jenis_complain,$pengukuran);	
							if($ubah)
							{
								$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil diubah</div>');
								//alihkan ke halaman display
								redirect('c_adm_data_kepuasan');	
							}
							else
							{
								$data['error'] = "Data Sudah Pernah Tersimpan !";
							}
							
						}
						
					}
			}
			$this->load->view('admin/data_kepuasan/v_adm_detail_data_kepuasan',$data,$jenis_complain,$pengukuran);
		}
		public function ubah()
		{
			$this->load->helper('form');
			$this->load->model('admin/data_kepuasan/m_adm_ubah_data_kepuasan','',TRUE);
			$this->load->library('form_validation');
			//jika btn_simpan di-klik
			if($this->input->post('btn_ubah'))
			{
				//setting pesan error
				
				$idnya = $this->uri->segment(3);
				//panggil model "ubahdata"
				$this->m_adm_ubah_data_kepuasan->ubahdata($idnya);
				$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil diubah</div>');
				//alihkan ke halaman display
				redirect('c_adm_data_kepuasan');
				
			}
		}
	}
	
?>