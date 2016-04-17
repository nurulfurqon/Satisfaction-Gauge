<?php
	class C_user_home extends CI_Controller
	{
		function index()
		{
		
			$this->load->helper('form');
			$this->load->view('user/home/v_user_tampil_home');
		}
		
	
	}

?>