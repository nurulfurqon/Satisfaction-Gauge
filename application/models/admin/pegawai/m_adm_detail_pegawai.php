<?php
	class M_adm_detail_pegawai extends CI_Model
	{
		public function detail_data($idnya)
		{
			$detail = $this->db->query("SELECT * FROM tb_pegawai WHERE md5(sha1(kode_pegawai)) = '$idnya'");
			$baris = $detail->row();
			return $baris;
		}
	}
?>