<?php
	class M_user_tambah_pegawai extends CI_Model
	{
		public function simpandata($nama,$tahun_masuk,$alamat,$telepon,$jenis_kelamin,$type)
		{
			$id=$this->input->post();
			
			$kode_wilayah = "111";
			
			$masuk = substr($tahun_masuk,-2);
			
			$query = $this->db->query("SELECT MAX(RIGHT(kode_pegawai,4)) as code_max FROM tb_pegawai");
			$code = "";
			if($query->num_rows()>0){
			foreach ($query->result() as $cd) {
			$tmp = ((int)$cd->code_max)+1;
			$code = sprintf("%04s", $tmp);
			}
			}else{
			$code = "0001";
			}
			$kode_pegawai=$kode_wilayah.$masuk.$code;
			
			$cek = $this->db->query("SELECT nama, alamat, telepon FROM tb_pegawai WHERE nama = '$nama' AND alamat = '$alamat' AND telepon = '$telepon'");
			
			if($cek->num_rows !=0)
			{
				return false;
			}			
			else
			{
			//simpan data
			$simpan=$this->db->query("INSERT INTO tb_pegawai VALUES('$id','$kode_pegawai','$nama','$tahun_masuk','$alamat','$telepon','$jenis_kelamin','$type')");
			return true;
			}
		}
	}


?>