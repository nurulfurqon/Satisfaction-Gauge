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
<title>Detail Pegawai</title>
<script language="javascript">
    function hanyaAngka(e, decimal) {
    var key;
    var keychar;
     if (window.event) {
         key = window.event.keyCode;
     } else
     if (e) {
         key = e.which;
     } else return true;
   
    keychar = String.fromCharCode(key);
    if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
        return true;
    } else
    if ((("0123456789").indexOf(keychar) > -1)) {
        return true;
    } else
    if (decimal && (keychar == ".")) {
        return true;
    } else return false;
    }
</script> 
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
				   <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Detail <small>Pegawai</small>
				   
				   <ul class="nav navbar-nav navbar-right" style="margin:1% 2% 0 0;">
					  <h5>
						<li><a href="<?php echo site_url ("c_user_logout");?>" style="text-decoration:none;"><span class="glyphicon glyphicon-off"></span> logout</a></li>
					  </h5>
				   </ul>
				</h1>
				<br />
                <br />
                <br />
				<header>
					<div class="header-content">
						<div class="header-content-inner">
							<div class="col-md-4 col-md-offset-4 col">
						<?php
							if(!empty($error))
							{
						?>
						<div class="alert alert-warning" role="alert">
							<center>
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
								<span class="sr-only">Error:</span>
									 <?php echo $error; ?>
							</center>
						</div>
						<?php
							}
						?>
                        <br />
				</div>
                
				<div class="clear"></div>
                    <div class="col-md-6 col-md-offset-2 col">
                       <form action="<?php echo site_url("c_user_pegawai/ubah/".md5(sha1($pilih->kode_pegawai))); ?>" class="form-horizontal" method="post">
						<fieldset disabled>
						<div class="form-group">
							<label class="col-sm-4 control-label">Kode Pegawai</label>
							<div class="col-sm-8">
								<input name="txt_kodepegawai" type="text" class="form-control" id="txt_kodepegawai" value="<?php echo $pilih->kode_pegawai ?>">
							</div>
						</div>
						</fieldset>
						
						<div class="form-group">
							<label class="col-sm-4 control-label">Nama Pegawai</label>
							<div class="col-sm-8">
								<input name="txt_nama" type="text" class="form-control" id="txt_nama" value="<?php if($act == "0") echo $pilih->nama; if($act == "1") echo set_value('txt_nama'); ?>" size="33" maxlength="30">
							</div>
						</div>
						
						<fieldset disabled>
						<div class="form-group">
							<label class="col-sm-4 control-label">Tahun Masuk</label>
							<div class="col-sm-8">
							<select name="tahun_masuk" class="form-control" >
								<?php $thn_skr = date('Y'); ?>
									<option value="<?php echo $pilih->tahun_masuk ?>" selected="selected"><?php echo $pilih->tahun_masuk ?></option>
								<?php
								$thn_skr = date('Y');
								for ($x=$thn_skr; $x>=2000; $x--) 
								{
								?>
									<option value="<?php echo $x ?>"><?php echo $x ?></option>
								<?php
								}
								?>
							</select>
							</div>
						</div>
						</fieldset>
						 
						<div class="form-group">
							<label class="col-sm-4 control-label">Alamat</label>
							<div class="col-sm-8">
							<textarea name="txt_alamat" cols="30" class="form-control" id="txt_alamat" ><?php  if($act == "0") echo $pilih->alamat; if($act == "1") echo set_value('txt_alamat'); ?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label">Telepon</label>
							<div class="col-sm-8">
							<input name="txt_telepon" type="text" class="form-control" onKeyPress="return hanyaAngka(event, false)" id="txt_telepon" value="<?php if($act == "0") echo $pilih->telepon; if($act == "1") echo set_value('txt_telepon');?>" size="33" maxlength="30" >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label">Jenis Kelamin</label>
							<div class="col-sm-8">
								<label for="rdb_jeniskelamin" class="radio-inline">
									<input  <?php if (!(strcmp($pilih->jenis_kelamin,"Laki-laki"))) {echo "checked=\"checked\"";} ?> type="radio" name="rdb_jeniskelamin" id="radio" value="Laki-laki" <?php echo set_radio('rdb_jenis_kelamin', 'laki-laki'); ?>/>
									Laki-laki
								</label>
								<label for="rdb_jeniskelamin" class="radio-inline">
									<input  <?php if (!(strcmp($pilih->jenis_kelamin,"Perempuan"))) {echo "checked=\"checked\"";} ?> type="radio" name="rdb_jeniskelamin" id="radio2" value="Perempuan" <?php echo set_radio('rdb_jenis_kelamin', 'perempuan'); ?>/>
									Perempuan
								</label>
							</div>
						</div>
					  
						<div class="form-group">
							<label class="col-sm-4 control-label">Type</label>
							<div class="col-sm-8">
								<select name="cbo_type"  class="form-control" id="cbo_type">
									<option value="0" selected="selected">- Pilih -</option>
									<option <?php if (!(strcmp($pilih->type,"Customer Service"))) {echo "selected=\"selected\"";} ?>  value="Customer Service"<?php echo $pilih->type ?>>Customer Service</option>
									<option <?php if (!(strcmp($pilih->type,"Teknisi"))) {echo "selected=\"selected\"";} ?>  value="Teknisi"<?php echo $pilih->type ?>>Teknisi</option>
								</select>
							</div>
						 </div>
						 <br/>
						 <div class="col-sm-8 col-sm-offset-4">
								<input type="submit" name="btn_ubah" id="btn_ubah" class="btn btn1 red" value="Ubah" />
								<input name="kode_pegawai" type="hidden" id="kode_pegawai" value="<?php echo md5(sha1($pilih->kode_pegawai)) ?>" />
								<input type="button" name="submit" id="submit" class="btn btn1 red" value="Batal" onClick="location.href='<?php echo site_url("c_user_pegawai");?>'" />
						</div>
					</form>
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
</body>
</html>