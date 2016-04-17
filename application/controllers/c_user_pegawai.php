<?php
	//buat class
	class C_user_pegawai extends CI_Controller {
		
		function __construct(){
		parent::__construct();
			$this->load->model('user/pegawai/m_user_tampil_pegawai','',TRUE);
		}
		
		function index(){
			$data['tampil_data']=$this->m_user_tampil_pegawai->ambil_data();
			$this->load->view('user/pegawai/v_user_tampil_pegawai',$data);
		}
		public function tambah()
		{
			$this->load->helper('form');
			$this->load->model('user/pegawai/m_user_tambah_pegawai','',TRUE);	
			$this->load->library('form_validation');
			$nama=$this->input->post('txt_nama');
			$tahun_masuk=$this->input->post('tahun_masuk');
			$alamat=$this->input->post('txt_alamat');
			$telepon=$this->input->post('txt_telepon');
			$jenis_kelamin=$this->input->post('rdb_jeniskelamin');
			$type=$this->input->post('cbo_type');
			$data['error'] = "";
			//jika btn_simpan di klik
			if($this->input->post('btn_simpan'))
			{
				//setting pesan error
				$this->form_validation->set_rules('txt_nama');
				$this->form_validation->set_rules('tahun_masuk');
				$this->form_validation->set_rules('txt_alamat');
				$this->form_validation->set_rules('txt_telepon');
				$this->form_validation->set_rules('rdb_jeniskelamin');
				$this->form_validation->set_rules('cbo_type');
				
				
				if($this->form_validation->run()==TRUE)
				{
					if(empty($nama)||empty($tahun_masuk)||empty($alamat)||empty($telepon)||empty($jenis_kelamin)||empty($type))
						{
							$data['error'] = "Lengkapi Seluruh Data !";					
						}
						else
						{
							//panggil model "simpandata"
							$simpan = $this->m_user_tambah_pegawai->simpandata($nama,$tahun_masuk,$alamat,$telepon,$jenis_kelamin,$type);
								if($simpan)
								{
								$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil ditambah</div>');
								//alihkan ke halaman display
								redirect('c_user_pegawai');
								}
								else
								{
									$data['error'] = "Data Sudah Pernah Tersimpan !";
								}
						}
				}
			}
			//tampil halaman simpan
			$this->load->view('user/pegawai/v_user_tambah_pegawai',$data,$nama,$tahun_masuk,$alamat,$telepon,$jenis_kelamin,$type);
		}
		public function hapus()
			{
				$this->load->helper('form');
				$this->load->model('user/pegawai/m_user_hapus_pegawai','',TRUE);	
				$idnya = $this->uri->segment(3);
				//panggil model "hapusdata"
				$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil dihapus</div>');
				$this->m_user_hapus_pegawai->hapusdata($idnya);
				
				//alihkan ke halaman display
				redirect('c_user_pegawai');
			}
		public function detail()
		{
			$this->load->helper('form');
			$this->load->model('user/pegawai/m_user_detail_pegawai','',TRUE);
			$idnya = $this->uri->segment(3);
			$data["pilih"] = $this->m_user_detail_pegawai->detail_data($idnya);
			$this->load->view('user/pegawai/v_user_detail_pegawai',$data);
		}
		public function ubah()
		{
			$this->load->helper('form');
			$this->load->model('user/pegawai/m_user_ubah_pegawai','',TRUE);
			$this->load->library('form_validation');
			$idnya = $this->uri->segment(3);
			$data["pilih"] = $this->m_user_ubah_pegawai->detail_data($idnya);
			$idnya=$this->input->post('kode_pegawai');
			$nama=$this->input->post('txt_nama');
			$alamat=$this->input->post('txt_alamat');
			$telepon=$this->input->post('txt_telepon');
			$jenis_kelamin=$this->input->post('rdb_jeniskelamin');
			$type=$this->input->post('cbo_type');
			
			$data["error"] = "";
			$data["act"] = "0";
			
			//jika btn_simpan di-klik
			if($this->input->post('btn_ubah'))
			{
				$data["act"] = "1";
				$this->form_validation->set_rules('txt_nama');
				$this->form_validation->set_rules('txt_alamat');
				$this->form_validation->set_rules('txt_telepon');
				$this->form_validation->set_rules('cbo_type');
				
				if($this->form_validation->run()==TRUE)
				{
					if(empty($nama)||empty($alamat)||empty($telepon)||$type == "0")
					{
						//setting pesan error
						$data["error"] = "Lengkapi Seluruh Data !";	
					}
					else
					{
						//panggil model "ubahdata"
						$ubah = $this->m_user_ubah_pegawai->ubahdata($idnya,$nama,$alamat,$telepon,$jenis_kelamin,$type);
						if($ubah)
						{
						$this->session->set_flashdata('message', '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Data berhasil diubah</div>');
						
						//alihkan ke halaman display
						redirect('c_user_pegawai');
						}
						else
						{
							$data['error'] = "Data Sudah Pernah Tersimpan !";
						}
					}
				}
			}
			$this->load->view('user/pegawai/v_user_detail_pegawai',$data,$nama,$alamat,$telepon,$jenis_kelamin,$type);
		}
	}
	
?>