<?php
class M_adm_tambah_jenis_complain extends CI_Model
	{
		public function simpandata($jeniscomplain,$point)
		{
			$id=$this->input->post('id');
			
			$cek = $this->db->query("SELECT nama FROM tb_jenis_complain WHERE nama = '$jeniscomplain'");
			if($cek->num_rows !=0)
			{
				return false;
			}			
			else
			{		
			$simpan=$this->db->query("INSERT INTO tb_jenis_complain VALUES('$id','$jeniscomplain','$point')");
			return true;
			}
		}
	}
?>