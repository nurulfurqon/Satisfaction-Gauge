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
<title>Tambah Pegawai</title>
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
            <li class="active"><a href="<?php echo site_url ("c_adm_pegawai");?>" >Pegawai</a></li>
            <li ><a href="<?php echo site_url ("c_adm_pelanggan");?>">Pelanggan</a></li>
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
						<button type="button" name="btn_tambah" id="btn_tambah" class="btn btn-link" style="color:#158843; text-decoration: none;" onClick="location.href='<?php echo site_url("c_adm_pegawai");?>'" /><span class="glyphicon glyphicon-list-alt"></span> Lihat Data</button>
					</div>
					<div id="tambah">
						<button type="button" name="btn_tambah" id="btn_tambah" class="btn btn-link" style="color:#158843; text-decoration: none;" onClick="location.href='<?php echo site_url("c_adm_pegawai/tambah");?>'" /><span class="glyphicon glyphicon-plus-sign"></span> Tambah Data</button>
					</div>
					<br/>
				</div>
			</div>
			<div class="col-md-10" style="margin-bottom:50px;">
				<div class="page-header font_ku body">
					<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Entry Pegawai
				</div>
				<br/>
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
				<div class="col-md-6 col-md-offset-2 col">
					<form action="<?php echo site_url("c_adm_pegawai/tambah"); ?>" class="form-horizontal" method="post">
						<div class="form-group">
							<label class="col-sm-4 control-label">Nama Pegawai</label>
							<div class="col-sm-8">
								<input name="txt_nama" type="text" class="form-control" id="txt_nama" value="<?php echo set_value("txt_nama"); ?>" size="33" maxlength="30" placeholder="Isi Nama Pegawai">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label">Tahun Masuk</label>
							<div class="col-sm-8">
								<select name="tahun_masuk" class="form-control" >
									<?php $thn_skr = date('Y'); ?>
										<option value="0">- Pilih -</option>
									<?php
									$thn_skr = date('Y');
									for ($x=$thn_skr; $x>=2000; $x--) 
									{
									?>
										<option <?php if (!(strcmp(set_value("tahun_masuk"),"$x"))) {echo "selected=\"selected\"";} ?> value="<?php echo $x ?>"><?php echo $x ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
						 
						<div class="form-group">
							<label class="col-sm-4 control-label">Alamat</label>
							<div class="col-sm-8">
								<textarea name="txt_alamat" cols="30" class="form-control" id="txt_alamat"  placeholder="Isi Alamat"><?php echo set_value("txt_alamat"); ?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label">Telepon</label>
							<div class="col-sm-8">
								<input name="txt_telepon" type="text" class="form-control" onKeyPress="return hanyaAngka(event, false)" id="txt_telepon" value="<?php echo set_value("txt_telepon"); ?>" size="33" maxlength="30" placeholder="Isi No Telepon">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label">Jenis Kelamin</label>
							<div class="col-sm-8">
								<label for="rdb_jeniskelamin" class="radio-inline">
									<input <?php if (!(strcmp(set_value("rdb_jeniskelamin"),"Laki-laki"))) {echo "checked=\"checked\"";} ?> type="radio" name="rdb_jeniskelamin" id="radio" value="Laki-laki" <?php echo set_radio('rdb_jenis_kelamin', 'laki-laki'); ?>/>
									Laki-laki 
								</label>
								<label for="rdb_jeniskelamin" class="radio-inline">
									<input <?php if (!(strcmp(set_value("rdb_jeniskelamin"),"Perempuan"))) {echo "checked=\"checked\"";} ?> type="radio" name="rdb_jeniskelamin" id="radio2"  value="Perempuan" <?php echo set_radio('rdb_jenis_kelamin', 'perempuan'); ?>/>
									Perempuan
								</label>
							</div>
						</div>
					  
						<div class="form-group">
							<label class="col-sm-4 control-label">Type</label>
							<div class="col-sm-8">
								<select name="cbo_type"  class="form-control" id="cbo_type">
									<option value="" selected="selected">- Pilih -</option>
									<option <?php if (!(strcmp(set_value("cbo_type"),"Customer Service"))) {echo "selected=\"selected\"";} ?> value="Customer Service"<?php echo set_value("cbo_type"); ?>>Customer Service</option>
									<option <?php if (!(strcmp(set_value("cbo_type"),"Teknisi"))) {echo "selected=\"selected\"";} ?> value="Teknisi"<?php echo set_value("cbo_type"); ?>>Teknisi</option>
								</select>
							</div>
						</div>
						<br/>
						<div class="col-sm-8 col-sm-offset-4">
								<input type="submit" name="btn_simpan" id="btn_simpan" class="btn btn-success" value="Simpan" />
								<input type="button" name="submit" id="submit" class="btn btn-default" value="Batal" onClick="location.href='<?php echo site_url("c_adm_pegawai");?>'" />
						</div>
					</form>
				</div>		
			</div>
		</div>
	</div>

<?php $this->load->view('admin/menu/footer');?>