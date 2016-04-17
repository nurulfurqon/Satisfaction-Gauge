<?php
class m_adm_report_perorangan extends Ci_Model{
	
	function ambil_data_pelanggan(){
			$this->db->select("*");
			$this->db->from("tb_pelanggan");							
			$this->db->order_by("nama","ASC");	
										
			$query = $this->db->get('');
			return $query;	
		}
	
	function laporanTahunan()
	{
		$query=$this->db->query("SELECT id,nama FROM tb_jenis_complain order by nama");
		$bc = $this->db->query("
		
		select
		ifnull((SELECT sum(jenis_complain_id)	FROM	(tb_complain)WHERE((jenis_complain_id)=1 AND (Month(tanggal_complain)=1)AND (YEAR(tanggal_complain)=2015))),0) AS `Januari`,
		ifnull((SELECT sum(jenis_complain_id)	FROM	(tb_complain)WHERE((jenis_complain_id)=1 AND(Month(tanggal_complain)=2)AND (YEAR(tanggal_complain)=2015))),0) AS `Februari`,
		ifnull((SELECT sum(jenis_complain_id)	FROM	(tb_complain)WHERE((jenis_complain_id)=1 AND(Month(tanggal_complain)=3)AND (YEAR(tanggal_complain)=2015))),0) AS `Maret`,
		ifnull((SELECT sum(jenis_complain_id)	FROM	(tb_complain)WHERE((jenis_complain_id)=1 AND(Month(tanggal_complain)=4)AND (YEAR(tanggal_complain)=2015))),0) AS `April`,
		ifnull((SELECT sum(jenis_complain_id)	FROM	(tb_complain)WHERE((jenis_complain_id)=1 AND(Month(tanggal_complain)=5)AND (YEAR(tanggal_complain)=2015))),0) AS `Mei`,
		ifnull((SELECT sum(jenis_complain_id)	FROM	(tb_complain)WHERE((jenis_complain_id)=1 AND(Month(tanggal_complain)=6)AND (YEAR(tanggal_complain)=2015))),0) AS `Juni`,
		ifnull((SELECT sum(jenis_complain_id)	FROM	(tb_complain)WHERE((jenis_complain_id)=1 AND(Month(tanggal_complain)=7)AND (YEAR(tanggal_complain)=2015))),0) AS `Juli`,
		ifnull((SELECT sum(jenis_complain_id)	FROM	(tb_complain)WHERE((jenis_complain_id)=1 AND(Month(tanggal_complain)=8)AND (YEAR(tanggal_complain)=2015))),0) AS `Agustus`,
		ifnull((SELECT sum(jenis_complain_id)	FROM	(tb_complain)WHERE((jenis_complain_id)=1 AND(Month(tanggal_complain)=9)AND (YEAR(tanggal_complain)=2015))),0) AS `September`,
		ifnull((SELECT sum(jenis_complain_id)	FROM	(tb_complain)WHERE((jenis_complain_id)=1 AND(Month(tanggal_complain)=10)AND (YEAR(tanggal_complain)=2015))),0) AS `Oktober`,
		ifnull((SELECT sum(jenis_complain_id)	FROM	(tb_complain)WHERE((jenis_complain_id)=1 AND(Month(tanggal_complain)=11)AND (YEAR(tanggal_complain)=2015))),0) AS `November`,
		ifnull((SELECT sum(jenis_complain_id)	FROM	(tb_complain)WHERE((jenis_complain_id)=1 AND(Month(tanggal_complain)=12)AND (YEAR(tanggal_complain)=2015))),0) AS `Desember`
	from tb_complain INNER JOIN tb_jenis_complain ON tb_jenis_complain.id = tb_complain.jenis_complain_id GROUP BY YEAR(tanggal_complain) 
		
		");
		
		return array($bc,$query);
		
	}
	
	
}

?>