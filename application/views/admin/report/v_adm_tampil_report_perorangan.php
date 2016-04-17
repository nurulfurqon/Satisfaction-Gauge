<?php
	//jika session kosong
	if(!$this->session->userdata('ses_sts_nama'))
	{
		//arahkan ke halaman login
		redirect('c_adm_login');
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap -->
<link href="<?php echo base_url(); ?>asset/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>asset/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>asset/bootstrap/css/simple.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>asset/css/loading.css" rel="stylesheet" type="text/css">
    <title>Report Complain perorangan</title>
</head>
    <style>
		#chart
		{
			z-index:-10;
		}
		
</style>
<body>
<div class="body">
<!-- Static navbar -->
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Pengukur Kepuasan</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li ><a href="<?php echo site_url ("c_adm_pegawai");?>" >Pegawai</a></li>
            <li ><a href="<?php echo site_url ("c_adm_pelanggan");?>">Pelanggan</a></li>
            <li ><a href="<?php echo site_url ("c_adm_use");?>">User</a></li>
            <li><a href="<?php echo site_url ("c_adm_jenis_complain");?>">Jenis Complain</a></li>
            <li><a href="<?php echo site_url ("c_adm_data_kepuasan");?>">Data Kepuasan</a></li>
            <li><a href="<?php echo site_url ("c_adm_complain");?>">Complain</a></li>
            <li class="dropdown active">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Report <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li class="active"><a href="<?php echo site_url ("c_adm_report_perorangan");?>">Perorangan</a></li>
                <li><a href="<?php echo site_url ("c_adm_report_keseluruhan");?>">Keseluruhan</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url ("c_adm_logout");?>"><span class="glyphicon glyphicon-off"></span> logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	<br/>
    <br/>  
	<div class="container" style="border-bottom:solid 1px #cacaca;">
	<div class="row">
				<div class="page-header font_ku body">
					<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Report Complain Perorangan
				</div>
				<br/>
				<br/>
				<div class="col-md-2">
					<div class="panel panel-default" style="border-radius:3; ">
					<div class="menu_head navbar-inverse"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Pilih Berdasarkan</div>
					<form action="<?php echo site_url('c_adm_report_perorangan')?>" method="post">
						<div class="form-group">
							<div class="col-sm-12">
								<select name="txt_cari_nama" class="form-control input-sm" id="cbo_pelanggan">
										<option value="#" selected="selected">- Pelanggan -</option>
											<?php
												foreach($tampil_data_pelanggan->result() as $baris)
												{
											?>
										<option value="<?php echo $baris->id;?>" ><?php echo $baris->nama;?></option>
											<?php
							
												}
											?>
									</select>
							</div>
						</div>
						<br/>
						<br/>
					
						<div class="form-group">
							<div class="col-sm-12">
								<select name="txt_cari" class="form-control input-sm" >
									<?php $thn_skr = date('Y'); ?>
									<option value="0">- Tahun -</option>
									<?php
									$thn_skr = date('Y');
									for ($x=$thn_skr; $x>=2009; $x--) 
									{
									?>
										<option value="<?php echo $x ?>"><?php echo $x ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
						<br/>
						<br/>
						<div class="form-group">
						<div class="col-sm-12 ">
								<input type="submit" name="btn_cari" id="btn_cari" class="btn btn-success btn-bolck form-control" value="Filter" />
						</div>
						</div>
					</form>
					<br/>
					<br/>
				</div>
				</div>
	
	<div class="col-md-10">
	
<?php if($this->input->post('btn_cari'))
			{
				?>
<div id="chart"></div>
<script type="text/javascript" src="<?php echo base_url();?>asset/highcharts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/highcharts/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/highcharts/modules/exporting.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/highcharts/themes/skies.js"></script>

			<script type="text/javascript">
            jQuery(function(){
                new Highcharts.Chart({
                    chart: {
                        renderTo: 'chart',
                        type: 'column',
                    },
                    title: {
                        text: 'Report Complain Perorangan',
                        x: -20
                    },
                    subtitle: {
                        text: 'Total point complain dalam tiap bulan',
                        x: -20
                    },
                    xAxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                                'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des']
                    },
                    yAxis: {
                        title: {
                            text: 'Point Complain'
                        }
                    },
                    series: 
                    [
                    
                    <?php foreach($tes as $nama):?>
                    {
                        name: '<?php echo $nama[1] ?>',
                        
                        <?php 
                        for ($i=1; $i<=12; $i++)
                    {
                        $src = $this->input->post('txt_cari');
                        $key = $this->input->post('txt_cari_nama');
                        
                        $bc = $this->db->query("
                            select sum(point) as nilai from tb_complain 
                            INNER JOIN tb_jenis_complain ON tb_jenis_complain.id = tb_complain.jenis_complain_id 
                            WHERE jenis_complain_id = {$nama[0]} AND pelanggan_id = '$key'  AND (Month(tanggal_complain)=$i)AND (YEAR(tanggal_complain)) = '$src' 
                        ");
                        
                
                        foreach( $bc->result() as $value)
                        {
                            $val[]=	strlen($value->nilai) >0? (int) $value->nilai:0;
                            
                        }
                    }
                        
                        
                        ?>
                        
                        data: <?php echo json_encode($val); ?>
                    },
                    <?php $val=array(); endforeach?>
                    
                    ]
                
                });
            }); 
            </script>
			
		
		</div>
        <!--- <h3><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Keterangan :</h3> -->
                    <br />
						<?php $dt_kepuasan = $this->db->query("SELECT b.jenis_complain_id, b.pengukuran, c.nama FROM tb_data_kepuasan b,tb_complain a, tb_jenis_complain c WHERE c.id = a.jenis_complain_id AND b.jenis_complain_id = a.jenis_complain_id AND a.pelanggan_id = '$key' AND  (YEAR(a.tanggal_complain)) = '$src' AND b.pengukuran LIKE '%perorangan%';");?>
                         <?php foreach( $dt_kepuasan->result() as $kepuasan)
                                   {
                            ?>
                            
                            <p><b>
							
							<?php $tes = array($kepuasan->nama,$kepuasan->pengukuran); 
                                $coba = str_replace('perorangan','',$tes[1]);
                            ?>
                            <?php echo $tes[0]?></b></p> <p style="color:#F00;"><?php echo $coba ?><br/></p>
                            <?php
                                       
                                   }
                            ?>	
		<?php
			}
		?>
</div>
<br/>
<br/>
</div>

<?php $this->load->view('admin/menu/footer');?>
