<?php
	class M_user_tampil_jenis_complain extends CI_Model{
		
		function ambil_data(){
			$query=$this->db->query("SELECT *,tb_jenis_complain.id as id_jenis_complain FROM tb_jenis_complain order by nama");
			return $query;
		}
	}
?>