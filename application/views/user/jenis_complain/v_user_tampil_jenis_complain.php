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
<title>Tampil Jenis Complain</title>

</head>

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
				   <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Daftar <small>Jenis Complain</small>
				   
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
							<div class="col-md-4 col-md-offset-4 col">
								<center>
									<p class="text-success"><?php echo $this->session->flashdata('message');?></p>
								</center>
							</div>
							<div class="clear"></div>
							<br/>
                            <div class="col-md-2" style="padding:0 0 0 0; margin-bottom:1.5%;">
                                <h4 >
                                    <a href="<?php echo site_url ("c_user_jenis_complain/tambah");?>" class="btn btn1 red" style="text-decoration:none; color:#FFF; "><span class="glyphicon glyphicon-plus-sign"></span> Tambah Data</a>
                                </h4>
                            </div>
                            <div class="clear"></div>
							<div class="table-responsive body_table font_isi">  
								<table class="table table-bordered table-hover table-striped" width="100%" >
                                <thead class="#" >
                                    <tr>
                                        <td width="5%" align="center"><b>No</b></td>
                                        <td width="60%" align="center"><b>Jenis Complain</b></td>
                                        <td width="21%" align="center"><b>Point</b></td>
                                        <td width="14%"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $no = 1;
                                    foreach($tampil_data->result() as $baris)
                                    {
                                  ?>
                                  
                                    <tr>
                                        <td align="center" id="isi_tb"><?php echo $no;?></td> 
                                        <td id="isi_tb"><?php echo $baris->nama;?></td>
                                        <td id="isi_tb"><?php echo $baris->point;?></td>
                                     
                                        <td align="center"> <button type="button" name="btn_ubah" class="btn btn1 red" style="text-decoration: none;" onClick="location.href=('<?php echo $baris->nama ?>','<?php echo site_url("c_user_jenis_complain/detail/".md5(sha1($baris->nama)));?>');" data-toggle="tooltip" data-placement="top" title="Detail Data"><span class="glyphicon glyphicon-edit"></span></button>
                                        
                                        <button type="button" name="btn_hapus" class="btn btn1 red" style="text-decoration: none;" onclick="return hapus_data('<?php echo $baris->nama ?>','<?php echo site_url("c_user_jenis_complain/hapus/".$baris->id_jenis_complain);?>');" data-toggle="tooltip" data-placement="top" title="Hapus Data"><span class="glyphicon glyphicon-trash"></span></button>
                                        </td>
                                    </tr>
                                  
                                  <?php
                                    $no++;	
                                    }
                                  ?>
                                </tbody>
                            </table>
							  <br/>
							  <br/>
							  <br/>
						  </div>
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
    <script src="<?php echo base_url();?>asset/bootstrap/js/transition.js"></script>
	<script src="<?php echo base_url();?>asset/bootstrap/js/tooltip.js"></script>

<!-- JavaScript Test -->
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<script>
	function hapus_data(kode,url)
	{
		pesan = confirm ("Data "+kode+" Ingin Dihapus ?");
		if(pesan == true)
		{
			location.href=url;
			return true;
		}
		else
		{
			
			return false;
		}
	}
</script>
</body>
</html>