<?php

class C_user_report_keseluruhan extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('user/report/m_user_report_keseluruhan','',TRUE);
		$this->load->database();
		$this->load->helper('url');
	}
	
	public function index()
	{
		$bc=$this->m_user_report_keseluruhan->laporanTahunan();
		
		foreach( $bc[1]->result_array() as $row)
		{
			$data['tes'][]= array ($row['id'],$row['nama']);
			
		}
		
		$this->load->view('user/report/v_user_tampil_report_keseluruhan',$data);
		//print_r($data); exit; cara ngecek 
	}
}
?>