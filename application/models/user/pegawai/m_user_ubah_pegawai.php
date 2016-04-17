<?php
	class M_user_ubah_pegawai extends CI_Model
	{
		public function detail_data($idnya)
		{
			$detail = $this->db->query("SELECT * FROM tb_pegawai WHERE md5(sha1(kode_pegawai)) = '$idnya'");
			$baris = $detail->row();
			return $baris;
		}
		public function ubahdata($idnya,$nama,$alamat,$telepon,$jenis_kelamin,$type)
		{
			
			$cek = $this->db->query("SELECT nama, alamat, telepon FROM tb_pegawai WHERE nama = '$nama' AND alamat = '$alamat' AND telepon = '$telepon' AND md5(sha1(kode_pegawai)) != '$idnya'");
			
			if($cek->num_rows !=0)
			{
				return false;
			}			
			else
			{//ubah data
			$ubah=$this->db->query("UPDATE tb_pegawai SET nama = '$nama', alamat = '$alamat', telepon = '$telepon', jenis_kelamin = '$jenis_kelamin', type = '$type' WHERE md5(sha1(kode_pegawai)) = '$idnya'");
			return true;
			}
		}
	}


?>