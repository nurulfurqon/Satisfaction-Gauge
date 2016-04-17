<?php
	class M_adm_hapus_user extends CI_Model
	{
		public function hapusdata($idnya)
		{
			//$nip=$this->input->post('id_nip');
			
		
			//hapusdata
			$hapus=$this->db->query("DELETE FROM tb_user WHERE id = '$idnya'");
				
		}
	}


?>