<?php
	class M_adm_tambah_data_kepuasan extends CI_Model
	{
		function ambil_data(){
			$this->db->select("*");
			$this->db->from("tb_jenis_complain");							
			$this->db->order_by("nama","ASC");	
										
			$query = $this->db->get('');
			return $query;	
		}
		public function simpandata($jenis_complain,$pengukuran)
		{
			$id=$this->input->post('id');
			$cek = $this->db->query("SELECT jenis_complain_id, pengukuran FROM tb_data_kepuasan WHERE jenis_complain_id = '$jenis_complain' AND pengukuran = '$pengukuran'");
			
			if($cek->num_rows !=0)
			{
				return false;
			}			
			else
			{		
			//simpan data
			$simpan=$this->db->query("INSERT INTO tb_data_kepuasan VALUES('$id','$jenis_complain','$pengukuran')");
			return true;
			}
		}
	}


?>