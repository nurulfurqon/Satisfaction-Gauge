<?php
	class M_adm_ubah_complain extends CI_Model
	{
		public function ubahdata($idnya)
		{
			$idnya=$this->input->post('kode_complain');
			$pelanggan=$this->input->post('cbo_pelanggan');
			$pegawai=$this->input->post('cbo_pegawai');
			$jenis_complain=$this->input->post('cbo_jenis_complain');
			$tgl_complain=$this->input->post('tgl_complain');
			$status=$this->input->post('cbo_status');
			$tgl_perbaikan=$this->input->post('tgl_perbaikan');
			
			$tgl_complain = date("Y,m,d", strtotime("$tgl_complain"));
			$tgl_p = explode('-',$tgl_perbaikan);
			if(count($tgl_p) == 3) 
			{
				$tgl_perbaikan = $tgl_p[2].'-'.$tgl_p[1].'-'.$tgl_p[0];
			}
			
			//ubah data
			$ubah=$this->db->query("UPDATE tb_complain SET pelanggan_id = '$pelanggan', pegawai_id = '$pegawai', jenis_complain_id = '$jenis_complain', tanggal_complain = '$tgl_complain', status = '$status', tanggal_perbaikan = '$tgl_perbaikan' WHERE kode_complain = '$idnya'");
				
		}
	}


?>