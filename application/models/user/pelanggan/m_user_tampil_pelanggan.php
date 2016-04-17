<?php
	class M_user_tampil_pelanggan extends CI_Model{
		
		function tampil($perpage,$uri)
		{
			$txt_cari =$this->input->post('txt_cari');
			//jika 'txt_cari' kosong						
			if (empty($txt_cari))
			{		
			$this->db->select('*');
			$this->db->from('tb_pelanggan');
			$this->db->order_by('id_pelanggan','ASC');
			
			}
			
			//jika 'txt_cari' tidak kosong
			else
			{				
				$this->db->select("*");
				$this->db->from("tb_pelanggan");
				$this->db->where("nama LIKE '%$txt_cari%' OR id_pelanggan LIKE '%$txt_cari%'");
				//$this->db->where("nama LIKE '%$txt_cari%'");				
				$this->db->order_by("id_pelanggan","ASC");
				
			}	
			$query = $this->db->get('',$perpage,$uri);
			return $query;	
		}
		
	}
?>