<?php	
	//buat class
	class C_user_login extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();			
			$this->load->helper(array('url','form'));			
			$this->load->model('login/m_user_login','',TRUE);			
			$this->load->library(array('session','user_agent','form_validation','pagination'));
		}				
		
		function index()
		{										
			$txt_nama = $this->input->post('txt_nama');
			$txt_password = $this->input->post('txt_password');
			$btn_login = $this->input->post('btn_login');						
			
			$pesan["error"] = "";									
			
			if($btn_login)
			{
				$this->form_validation->set_rules('txt_nama');
				$this->form_validation->set_rules('txt_password');
				
				if($this->form_validation->run()==TRUE)
				{
					if(empty($txt_nama)||empty($txt_password))
					{
						$pesan["error"] = "Lengkapi Seluruh Data !";					
					}
					else
					{
						$cek = $this->m_user_login->cek($txt_nama,$txt_password);	
						if($cek == TRUE)
						{
							redirect('c_user_home');							
						}
						else
						{
							$pesan["error"] = "Username / Password Salah !";	
						}
					}
				}				
			}
			
			$this->load->view('login/v_user_login',$pesan,$txt_nama,$txt_password);							
		}		
		
	}
?>