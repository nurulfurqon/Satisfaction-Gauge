<?php
	class M_adm_tampil_pegawai extends CI_Model{
		
		function ambil_data(){
			$query=$this->db->query("select * from tb_pegawai order by kode_pegawai");
			return $query;
		}
	}
?>