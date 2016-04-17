<?php
	//buat class
	class C_adm_user extends CI_Controller 
	{
		function __construct(){
			parent::__construct();
			$this->load->helper(array('url','form'));			
			$this->load->model('admin/user/m_adm_user','',TRUE);			
			$this->load->library(array('session','user_agent','form_validation','pagination'));
		}
		
		function index()
		{
			
			$data['tampil_data']=$this->m_adm_user->tampil();
			$this->load->view('admin/user/v_adm_tampil_user',$data);
		}
		
		function entry()
		{		
			$cbo_kodepegawai = $this->input->post('cbo_kodepegawai');						
			$txt_username = $this->input->post('txt_username');
			$txt_password = $this->input->post('txt_password');			
			$btn_simpan = $this->input->post('btn_simpan');
			
			$pesan["error"] = "";									
				
				if($btn_simpan)
				{
					$this->form_validation->set_rules('cbo_kodepegawai');
					$this->form_validation->set_rules('txt_username');
					$this->form_validation->set_rules('txt_password');
					
					if($this->form_validation->run()==TRUE)
					{
						if($cbo_kodepegawai == "0"||empty($txt_username)||empty($txt_password))
						{
							$pesan["error"] = "Lengkapi Seluruh Data !";
							
						}
						else
						{
							$simpan = $this->m_adm_user->simpan($cbo_kodepegawai,$txt_username,$txt_password);	
							if($simpan)
							{
								$pesan["error"] = "Data Berhasil Disimpan";	
							}
							else
							{
								$pesan["error"] = "Data Sudah Pernah Tersimpan !";
							}
						}
						redirect('c_adm_user');
					}
					
				}
				$data["tampil_pegawai"]=$this->m_adm_user->tampil_pegawai();
				$this->load->view('admin/user/v_adm_tambah_user',$pesan,$cbo_kodepegawai,$txt_username,$txt_password);
		}

	}
?>