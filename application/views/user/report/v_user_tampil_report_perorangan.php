<?php
	//jika session kosong
	if(!$this->session->userdata('ses_user_nama'))
	{
		//arahkan ke halaman login
		redirect('c_user_login');
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link href="<?php echo base_url(); ?>asset/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>asset/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>asset/bootstrap/css/simple.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>asset/css/loading.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>asset/css/user.css" rel="stylesheet" type="text/css">
    <title>Report Complain Perorangan</title>
</head>
    <style>
		#chart
		{
			z-index:-10;
		}
		
</style>
<body>
<?php

	$this->load->view('user/menu/menu');

?>    
<div id="MainContent">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row" style="margin-bottom:200px;">
			<div class="col-lg-12">
				<h1 class="page-header">
				   <span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Report <small>Complain Perorangan</small>
				   
				   <ul class="nav navbar-nav navbar-right" style="margin:1% 2% 0 0;">
					  <h5>
						<li><a href="<?php echo site_url ("c_user_logout");?>" style="text-decoration:none;"><span class="glyphicon glyphicon-off"></span> logout</a></li>
					  </h5>
				   </ul>
				</h1>
				<br />
				<header>
					<div class="header-content">
						<div class="header-content-inner">
							<div class="col-md-9">
								<form action="<?php echo site_url('c_user_report_perorangan')?>" method="post">
                                     
                                    <div class="form-group">
                                    	<label class="col-sm-3 control-label"><h4>Pilih Berdasarkan:</h4></label>
                                        <div class="col-sm-4">
                                            <select name="txt_cari_nama" class="form-control " id="cbo_pelanggan">
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
                                        <div class="col-sm-3">
                                            <select name="txt_cari" class="form-control" >
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
                                      	 <div class="col-sm-2"> 
                                         	<input type="submit" name="btn_cari" id="btn_cari" class="btn btn1 red form-control" value="Filter" />
                                         </div>
                                    </div>
                                    <br/>
                                    <br/>
                                    <br/>
                                 
                            	</form>
							</div>
                
				<div class="clear"></div>
                	<br/>
                    <br/>
                    <br/>
                    <div class="col-md-12">
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
                                        WHERE jenis_complain_id = {$nama[0]} AND (Month(tanggal_complain)=$i)AND pelanggan_id = '$key'  AND  (YEAR(tanggal_complain)) = '$src' 
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
                       
                    <br/>
                    <br/>	
                    </div>
                    <!----<h3><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Keterangan :</h3>--->
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
				</div>       
			</header>
		</div>
	</div>
		<!-- /.row -->
        
    </div>
</div>
<!-- Bootstrap core JavaScript -->
	<script src="<?php echo base_url(); ?>js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo base_url();?>asset/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>