<?php
	class M_adm_hapus_complain extends CI_Model
	{
		public function hapusdata($idnya)
		{
			//$nip=$this->input->post('id_nip');
			
		
			//hapusdata
			$hapus=$this->db->query("DELETE FROM tb_complain WHERE kode_complain = '$idnya'");
				
		}
	}


?>