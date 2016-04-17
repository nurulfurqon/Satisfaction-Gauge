<?php
	class M_adm_tampil_user extends CI_Model{
		
		function ambil_data(){
			$query=$this->db->query("SELECT *,tb_user.id as id_user FROM tb_user INNER JOIN tb_pegawai ON tb_pegawai.id = tb_user.pegawai_id  order by pegawai_id");//iner join ke tabel pegawai on user tabel user.pegawai_id=tb_pegawai.id kode_pegawai.nama
			return $query;
		}
	}
?>