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
<title>Detail Pelanggan</title>
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
            <li class="active"><a href="<?php echo site_url ("c_adm_pelanggan");?>">Pelanggan</a></li>
            <li><a href="<?php echo site_url ("c_adm_use");?>">User</a></li>
            <li><a href="<?php echo site_url ("c_adm_jenis_complain");?>">Jenis Complain</a></li>
            <li><a href="<?php echo site_url ("c_adm_data_kepuasan");?>">Data Kepuasan</a></li>
            <li><a href="<?php echo site_url ("c_adm_complain");?>">Complain</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Report <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo site_url ("c_adm_report_perorangan");?>">Perorangan</a></li>
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
			<div class="col-md-2">
				<div class="panel panel-default" style="border-radius:3; ">
					<div class="menu_head navbar-inverse"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Menu</div>
					<div id="tambah">
						<button type="button" name="btn_tambah" id="btn_tambah" class="btn btn-link" style="color:#158843; text-decoration: none;" onClick="location.href='<?php echo site_url("c_adm_pelanggan");?>'" /><span class="glyphicon glyphicon-list-alt"></span> Lihat Data</button>
					</div>
					<div id="tambah">
						<button type="button" name="btn_tambah" id="btn_tambah" class="btn btn-link" style="color:#158843; text-decoration: none;" onClick="location.href='<?php echo site_url("c_adm_pelanggan/tambah");?>'" /><span class="glyphicon glyphicon-plus-sign"></span> Tambah Data</button>
					</div>
					<br/>
				</div>
			</div>
			<div class="col-md-10" style="margin-bottom:50px;">
				<div class="page-header font_ku body">
					<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Detail Pelanggan
				</div>
				<br/>
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
				</div>
				<div class="clear"></div>
				<br/>
				<div class="col-md-6 col-md-offset-2 col">
					<form action="<?php echo site_url("c_adm_pelanggan/ubah/". md5(sha1($pilih->id_pelanggan))); ?>" class="form-horizontal" method="post">
						<fieldset disabled>
						<div class="form-group">
							<label class="col-sm-4 control-label">Id Pelanggan</label>
							<div class="col-sm-8">
								<input name="txt_idpelanggan" type="text" class="form-control" id="txt_idpelanggan" value="<?php echo $pilih->id_pelanggan ?>">
							</div>
						</div>
						</fieldset>
						
						<div class="form-group">
							<label class="col-sm-4 control-label">Nama Pelanggan</label>
							<div class="col-sm-8">
								<input name="txt_nama" type="text" class="form-control" id="txt_nama" value="<?php if($act == "0") echo $pilih->nama; if($act == "1") echo set_value('txt_nama'); ?>" size="33" maxlength="30">
							</div>
						</div>
						 
						<div class="form-group">
							<label class="col-sm-4 control-label">Alamat</label>
							<div class="col-sm-8">
							<textarea name="txt_alamat" cols="30" class="form-control" id="txt_alamat" ><?php if($act == "0") echo $pilih->alamat; if($act == "1") echo set_value('txt_alamat'); ?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label">Telepon</label>
							<div class="col-sm-8">
							<input name="txt_telepon" type="text" class="form-control" onKeyPress="return hanyaAngka(event, false)" id="txt_telepon" value="<?php if($act == "0") echo $pilih->telepon; if($act == "1") echo set_value('txt_telepon'); ?>" size="33" maxlength="30" >
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
					  
						 <br/>
						 <div class="col-sm-8 col-sm-offset-4">
								<input type="submit" name="btn_ubah" id="btn_ubah" class="btn btn-success" value="Ubah" />
								<input name="id_pelanggan" type="hidden" id="id_pelanggan" value="<?php echo md5(sha1($pilih->id_pelanggan)) ?>" />
								<input type="button" name="submit" id="submit" class="btn btn-default" value="Batal" onClick="location.href='<?php echo site_url("c_adm_pelanggan");?>'" />
						</div>
					</form>
				</div>		
			</div>
		</div>
	</div>

<?php $this->load->view('admin/menu/footer');?>