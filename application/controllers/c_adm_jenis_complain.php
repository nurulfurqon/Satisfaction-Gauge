<?php
	class C_adm_jenis_complain extends CI_Controller {
		
	
		function index()
		{
			$this->load->helper('form');
			$this->load->model('admin/jenis_complain/m_adm_tampil_jenis_complain','',TRUE);
			$data['tampil_data']=$this->m_adm_tampil_jenis_complain->ambil_data();
			$this->load->view('admin/jenis_complain/v_adm_tampil_jenis_complain',$data);
		}

		public function tambah()
		{
			$this->load->helper(array('url','form'));
			$this->load->model('admin/jenis_complain/m_adm_tambah_jenis_complain','',TRUE);	
			$this->load->library('form_validation');
			$jeniscomplain=$this->input->post('txt_jeniscomplain');
			$point=$this->input->post('txt_point');
			
			$data['error'] = "";
			//jika btn_simpan di klik
			if($this->input->post('btn_simpan'))
			{
				//setting pesan error
				$this->form_validation->set_rules('txt_jeniscomplain');
				$this->form_validation->set_rules('txt_point');
			
				if($this->form_validation->run()==TRUE)
				{
					if(empty($jeniscomplain)||empty($point))
					{
						$data['error'] = "Lengkapi Seluruh Data !";	
					}
					else
					{
						//panggil model "simpandata"
						$simpan = $this->m_adm_tambah_jenis_complain->simpandata($jeniscomplain,$point);
						if($simpan)
						{
							$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil ditambah</div>');
							//alihkan ke halaman display
							redirect('c_adm_jenis_complain');
						}
						else
						{
							$data['error'] = "Data Sudah Pernah Tersimpan !";
						}
					}
				}
			}
			//tampil halaman simpan
			
			$this->load->view('admin/jenis_complain/v_adm_tambah_jenis_complain',$data,$jeniscomplain,$point);
		}
		
		public function hapus()
			{
				$this->load->helper('form');
				$this->load->model('admin/jenis_complain/m_adm_hapus_jenis_complain','',TRUE);	
				$idnya = $this->uri->segment(3);
				//pesan data sukses
				$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil dihapus</div>');
				//panggil model "hapusdata"
				$this->m_adm_hapus_jenis_complain->hapusdata($idnya);
				
				//alihkan ke halaman display
				redirect('c_adm_jenis_complain');
			}
			
		public function detail()
		{
			$this->load->helper('form');
			$this->load->model('admin/jenis_complain/m_adm_detail_jenis_complain','',TRUE);
			$this->load->library('form_validation');
			$idnya = $this->uri->segment(3);
			$data["pilih"] = $this->m_adm_detail_jenis_complain->detail_data($idnya);
			
			$idnya=$this->input->post('nama');
			$jeniscomplain=$this->input->post('txt_jeniscomplain');
			$point=$this->input->post('txt_point');
			$btn_ubah = $this->input->post('btn_ubah');						
				
			$data["error"] = "";
			$data["act"] = "0";
			if($btn_ubah)
				{
					$data["act"] = "1";
					$this->form_validation->set_rules('txt_jeniscomplain');
					$this->form_validation->set_rules('txt_point');
					
					if($this->form_validation->run()==TRUE)
					{
						if(empty($jeniscomplain)||empty($point))
						{
							$data["error"] = "Lengkapi Seluruh Data !";					
						}
						else
						{
							$ubah = $this->m_adm_detail_jenis_complain->ubahdata($idnya,$jeniscomplain,$point);
							if($ubah)
							{
							$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil diubah</div>');
							//alihkan ke halaman display
							redirect('c_adm_jenis_complain');
							}
							else
							{
								$data["error"] = "Data Sudah Pernah Tersimpan !";
							}
						}
					}
				}
			$this->load->view('admin/jenis_complain/v_adm_detail_jenis_complain',$data,$jeniscomplain,$point);
		}
		public function ubah()
		{
			$this->load->helper('form');
			$this->load->model('admin/jenis_complain/m_adm_ubah_jenis_complain','',TRUE);
			$this->load->library('form_validation');
			//jika btn_simpan di-klik
			if($this->input->post('btn_ubah'))
			{
				//setting pesan error
				
				$idnya = $this->uri->segment(3);
				//panggil model "ubahdata"
				$this->m_adm_ubah_jenis_complain->ubahdata($idnya);
				$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil diubah</div>');
				//alihkan ke halaman display
				redirect('c_adm_jenis_complain');
				
			}
		}

}
?>