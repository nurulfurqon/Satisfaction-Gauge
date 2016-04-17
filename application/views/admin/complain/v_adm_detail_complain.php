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
<title>Detail Complain</title>
<link href="<?php echo base_url(); ?>jquery-ui/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>jquery-ui/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>jquery-ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>jquery-ui/ui/jquery.ui.datepicker.js"></script>
<script>
$(function() {
    $("#tgl").datepicker({
		dateFormat :"dd-mm-yy",
		changeDay :true,
		changeMonth :true,
		changeYear :true,
		yearRange:"-100:+0"
	});
	 $("#tgl2").datepicker({
		dateFormat :"yy-mm-dd",
		changeDay :true,
		changeMonth :true,
		changeYear :true,
		yearRange:"-100:+0"
	});
  });
</script>
<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css" />
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
            <li ><a href="<?php echo site_url ("c_adm_pelanggan");?>">Pelanggan</a></li>
            <li ><a href="<?php echo site_url ("c_adm_use");?>">User</a></li>
            <li><a href="<?php echo site_url ("c_adm_jenis_complain");?>">Jenis Complain</a></li>
            <li ><a href="<?php echo site_url ("c_adm_data_kepuasan");?>">Data Kepuasan</a></li>
            <li class="active"><a href="<?php echo site_url ("c_adm_complain");?>">Complain</a></li>
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
						<button type="button" name="btn_tambah" id="btn_tambah" class="btn btn-link" style="color:#158843; text-decoration: none;" onClick="location.href='<?php echo site_url("c_adm_complain");?>'" /><span class="glyphicon glyphicon-list-alt"></span> Lihat Data</button>
					</div>
					<div id="tambah">
						<button type="button" name="btn_tambah" id="btn_tambah" class="btn btn-link" style="color:#158843; text-decoration: none;" onClick="location.href='<?php echo site_url("c_adm_complain/tambah");?>'" /><span class="glyphicon glyphicon-plus-sign"></span> Tambah Data</button>
					</div>
					<br/>
				</div>
			</div>
			<div class="col-md-10" style="margin-bottom:50px;">
				<div class="page-header font_ku body">
					<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Detail Complain
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
				<div class="col-md-7 col-md-offset-2 col">
					<form action="<?php echo site_url("c_adm_complain/detail/".md5(sha1($pilih->kode_complain))); ?>" class="form-horizontal" method="post">
						
						<fieldset disabled>
						<div class="form-group">
							<label class="col-sm-4 control-label">Kode Pegawai</label>
							<div class="col-sm-8">
								<input name="#" type="text" class="form-control" id="txt_kodepegawai" value="<?php echo $pilih->kode_complain;?>">
							</div>
						</div>
						</fieldset>
						
						<div class="form-group">
							<label class="col-sm-4 control-label">Nama Pelanggan</label>
							<div class="col-sm-8">
								<select name="cbo_pelanggan" class="form-control" id="cbo_pelanggan">
									<option value="<?php echo $pilih->pelanggan_id;?>" selected="selected" ><?php echo $pilih->nama_pelanggan;?></option>
										<?php
											foreach($tampil_data_pelanggan->result() as $baris)
											{
										?>
									<option <?php if (!(strcmp(set_value("cbo_pelanggan"),"$baris->id"))) {echo "selected=\"selected\"";} ?> value="<?php echo $baris->id;?>" ><?php echo $baris->nama;?></option>
										<?php
						
											}
										?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label">Nama Pegawai</label>
							<div class="col-sm-8">
								<select name="cbo_pegawai" class="form-control" id="cbo_pegawai">
									<option value="<?php echo $pilih->pegawai_id;?>" selected="selected" ><?php echo $pilih->nama_pegawai;?></option>
										<?php
											foreach($tampil_data_pegawai->result() as $baris)
											{
										?>
									<option <?php if (!(strcmp(set_value("cbo_pegawai"),"$baris->id"))) {echo "selected=\"selected\"";} ?> value="<?php echo $baris->id;?>" ><?php echo $baris->nama;?></option>
										<?php
						
											}
										?>
								</select>
							</div>
						</div>
						 
						<div class="form-group">
							<label class="col-sm-4 control-label">Jenis Complain</label>
							<div class="col-sm-8">
								<select name="cbo_jenis_complain" class="form-control" id="cbo_jenis_complain">
									<option value="<?php echo $pilih->jenis_complain_id;?>" selected="selected" ><?php echo $pilih->nama;?></option>
										<?php
											foreach($tampil_data_jenis_complain->result() as $baris)
											{
										?>
									<option <?php if (!(strcmp(set_value("cbo_jenis_complain"),"$baris->id"))) {echo "selected=\"selected\"";} ?> value="<?php echo $baris->id;?>" ><?php echo $baris->nama;?></option>
										<?php
						
											}
										?>
								</select>
							</div>
						</div>
						 
						<div class="form-group">
							<label class="col-sm-4 control-label">Tanggal Complain</label>
							<div class="col-sm-8">
								<input name="tgl_complain" type="text" class="form-control"  id="tgl" value="<?php if($act == "0") echo $pilih->tanggal_complain; if($act == "1") echo set_value('tgl_complain');?>" size="25" maxlength="11" placeholder="Isi Tanggal Complain" >
							</div>
						</div>
						 
						<div class="form-group">
							<label class="col-sm-4 control-label">Status</label>
							<div class="col-sm-8">
								<select name="cbo_status" class="form-control" id="cbo_status">
									<option value="" selected="selected" >- Pilih -</option>
										
									<option <?php if (!(strcmp($pilih->status,"Sudah Diperbaiki"))) {echo "selected=\"selected\"";} ?>  value="Sudah Diperbaiki"<?php echo $pilih->status ?>>Sudah Diperbaiki</option>
									<option <?php if (!(strcmp($pilih->status,"Belum Diperbaiki"))) {echo "selected=\"selected\"";} ?>  value="Belum Diperbaiki"<?php echo $pilih->status ?>>Belum Diperbaiki</option>
									
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label">Tanggal Perbaikan</label>
							<div class="col-sm-8">
								<input name="tgl_perbaikan" type="text" class="form-control"  id="tgl2" value="<?php echo $pilih->tanggal_perbaikan;?>" size="25" maxlength="11" placeholder="Isi Tanggal Perbaikan">
							</div>
						</div>
						
						<br/>
						<div class="col-sm-8 col-sm-offset-4">
								<input type="submit" name="btn_ubah" id="btn_ubah" class="btn btn-success" value="Ubah" />
								<input name="kode_complain" type="hidden" id="id_pelanggan" value="<?php echo md5(sha1($pilih->kode_complain)) ?>" />
								<input type="button" name="submit" id="submit" class="btn btn-default" value="Batal" onClick="location.href='<?php echo site_url("c_adm_complain");?>'" />
						</div>
					</form>
				</div>		
			</div>
		</div>
	</div>

	<br/>
	<center>
	<p class="text-center"><h6>Pegawai &nbsp;|&nbsp; Pelanggan &nbsp;|&nbsp; User &nbsp;|&nbsp; Jenis Complain &nbsp;|&nbsp; Data Kepuasan &nbsp;|&nbsp; Complain &nbsp;|&nbsp; Report Perorangan &nbsp;|&nbsp; Report Keseluruhan</h6></p>
	<p class="text-center"><h6>Copyright &copy; 2015 by Nurul Furqon</h6></p>
	</center>
	<br/>
	<br/>

</div>
<!-- Bootstrap core JavaScript -->
  
    <script src="<?php echo base_url();?>asset/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
