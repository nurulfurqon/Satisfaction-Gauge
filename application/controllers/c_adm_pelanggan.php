<?php
	//buat class
	class C_adm_pelanggan extends CI_Controller {
		
		
		function index($id=NULL){
			$this->load->helper(array('url','form'));
			$this->load->library(array('session','user_agent','form_validation','pagination'));
			$this->load->model('admin/pelanggan/m_adm_tampil_pelanggan','',TRUE);
			//$txt_cari = $this->input->post('txt_cari');	
			//$this->form_validation->set_rules('txt_cari');
				$txt_cari = $this->input->post('txt_cari');				
				$this->form_validation->set_rules('txt_cari');
								
				$query=$this->db->query("SELECT * FROM tb_pelanggan ORDER BY id_pelanggan");				
				$n = $query->num_rows();
				 
				$config["base_url"]=base_url().'c_adm_pelanggan/index';				
				$config["per_page"]=7;
				$config["total_rows"]=$n;
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
				
				
				$data["tampil"]=$this->m_adm_tampil_pelanggan->tampil($config['per_page'],$id);
				$data["no"]=$id;
				
				if($this->form_validation->run()==TRUE)
				{
										
				}
				
			$this->load->view('admin/pelanggan/v_adm_tampil_pelanggan',$data);
		}

		public function tambah()
		{
			$this->load->helper('form');
			$this->load->model('admin/pelanggan/m_adm_tambah_pelanggan','',TRUE);	
			$this->load->library('form_validation');
			$nama=$this->input->post('txt_nama');
			$alamat=$this->input->post('txt_alamat');
			$telepon=$this->input->post('txt_telepon');
			$jenis_kelamin=$this->input->post('rdb_jeniskelamin');
			$data['error'] = "";
			
			//jika btn_simpan di klik
			if($this->input->post('btn_simpan'))
			{
				//setting pesan error
				$this->form_validation->set_rules('txt_nama');
				$this->form_validation->set_rules('txt_alamat');
				$this->form_validation->set_rules('txt_telepon');
				$this->form_validation->set_rules('rdb_jeniskelamin');
				
				if($this->form_validation->run()==TRUE)
				{
					if(empty($nama)||empty($alamat)||empty($telepon)||empty($jenis_kelamin))
						{
							$data['error'] = "Lengkapi Seluruh Data !";					
						}
						else
						{
							//panggil model "simpandata"
							$simpan = $this->m_adm_tambah_pelanggan->simpandata($nama,$alamat,$telepon,$jenis_kelamin);
								if($simpan)
								{
								$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil ditambah</div>');
								//alihkan ke halaman display
								redirect('c_adm_pelanggan');
								}
								else
								{
									$data['error'] = "Data Sudah Pernah Tersimpan !";
								}
						}
				}
			}
			//tampil halaman simpan
			$this->load->view('admin/pelanggan/v_adm_tambah_pelanggan',$data,$nama,$alamat,$telepon,$jenis_kelamin);
		}
		public function hapus()
			{
				$this->load->helper('form');
				$this->load->model('admin/pelanggan/m_adm_hapus_pelanggan','',TRUE);	
				$idnya = $this->uri->segment(3);
				//panggil model "hapusdata"
				$this->m_adm_hapus_pelanggan->hapusdata($idnya);
				//pesan data sukses
				$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil dihapus</div>');
				//alihkan ke halaman display
				redirect('c_adm_pelanggan');
			}
		public function detail()
		{
			$this->load->helper('form');
			$this->load->model('admin/pelanggan/m_adm_detail_pelanggan','',TRUE);
			$idnya = $this->uri->segment(3);
			$data["pilih"] = $this->m_adm_detail_pelanggan->detail_data($idnya);
			$this->load->view('admin/pelanggan/v_adm_detail_pelanggan',$data);
		}
		public function ubah()
		{
			$this->load->helper('form');
			$this->load->model('admin/pelanggan/m_adm_ubah_pelanggan','',TRUE);
			$this->load->library('form_validation');
			$idnya = $this->uri->segment(3);
			$data["pilih"] = $this->m_adm_ubah_pelanggan->detail_data($idnya);
			$idnya=$this->input->post('id_pelanggan');
			$nama=$this->input->post('txt_nama');
			$alamat=$this->input->post('txt_alamat');
			$telepon=$this->input->post('txt_telepon');
			
			$data["error"] = "";
			$data["act"] = "0";
			
			//jika btn_simpan di-klik
			if($this->input->post('btn_ubah'))
			{
				$data["act"] = "1";
				$this->form_validation->set_rules('txt_nama');
				$this->form_validation->set_rules('txt_alamat');
				$this->form_validation->set_rules('txt_telepon');
				
				if($this->form_validation->run()==TRUE)
				{
					if(empty($nama)||empty($alamat)||empty($telepon))
					{
						//setting pesan error
						$data["error"] = "Lengkapi Seluruh Data !";	
					}
					else
					{
						//panggil model "ubahdata"
						$ubah = $this->m_adm_ubah_pelanggan->ubahdata($idnya,$nama,$alamat,$telepon);
						if($ubah)
						{
						$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil diubah</div>');
						
						//alihkan ke halaman display
						redirect('c_adm_pelanggan');
						}
						else
						{
							$data['error'] = "Data Sudah Pernah Tersimpan !";
						}
					}
				}
			}
			$this->load->view('admin/pelanggan/v_adm_detail_pelanggan',$data,$nama,$alamat,$telepon);
		}
	}
	
?>