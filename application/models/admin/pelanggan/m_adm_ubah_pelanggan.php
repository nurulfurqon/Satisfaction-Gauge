<?php
	class M_adm_ubah_pelanggan extends CI_Model
	{
		public function detail_data($idnya)
		{
			$detail = $this->db->query("SELECT * FROM tb_pelanggan WHERE md5(sha1(id_pelanggan)) = '$idnya'");
			$baris = $detail->row();
			return $baris;
		}
		
		public function ubahdata($idnya,$nama,$alamat,$telepon)
		{
			
			$jenis_kelamin=$this->input->post('rdb_jeniskelamin');
			
			$cek = $this->db->query("SELECT nama, alamat, telepon FROM tb_pelanggan WHERE nama = '$nama' AND alamat = '$alamat' AND telepon = '$telepon' AND md5(sha1(id_pelanggan)) != '$idnya'");
			
			if($cek->num_rows !=0)
			{
				return false;
			}			
			else
			{
			//ubah data
			$ubah=$this->db->query("UPDATE tb_pelanggan SET  nama = '$nama', alamat = '$alamat', telepon = '$telepon', jenis_kelamin = '$jenis_kelamin' WHERE md5(sha1(id_pelanggan)) = '$idnya'");
			return true;
			}
		}
	}


?>