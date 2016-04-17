<?php
	class M_adm_tambah_user extends CI_Model
	{
		function ambil_data(){
			$this->db->select("*");
			$this->db->from("tb_pegawai");							
			$this->db->order_by("nama","ASC");	
										
			$query = $this->db->get('');
			return $query;	
		}
		public function simpandata($id,$txt_kodepegawai,$txt_username,$txt_password)
		{
			$cek = $this->db->query("SELECT username FROM tb_user WHERE pegawai_id = '$txt_kodepegawai'");
			
			if($cek->num_rows !=0)
			{
				return false;
			}			
			else
			{		
			//simpan data
			$simpan=$this->db->query("INSERT INTO tb_user VALUES('$id','$txt_kodepegawai','$txt_username','$txt_password')");
			return true;
			}
		}
	}


?>