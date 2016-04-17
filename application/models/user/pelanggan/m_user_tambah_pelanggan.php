<?php
	class M_user_tambah_pelanggan extends CI_Model
	{
		public function simpandata($nama,$alamat,$telepon,$jenis_kelamin)
		{
			$id=$this->input->post();
			$tahun_sekarang = DATE('y');
						
			$query = $this->db->query("SELECT MAX(RIGHT(id_pelanggan,4)) as code_max FROM tb_pelanggan");
			$code = "";
			if($query->num_rows()>0){
			foreach ($query->result() as $cd) {
			$tmp = ((int)$cd->code_max)+1;
			$code = sprintf("%04s", $tmp);
			}
			}else{
			$code = "0001";
			}
			$id_pelanggan = $tahun_sekarang.$code;
			
			$cek = $this->db->query("SELECT nama, alamat, telepon FROM tb_pelanggan WHERE nama = '$nama' AND alamat = '$alamat' AND telepon = '$telepon'");
			
			if($cek->num_rows !=0)
			{
				return false;
			}			
			else
			{
			//simpan data
			$simpan=$this->db->query("INSERT INTO tb_pelanggan VALUES('$id','$id_pelanggan','$nama','$alamat','$telepon','$jenis_kelamin')");
			return true;
			}
		}
	}


?>