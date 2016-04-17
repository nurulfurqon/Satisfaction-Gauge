<?php
	//jika session kosong
	if(!$this->session->userdata('ses_sts_nama'))
	{
		//arahkan ke halaman login
		redirect('c_adm_login');
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
<title>Tampil Data Pelanggan</title>
</head>

<body>
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
            <li><a href="<?php echo site_url ("c_adm_pegawai");?>" >Pegawai</a></li>
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
			<div class="col-md-10">
				<div class="page-header font_ku body">
					<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Daftar Pelanggan
				</div>
				<br/>
				<div class="col-md-4 col-md-offset-4 col">
					<center>
						<p class="text-success"><?php echo $this->session->flashdata('message');?></p>
					</center>
				</div>
				<div class="clear"></div>
				<br/>
				<div class="row">
					<div class="col-md-5 col-md-offset-7" style="margin-bottom:1.5%;">
						<form action="<?php echo site_url('c_adm_pelanggan')?>" method="post">
							<div class="input-group">
							  <input type="text" name="txt_cari"  size="25" class="form-control" placeholder="Cari berdasarkan nama dan id pelanggan...">
							  <span class="input-group-btn">
								<button type="submit" class="btn btn-default" >Cari</button>
							  </span>
							</div><!-- /input-group -->
						</form>
					</div><!-- /.col-lg-6 -->
				</div>
				<div class="clear"></div>
				<div class="table-responsive body_table font_isi">  
                <?php
                            if($tampil->result())
                            {
                 ?>
					<table class="table table-bordered table-hover" width="100%" >
						<thead class="navbar-default" >
							<tr>
								<td width="5%" align="center"><b>No</b></td>
								<td width="16%" align="center"><b>Id Pelanggan</b></td>
								<td width="32%" align="center"><b>Nama</b></td>
								<td width="24%" align="center"><b>Jenis Kelamin</b></td>
								<td width="23%"></td>
							</tr>
						</thead>
						<tbody>
						  <?php
							$no = $no+1;
							foreach($tampil->result() as $baris)
							{
						  ?>
							 <tr>
								<td id="isi_tb" align="center"><?php echo $no; ?></td>
								<td id="isi_tb"><?php echo $baris->id_pelanggan;?></td>
								<td id="isi_tb"><?php echo $baris->nama;?></td>
								<td id="isi_tb"><?php echo $baris->jenis_kelamin;?></td>
								<td align="center"> <button type="button" name="btn_ubah" class="btn-sm btn-link" style="text-decoration: none;" onClick="location.href=('<?php echo $baris->id_pelanggan ?>','<?php echo site_url("c_adm_pelanggan/ubah/".md5(sha1($baris->id_pelanggan)));?>');"><span class="glyphicon glyphicon-eye-open"></span> Detail</button>
								
								<button type="button" name="btn_hapus" class="btn-sm btn-link" style="color:#ec4445; text-decoration: none;" onclick="return hapus_data('<?php echo $baris->nama ?>','<?php echo site_url("c_adm_pelanggan/hapus/".$baris->id_pelanggan);?>');"><span class="glyphicon glyphicon-trash"></span> Hapus</button>
								</td>
							  </tr>
						  <?php
							$no++;	
							}
						  ?>
						</tbody>
					</table>
						
				<center>
					<?php
					if(set_value('txt_cari') == "")
					{			  
						echo $halaman;				              
					}
					else
					{
					?>
		  
				</center>
				<a href="<?php echo site_url("c_adm_pelanggan"); ?>">
				<span class="glyphicon glyphicon-list-alt"></span> Tampilkan Seluruh Data
				  </a>
				  <?php
					}
				  ?>
                   <!-- tutup if($tampil->result()) -->
						<?php
							}
							else
							{	
						?>
                       <br />
                       <center>
                       <h2><span class="glyphicon glyphicon-floppy-remove"></span> Data Tidak Ditemukan</h2>
                       </center>
                       <br />
                       <br />
                       <a href="<?php echo site_url("c_adm_pelanggan"); ?>">
                       <span class="glyphicon glyphicon-list-alt"></span> Tampilkan Seluruh Data
                       </a>
                        <?php
							}
						?>
				  <br/>
				  <br/>
				  <br/>
                  </div>
			</div>
		</div>
	</div>

<?php $this->load->view('admin/menu/footer');?>