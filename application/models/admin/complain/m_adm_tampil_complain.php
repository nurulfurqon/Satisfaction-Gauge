<?php
	class M_adm_tampil_complain extends CI_Model{
		
		function tampil($perpage,$uri)
		{
			$txt_cari =$this->input->post('txt_cari');
			//jika 'txt_cari' kosong						
			if (empty($txt_cari))
			{		
			$this->db->select('*,tb_pegawai.nama as nama_pegawai,tb_pelanggan.nama as nama_pelanggan');
			$this->db->from('tb_complain');
			$this->db->join('tb_pelanggan','tb_pelanggan.id=tb_complain.pelanggan_id','inner'); 
			$this->db->join('tb_pegawai','tb_pegawai.id=tb_complain.pegawai_id','inner');
			$this->db->join('tb_jenis_complain','tb_jenis_complain.id=tb_complain.jenis_complain_id','inner');  
			$this->db->order_by('kode_complain','ASC');
			
			}
			//jika 'txt_cari' tidak kosong
			else
			{				
				$this->db->select("*,tb_pegawai.nama as nama_pegawai,tb_pelanggan.nama as nama_pelanggan");
				$this->db->from('tb_complain','tb_pelanggan');
				$this->db->join('tb_pelanggan','tb_pelanggan.id=tb_complain.pelanggan_id','inner');
				$this->db->join('tb_pegawai','tb_pegawai.id=tb_complain.pegawai_id','inner'); 
				$this->db->join('tb_jenis_complain','tb_jenis_complain.id=tb_complain.jenis_complain_id','inner'); 
				$this->db->where("tb_pelanggan.nama LIKE '%$txt_cari%' OR tb_complain.kode_complain LIKE '%$txt_cari%'");
				//$this->db->where("nama LIKE '%$txt_cari%'");				
				$this->db->order_by("kode_complain","ASC");
				
			}	
		$query = $this->db->get('',$perpage,$uri);
			return $query;
		}
		
	}
?>