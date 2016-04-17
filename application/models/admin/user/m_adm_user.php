<?php
	class M_adm_user extends CI_Model{
		
		function id_otomatis(&$idnya)
		{
			$cek=$this->db->query("SELECT id FROM tb_user ORDER BY id DESC");
			 
			if ($cek->num_rows()==0)
			{				
				$id = 1;			
			}			
			else
			{
				$row = $cek->row();				
				$id =$row->id+1;
			
			}
			$idnya = $id;						
		}
						
		function tampil(){
			$query=$this->db->query("select * from tb_user order by pegawai_id");
			return $query;
		}
		
		function tampil_pegawai()		
		{						
			$this->db->select("*");
			$this->db->from("tb_pegawai");							
			$this->db->order_by("kode_pegawai","ASC");	
										
			$query = $this->db->get('');
			return $query;												
		}
		
		function simpan($cbo_kodepegawai,$txt_username,$txt_password)
		{
			$cek = $this->db->query("SELECT id FROM tb_pegawai WHERE id = '$cbo_kodepegawai'");	
			if($cek->num_rows !=0)
			{
				return false;
			}			
			else
			{			
				$txt_id = "";
				$this->id_otomatis($txt_id);				
				$simpan=$this->db->query("INSERT INTO tb_user VALUES('$txt_id', '$cbo_kodepegawai', '$txt_username', '$txt_password')");			
				return true;
			}				
		}
	}
?>