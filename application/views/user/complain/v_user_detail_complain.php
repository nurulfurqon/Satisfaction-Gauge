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
<?php

	$this->load->view('user/menu/menu');

?>    
<div id="MainContent">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row" style="margin-bottom:200px;">
			<div class="col-lg-12">
				<h1 class="page-header">
				   <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Detail <small>Complain</small>
				   
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
                       <form action="<?php echo site_url("c_user_complain/detail/".md5(sha1($pilih->kode_complain))); ?>" class="form-horizontal" method="post">
						
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
                                    <input type="submit" name="btn_ubah" id="btn_ubah" class="btn btn1 red" value="Ubah" />
                                    <input name="kode_complain" type="hidden" id="id_pelanggan" value="<?php echo md5(sha1($pilih->kode_complain)) ?>" />
                                    <input type="button" name="submit" id="submit" class="btn btn1 red" value="Batal" onClick="location.href='<?php echo site_url("c_user_complain");?>'" />
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
    <script src="<?php echo base_url();?>asset/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>