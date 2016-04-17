<?php
	class M_adm_ubah_jenis_complain extends CI_Model
	{
		public function ubahdata($idnya)
		{
			$idnya=$this->input->post('nama');
			$jeniscomplain=$this->input->post('txt_jeniscomplain');
			$point=$this->input->post('txt_point');
		
			//ubah data
			$ubah=$this->db->query("UPDATE tb_jenis_complain SET nama = '$jeniscomplain', point = '$point' WHERE nama = '$idnya'");
				
		}
	}


?>