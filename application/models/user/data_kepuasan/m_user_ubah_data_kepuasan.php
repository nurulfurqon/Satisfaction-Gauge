<?php
	class M_user_ubah_data_kepuasan extends CI_Model
	{
		public function ubahdata($idnya)
		{
			$idnya=$this->input->post('jenis_complain_id');
			$jenis_complain=$this->input->post('cbo_jenis_complain');
			$pengukuran=$this->input->post('txt_pengukuran');
		
			//ubah data
			$ubah=$this->db->query("UPDATE tb_data_kepuasan SET jenis_complain_id = '$jenis_complain', pengukuran = '$pengukuran' WHERE jenis_complain_id = '$idnya'");
				
		}
	}


?>