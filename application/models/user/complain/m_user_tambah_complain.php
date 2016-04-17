<?php
	class M_user_tambah_complain extends CI_Model
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
		
	
		public function simpandata($pelanggan_id,$pegawai_id,$jenis_complain_id,$tgl_complain,$status)
		{
			$id=$this->input->post('id');
			$kode_complain=$this->input->post('txt_kode_complain');
			
			$tgl_perbaikan=$this->input->post('tgl_perbaikan');
			$tahun_sekarang= DATE("y");
			
			$this->db->select("id_pelanggan");
			$this->db->from("tb_pelanggan");							
			$this->db->where("id = '$pelanggan_id'");	
								
			$query = $this->db->get('');
			foreach($query->result() as $baris){
			$pelanggan_kode = $baris->id_pelanggan;
			}
			$query = $this->db->query("SELECT MAX(RIGHT(kode_complain,4)) as code_max FROM tb_complain");
			$code = "";
			if($query->num_rows()>0){
			foreach ($query->result() as $cd) {
			$tmp = ((int)$cd->code_max)+1;
			$code = sprintf("%04s", $tmp);
			}
			}else{
			$code = "0001";
			}
			$kode_complain = $tahun_sekarang.$jenis_complain_id.$pelanggan_kode.$code;
			
			$tgl_complain = date("Y,m,d", strtotime("$tgl_complain"));
			$tgl_p = explode('-',$tgl_perbaikan);
			if(count($tgl_p) == 3) 
			{
				$tgl_perbaikan = $tgl_p[2].'-'.$tgl_p[1].'-'.$tgl_p[0];
			}
			
			//simpan data
			$simpan=$this->db->query("INSERT INTO tb_complain VALUES('$id','$kode_complain','$pelanggan_id','$pegawai_id','$jenis_complain_id','$tgl_complain','$status','$tgl_perbaikan')");
			return $simpan;
		}
	}


?>