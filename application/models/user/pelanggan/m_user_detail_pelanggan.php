<?php
	class M_user_detail_pelanggan extends CI_Model
	{
		public function detail_data($idnya)
		{
			$detail = $this->db->query("SELECT * FROM tb_pelanggan WHERE md5(sha1(id_pelanggan)) = '$idnya'");
			$baris = $detail->row();
			return $baris;
		}
	}
?>