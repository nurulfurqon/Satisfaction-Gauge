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
<title>Home</title>
</head>

<body>
<?php

	$this->load->view('user/menu/menu');

?>
<div id="MainContent">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row" style="margin-bottom:235px;">
			<div class="col-lg-12">
				<h1 class="page-header">
				   <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home
				   
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
							<h2><p class="font_light" style="line-height:40px;">Selamat Datang <b class="font_bold"><?php echo $this->session->userdata('ses_user_nama'); ?></b> <br/>Di Aplikasi Pengukur Kepuasan Pelanggan</p></h2>
							<div class="garis"></div>
							<p style="line-height:25px;">Apliksi ini di buat untuk membantu pegawai <br />dalam menangani complain dari pelanggan dan aplikasi ini bisa<br />membantu mengevaluasi complain yang diberikan oleh pelanggan </p>
							
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