<?php
	class M_adm_detail_complain extends CI_Model
	{
		function ambil_data_pelanggan(){
			$this->db->select("*");
			$this->db->from("tb_pelanggan");							
			$this->db->order_by("nama","ASC");	
										
			$query = $this->db->get('');
			return $query;	
		}
		function ambil_data_pegawai(){
			$this->db->select("*");
			$this->db->from("tb_pegawai");							
			$this->db->order_by("nama","ASC");	
									
			$query = $this->db->get('');
			return $query;	
		}
		function ambil_data_jenis_complain(){
			$this->db->select("*");
			$this->db->from("tb_jenis_complain");							
			$this->db->order_by("nama","ASC");	
										
			$query = $this->db->get('');
			return $query;	
		}
		
		public function detail_data($idnya)
		{
			$detail = $this->db->query("SELECT * ,tb_pegawai.nama as nama_pegawai,tb_pelanggan.nama as nama_pelanggan  FROM tb_complain INNER JOIN  tb_pelanggan ON tb_pelanggan.id = tb_complain.pelanggan_id INNER JOIN tb_pegawai ON tb_pegawai.id = tb_complain.pegawai_id INNER JOIN tb_jenis_complain ON tb_jenis_complain.id = tb_complain.jenis_complain_id WHERE md5(sha1(kode_complain)) = '$idnya'");
			$baris = $detail->row();
			return $baris;
		}
		public function ubah($idnya,$pelanggan,$pegawai,$jenis_complain,$tgl_complain,$status,$tgl_perbaikan)
		{
			
			
			$tgl_complain = date("Y,m,d", strtotime("$tgl_complain"));
			$tgl_p = explode('-',$tgl_perbaikan);
			if(count($tgl_p) == 3) 
			{
				$tgl_perbaikan = $tgl_p[0].'-'.$tgl_p[1].'-'.$tgl_p[2];
			}
			
			//ubah data
			$ubah=$this->db->query("UPDATE tb_complain SET pelanggan_id = '$pelanggan', pegawai_id = '$pegawai', jenis_complain_id = '$jenis_complain', tanggal_complain = '$tgl_complain', status = '$status', tanggal_perbaikan = '$tgl_perbaikan' WHERE md5(sha1(kode_complain)) = '$idnya'");
			return true;
				
		}
	}
?>