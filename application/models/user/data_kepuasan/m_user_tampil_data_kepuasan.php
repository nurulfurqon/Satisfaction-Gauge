<?php
	class M_user_tampil_data_kepuasan extends CI_Model{
		
		function ambil_data(){
			$query=$this->db->query("SELECT a.id,b.nama,a.pengukuran FROM tb_data_kepuasan a,tb_jenis_complain b WHERE a.jenis_complain_id = b.id ORDER BY b.nama");//iner join ke tabel pegawai on user tabel user.pegawai_id=tb_pegawai.id kode_pegawai.nama
			return $query;
		}
	}
?>