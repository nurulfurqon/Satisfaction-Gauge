<?php
	class M_adm_hapus_data_kepuasan extends CI_Model
	{
		public function hapusdata($idnya)
		{
			//$nip=$this->input->post('id_nip');
			
		
			//hapusdata
			$hapus=$this->db->query("DELETE FROM tb_data_kepuasan WHERE id = '$idnya'");
				
		}
	}


?>