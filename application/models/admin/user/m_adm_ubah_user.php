<?php
	class M_adm_ubah_user extends CI_Model
	{
		public function ubahdata($idnya)
		{
			$idnya=$this->input->post('pegawai_id');
			$username=$this->input->post('txt_username');
			$password=$this->input->post('txt_password');
		
			//ubah data
			$ubah=$this->db->query("UPDATE tb_user SET username = '$username', password = '$password' WHERE pegawai_id = '$idnya'");
				
		}
	}


?>