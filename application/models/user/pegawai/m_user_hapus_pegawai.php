<?php
	class M_user_hapus_pegawai extends CI_Model
	{
		public function hapusdata($idnya)
		{
			//$nip=$this->input->post('id_nip');
			
		
			//hapusdata
			$hapus=$this->db->query("DELETE FROM tb_pegawai WHERE kode_pegawai = '$idnya'");
				
		}
	}


?>