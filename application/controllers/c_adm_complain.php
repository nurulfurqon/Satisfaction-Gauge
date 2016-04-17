<?php
	//buat class
	class C_adm_complain extends CI_Controller {
		
		
		
		function index($id=NULL){
			$this->load->helper(array('url','form'));
			$this->load->library(array('session','user_agent','form_validation','pagination'));
			$this->load->model('admin/complain/m_adm_tampil_complain','',TRUE);
			$txt_cari = $this->input->post('txt_cari');	
			$this->form_validation->set_rules('txt_cari');
			$query=$this->db->query("SELECT *,tb_pegawai.nama as nama_pegawai,tb_pelanggan.nama as nama_pelanggan FROM tb_complain INNER JOIN tb_pelanggan ON tb_pelanggan.id = tb_complain.pelanggan_id INNER JOIN tb_pegawai ON tb_pegawai.id = tb_complain.pegawai_id INNER JOIN tb_jenis_complain ON tb_jenis_complain.id = tb_complain.jenis_complain_id order by kode_complain  ");
			$n = $query->num_rows();
			
				$config['base_url'] = base_url().'index.php/c_adm_complain/index/';
				$config['total_rows'] = $n;
				$config['per_page'] = '10';
				$config['full_tag_open'] = "<ul class='pagination pagination-sm' style='margin-top:0px;'>";
				$config['full_tag_close'] ="</ul>";
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
			
				$this->pagination->initialize($config);
				$data['halaman'] = $this->pagination->create_links();
				
				$data['list_complain'] =$this->m_adm_tampil_complain->tampil($config['per_page'],$id);
				$data["no"]=$id;
				
				if($this->form_validation->run()==TRUE)
				{
										
				}
			$this->load->view('admin/complain/v_adm_tampil_complain',$data);
		}

		public function tambah()
		{
			$this->load->helper(array('url','form'));
			$this->load->model('admin/complain/m_adm_tambah_complain','',TRUE);	
			$this->load->library('form_validation');
			$pelanggan_id=$this->input->post('cbo_pelanggan');
			$pegawai_id=$this->input->post('cbo_pegawai');
			$jenis_complain_id=$this->input->post('cbo_jenis_complain');
			$tgl_complain=$this->input->post('tgl_complain');
			$status=$this->input->post('cbo_status');
			//jika btn_simpan di klik
			if($this->input->post('btn_simpan'))
			{
				//setting pesan error
				$this->form_validation->set_rules('cbo_pelanggan');
				$this->form_validation->set_rules('cbo_pegawai');
				$this->form_validation->set_rules('cbo_jenis_complain');
				$this->form_validation->set_rules('tgl_complain');
				$this->form_validation->set_rules('cbo_status');
				
				if($this->form_validation->run()==TRUE)
				{
					if(empty($pelanggan_id)||empty($pegawai_id)||empty($jenis_complain_id)||empty($tgl_complain)||empty($status))
						{
							$data['error'] = "Lengkapi Seluruh Data !";					
						}
						else
						{
							$simpan = $this->m_adm_tambah_complain->simpandata($pelanggan_id,$pegawai_id,$jenis_complain_id,$tgl_complain,$status);
							
							if($simpan)
							{
								$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil ditambah</div>');
					//alihkan ke halaman display
								redirect('c_adm_complain');
							}
						}
				}
			}
			//tampil halaman simpan
			$data['tampil_data_pelanggan']=$this->m_adm_tambah_complain->ambil_data_pelanggan();
			$data['tampil_data_pegawai']=$this->m_adm_tambah_complain->ambil_data_pegawai();
			$data['tampil_data_jenis_complain']=$this->m_adm_tambah_complain->ambil_data_jenis_complain();
			
			$this->load->view('admin/complain/v_adm_tambah_complain', $data,$pelanggan_id,$pegawai_id,$jenis_complain_id,$tgl_complain,$status);
		}
		public function hapus()
			{
				$this->load->helper('form');
				$this->load->model('admin/complain/m_adm_hapus_complain','',TRUE);	
				$idnya = $this->uri->segment(3);
				//panggil model "hapusdata"
				$this->m_adm_hapus_complain->hapusdata($idnya);
				//pesan data sukses
				$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil dihapus</div>');
				//alihkan ke halaman display
				redirect('c_adm_complain');
			}
		public function detail()
		{
			$this->load->helper('form');
			$this->load->model('admin/complain/m_adm_detail_complain','',TRUE);
			$this->load->library('form_validation');
			$idnya = $this->uri->segment(3);
			$data['tampil_data_pelanggan']=$this->m_adm_detail_complain->ambil_data_pelanggan();
			$data['tampil_data_pegawai']=$this->m_adm_detail_complain->ambil_data_pegawai();
			$data['tampil_data_jenis_complain']=$this->m_adm_detail_complain->ambil_data_jenis_complain();
			$data["pilih"] = $this->m_adm_detail_complain->detail_data($idnya);
			
			$idnya=$this->input->post('kode_complain');
			$pelanggan=$this->input->post('cbo_pelanggan');
			$pegawai=$this->input->post('cbo_pegawai');
			$jenis_complain=$this->input->post('cbo_jenis_complain');
			$tgl_complain=$this->input->post('tgl_complain');
			$status=$this->input->post('cbo_status');
			$tgl_perbaikan=$this->input->post('tgl_perbaikan');
			$btn_ubah = $this->input->post('btn_ubah');		
			
			$data["error"] = "";
			$data["act"] = "0";
			
			if($btn_ubah)
			{
				$data["act"] = "1";
				$this->form_validation->set_rules('cbo_pelanggan');
				$this->form_validation->set_rules('cbo_pegawai');
				$this->form_validation->set_rules('cbo_jenis_complain');
				$this->form_validation->set_rules('tgl_complain');
				$this->form_validation->set_rules('cbo_status');
				
				if($this->form_validation->run()==TRUE)
					{
						if(empty($pelanggan)||empty($pegawai)||empty($jenis_complain)||empty($tgl_complain)||empty($status))
						{
							$data["error"] = "Lengkapi Seluruh Data !";					
						}
						else
						{
							$ubah = $this->m_adm_detail_complain->ubah($idnya,$pelanggan,$pegawai,$jenis_complain,$tgl_complain,$status,$tgl_perbaikan);	
							if($ubah)
							{
								$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil diubah</div>');
				//alihkan ke halaman display
				redirect('c_adm_complain');	
							}
							
						}
						
					}
			}
			
			$this->load->view('admin/complain/v_adm_detail_complain',$data,$pelanggan,$pegawai,$jenis_complain,$tgl_complain,$status,$tgl_perbaikan);
		}
		public function ubah()
		{
			$this->load->helper(array('url','form'));
			$this->load->model('admin/complain/m_adm_ubah_complain','',TRUE);
			$this->load->library('form_validation','session');
			//jika btn_simpan di-klik
			if($this->input->post('btn_ubah'))
			{
				//setting pesan error
				
				$idnya = $this->uri->segment(3);
				//panggil model "ubahdata"
				$this->m_adm_ubah_complain->ubahdata($idnya);
				$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil diubah</div>');
				//alihkan ke halaman display
				redirect('c_adm_complain');
				
			}
		}
	}
	
?>