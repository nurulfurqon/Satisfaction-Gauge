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
<title>Detail Data Kepuasan</title>

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
				   <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Detail <small>Data Kepuasan</small>
				   
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
                       <form action="<?php echo site_url("c_user_data_kepuasan/detail/".md5(sha1($pilih->id))); ?>" class="form-horizontal" method="post" >
                            <fieldset disabled>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Jenis Complain</label>
                                <div class="col-sm-8">
                                    <select name="cbo_jenis_complain" class="form-control">
                                        <option value="<?php echo $pilih->jenis_complain_id;?>" selected="selected"><?php echo $pilih->nama;  ?></option>
                                        <?php
                                        foreach($tampil_data->result() as $baris)
                                        {
                                        ?>
                                        <option value="<?php echo $baris->id;?>" ><?php echo $baris->nama;?></option>
                                        <?php
                        
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            </fieldset>
                            
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Pengukuran</label>
                                <div class="col-sm-8">
                                    <textarea name="txt_pengukuran" cols="30" class="form-control" id="txt_pengukuran"  placeholder="Isi Alamat"><?php if($act == "0") echo $pilih->pengukuran; if($act == "1") echo set_value('txt_pengukuran');?></textarea></td>
                                </div>
                            </div>
                          
                             <br/>
                             <div class="col-sm-8 col-sm-offset-4">
                                    <input type="submit" name="btn_ubah" id="btn_ubah" class="btn btn1 red" value="Ubah" />
                                    <input name="id" type="hidden" id="jenis_complain_id" value="<?php echo md5(sha1($pilih->id)) ?>" />
                                    <input type="button" name="submit" id="submit" class="btn btn1 red" value="Batal" onClick="location.href='<?php echo site_url("c_user_data_kepuasan");?>'" />
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