<?php

class C_user_report_perorangan extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('user/report/m_user_report_perorangan','',TRUE);
		$this->load->database();
		$this->load->helper('url');
	}
	
	public function index()
	{
		$bc=$this->m_user_report_perorangan->laporanTahunan();
		
		foreach( $bc[1]->result_array() as $row)
		{
			$data['tes'][]= array ($row['id'],$row['nama']);
			
		}
		
		$data['tampil_data_pelanggan']=$this->m_user_report_perorangan->ambil_data_pelanggan();
		
		$this->load->view('user/report/v_user_tampil_report_perorangan',$data);
		//print_r($data); exit; cara ngecek 
	}
}
?>