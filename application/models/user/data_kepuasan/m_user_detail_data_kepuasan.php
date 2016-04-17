<?php
	class M_user_detail_data_kepuasan extends CI_Model
	{
		function ambil_data(){
			$this->db->select("*");
			$this->db->from("tb_jenis_complain");							
			$this->db->order_by("nama","ASC");	
										
			$query = $this->db->get('');
			return $query;	
		}
		
		public function detail_data($idnya)
		{
			$detail = $this->db->query("SELECT a.id,a.jenis_complain_id,a.pengukuran,b.nama FROM tb_data_kepuasan a, tb_jenis_complain b  WHERE md5(sha1(a.id)) = '$idnya' AND b.id = a.jenis_complain_id");
			$baris = $detail->row();
			return $baris;
		}
		
		public function ubahdata($idnya,$jenis_complain,$pengukuran)
		{
		
			$cek = $this->db->query("SELECT pengukuran FROM tb_data_kepuasan WHERE pengukuran = '$pengukuran' and md5(sha1(id)) != '$idnya'");
			
			if($cek->num_rows !=0)
			{
				return false;
			}			
			else
			{
			//ubah data
			$ubah=$this->db->query("UPDATE tb_data_kepuasan SET pengukuran = '$pengukuran' WHERE md5(sha1(id)) = '$idnya'");
			return true;
			}
		}
	}
?>