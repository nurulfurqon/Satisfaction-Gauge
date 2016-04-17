<?php
	class M_adm_detail_user extends CI_Model
	{
		public function detail_data($idnya)
		{
			$detail = $this->db->query("SELECT * FROM tb_user INNER JOIN  tb_pegawai ON tb_pegawai.id = tb_user.pegawai_id WHERE md5(sha1(pegawai_id)) = '$idnya'");
			$baris = $detail->row();
			return $baris;
		}
		function ubah($idnya,$txt_username,$txt_password)
		{
			$txt_namapegawai = $this->input->post('txt_namapegawai');
			$ubah=$this->db->query("UPDATE tb_user SET username = '$txt_username', password = '$txt_password' WHERE md5(sha1(pegawai_id)) = '$idnya'");
			return true;
		}
	}
?>