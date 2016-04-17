<?php
	class M_adm_detail_jenis_complain extends CI_Model
	{
		public function detail_data($idnya)
		{
			$detail = $this->db->query("SELECT * FROM tb_jenis_complain WHERE md5(sha1(nama)) = '$idnya'");
			$baris = $detail->row();
			return $baris;
		}
		public function ubahdata($idnya,$jeniscomplain,$point)
		{
			$cek = $this->db->query("SELECT nama FROM tb_jenis_complain WHERE nama = '$jeniscomplain' AND md5(sha1(nama)) != '$idnya'");
			
			if($cek->num_rows !=0)
			{
				return false;
			}			
			else
			{					
			//ubah data
				$ubah=$this->db->query("UPDATE tb_jenis_complain SET nama = '$jeniscomplain', point = '$point' WHERE md5(sha1(nama)) = '$idnya'");
				return true;
			}
		}
	}
?>