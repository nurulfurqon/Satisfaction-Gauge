<?php	
	//buat class
	class C_adm_logout extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();			
			$this->load->helper(array('url','form'));						
			$this->load->library(array('session','user_agent','form_validation','pagination'));
		}				
		
		function index()
		{										
			$this->session->unset_userdata('ses_sts_id');
			$this->session->unset_userdata('ses_sts_nama');
		
			//$this->session->sess_destroy();
			redirect('c_adm_login');							
		}				
	}
?>