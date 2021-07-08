<?php 
ob_start();
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome SMP 40 Padang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Ferri">
	<link href="view/css/bootstrap.min.css" rel="stylesheet">
	<link href="view/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
		<link rel="stylesheet" type="text/css" href="themea/twitter.css">
	<link href="view/css/style.css" rel="stylesheet">
	
	<script type="text/javascript" src="view/js/ga.js"></script>
	<script type="text/javascript" src="view/js/jquery.min.js"></script>
	<script type="text/javascript" src="view/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="view/js/jquery.min.js"></script>
	<script type="text/javascript" src="view/js/jscript_jquery-1.6.4.js"></script>
	<script type="text/javascript" src="view/js/jquery.validate.js"></script>
	<script type="text/javascript" src="dist/sweetalert.min.js"></script>
	  <script type="text/javascript">	  
	  $(document).ready(function(){
			$('#registerHere input').hover(function()
			{
			$(this).popover('show')
		});
			$("#registerHere").validate({
				rules:{
					nama_lengkap:"required",
					email:{
							required:true,
							email: true
						},
					no_telp:{
						required:true,
						minlength: 11
					},
					gender:"required"
				},
				messages:{
					nama_lengkap:"Enter your Full Name",
					email:{
						required:"Enter your email address",
						email:"Enter valid email address"
					},
					no_telp:{
						required:"Enter your Phone Number",
						minlength:"Phone Number must be minimum 11 characters"
					},
					gender:"Select Gender"
				},
				errorClass: "help-inline",
				errorElement: "span",
				highlight:function(element, errorClass, validClass) {
					$(element).parents('.control-group').addClass('error');
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).parents('.control-group').removeClass('error');
					$(element).parents('.control-group').addClass('success');
				}
			});
		});
	  </script>
<script type="text/javascript">
$(document).ready(function()//When the dom is ready 
{
$("#email").change(function(){ 
 //if theres a change in the email textbox
//alert(hello);
var email = $("#email").val();//Get the value in the email textbox
	var regdata = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	 if(!(regdata).test($("#email").val()))
	 {
	 //alert("hello");
	 $("#email").css('border','1px solid red');
	 $("#email").focus();
	 $("#error1").html("enter the valid emailid!");
	  return false;
	 }
    else{
	   $("#email").css('border','1px solid #7F9DB9');
	  $("#error1").html('<img src="view/img/loader.gif" align="absmiddle">&nbsp;Checking availability...'); 
	  
     $.ajax({  //Make the Ajax Request
     type: "POST",  
     url: "check.php",  //file name
     data:"email="+ email,  //data
     success: function(server_response){
	$("#error1").ajaxComplete(function(event,request){
	//alert(server_response);
	if(server_response == '0')
	{ 
	$("#error1").html('<img src="view/img/available.png" align="absmiddle"> <font color="Green"> Available, Alamat Email masih perawan. </font>  ');
	}  
	else  if(server_response == '1')
	{  
	$("#error1").html('<img src="view/img/not_available.png" align="absmiddle"><font color="red"> Alamat Email ini sudah terdaftar di sistem. </font>');
	}  
     });
   } 
   
  }); 
 }
});

});
</script>
</head>

<body>
<div style="padding-top:2%" class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
		<img style="margin-bottom:10px;" width="100%" height="100%" src="images/header.png" />
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container-fluid">
						 <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a> 
						<div class="nav-collapse collapse navbar-responsive-collapse">
							<ul class="nav">
								
								
								<?php if ($_SESSION[leveluser] == 'siswa'){ ?>
								<li><a href="media.php?module=utama"><i class="icon-home icon-black"></i> Home</a></li>
								
								<li><a href="media.php?module=rapor"><i class="icon-th-large icon-black"></i> Lihat Jadwal</a></li>
								<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th-large "></i> Setting <strong class="caret"></strong></a>
									<ul class="dropdown-menu">
																				
									     <li><a href="logout.php" >Logout</a></li>
										<li><a href="media.php?module=edit_akun" >Ganti Password</a></li>
									
										
									</ul>
								</li>
									
								<?php }elseif ($_SESSION[leveluser] == ''){ ?>
								<li><a href="./"><i class="icon-home icon-black"></i> Home</a></li>
								<li><a href="media.php?module=profil"><i class="icon-book icon-black"></i> Profil</a></li>
								<li><a href="media.php?module=jadwal_user"><i class="icon-time icon-black"></i> Jadwal Guru</a></li>
							
									
								<?php }elseif ($_SESSION[leveluser] == 'admin'){ ?>
									<li><a href="./"><i class="icon-home icon-black"></i> Home</a></li>
									<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-list icon-black"></i> Data Master  <strong class="caret"></strong></a>
									<ul class="dropdown-menu">
																				
									    
										<!--<li><a href="media.php?module=wali_kelas" >Data Wali Kelas</a></li>-->
										<li><a href="media.php?module=guru_data" >Data Guru</a></li>
										<li><a href="media.php?module=siswa_data" >Data Siswa</a></li>
										<li><a href="media.php?module=pelajaran_data" >Data Mata Pelajaran</a></li>
										<li><a href="media.php?module=lihat_kelas">Data Kelas</a></li>
										<li><a href="media.php?module=jadwal_data">Data Jadwal Pelajaran</a></li>
										
										
										
									</ul>
								</li>
																	<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-book icon-black"></i> Laporan  <strong class="caret"></strong></a>
									<ul class="dropdown-menu">
																				
									    
										<!--<li><a href="media.php?module=laporan_wal" >Laporan Data Wali Kelas</a></li>-->
										<li><a href="media.php?module=laporan_siswa_perkelas"  >Laporan Data Siswa</a></li>
										<li><a href="laporan_kelas.php" target="_blank" >Laporan Kelas Belajar</a></li>
										<li><a href="pelajaran.php" target="_blank"  >Laporan Mata Pelajaran</a></li>
										<li><a href="media.php?module=jadwal_kelas"  >Laporan Jadwal Pelajaran</a></li>
										
										
									</ul>
								</li>
									
									
								
								
										
									<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th-large "></i> Setting <strong class="caret"></strong></a>
									<ul class="dropdown-menu">
																				
									     <li><a href="logout.php" >Logout</a></li>
										<li><a href="media.php?module=edit_akun" >Ganti Password</a></li>
									
										
									</ul>
								</li>
											
								
												
								<?php }elseif ($_SESSION[leveluser] == 'walikelas'){ ?>
									<li><a href="./"><i class="icon-home icon-black"></i> Home</a></li>
									
									<li><a href="media.php?module=jadwal_guru"><i class="icon-th-large icon-black"></i> Lihat Jadwal </a></li>
									<li><a href="media.php?module=siswa_data1"><i class="icon-th-large icon-black"></i> Lihat Data Siswa </a></li>
									<li><a href="media.php?module=lihat_data_guru"><i class="icon-th-large icon-black"></i> Lihat Data Guru </a></li>
									
								
								
										
									<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th-large "></i> Setting <strong class="caret"></strong></a>
									<ul class="dropdown-menu">
																				
									     <li><a href="logout.php" >Logout</a></li>
										<li><a href="media.php?module=edit_akun" >Ganti Password</a></li>
									
										
									</ul>
								</li>
										
									
									
								<?php } ?>
								
									
									
								
								
								<?php if ($_SESSION[leveluser] == ''){ ?>
									<li><a href="login.html"><i class="icon-user icon-black"></i> Login </a></li>
									<?php }elseif ($_SESSION[leveluser] == 'admin'){ ?>
									<ul class="nav pull-right">
								<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-globe icon-black"></i> Apa Kabar, <?php echo "$_SESSION[namalengkap]"; ?> </a>
									
							
								<?php }else{ ?>
							
														
										<ul class="nav pull-right">
								<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-globe icon-black"></i> Apa Kabar, <?php echo "$_SESSION[namalengkap]"; ?> </a>
									
									
								<?php } ?>
						</div>
						
					</div>
				</div>
				
			</div>
			<div class="row-fluid">
				<?php
				if (isset($_GET[analisa])){
				?>
					<div class="span12">
						<?php include "content.php"; ?>
					</div>
				<?php
				}else{
				?>
					<?php if ($_SESSION[leveluser] == 'admin'){ ?>
						<?php include "content.php"; ?>
						<?php }elseif ($_SESSION[leveluser] == 'walikelas'){ ?>
						<?php include "content.php"; ?>
						
						<?php }elseif ($_SESSION[leveluser] == 'siswa'){ ?>
						<?php include "content.php"; ?>
					<br>
					<?php }elseif ($_SESSION[leveluser] == 'control'){ ?>
						<?php include "content.php"; ?>
					<br>
					<?php }elseif ($_SESSION[leveluser] == ''){ ?>
					
						<?php include "content.php";  ?>
					
					
				<?php } 
				
				}?>
			</div>
			<br><br><br><br><br><br><br>
			<center style='background:#009933; padding:10px; color:#fff; font-size:12px; margin-bottom:3px; border-top:5px solid #000'>
			<b>Copyright (c) 2016 - Universitas Putra Indonesia "YPTK" Padang</b>
		</center>
		</div>
	</div>
</div>	

<!-- Modal -->
<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah Data Kriteria</h3>
  </div>
  <div class="modal-body">
	    <form class="form-horizontal" action='kriteria.html' method='POST'>
			  <div class="control-group">
			    <label class="control-label" for="inputEmail">Nama Kriteria</label>
			    <div class="controls">
			      <input type="text" class='span3' name='a' id="inputEmail" placeholder="">
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="inputPassword">Kepentingan</label>
			    <div class="controls">
			      <input type="text" class='span1' name='b' id="inputPassword" placeholder="">
			    </div>
			  </div>
		
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button type='submit' name='c' class="btn btn-primary">Simpan</button>
  </div>
  </form>
</div>

<!-- Modal -->
<div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Tambah Data Alternatif</h3>
  </div>
  <div class="modal-body">
	    <form class="form-horizontal" action='alternatif.html' method='POST'>
			  <div class="control-group">
			    <label class="control-label" for="inputEmail">Nama Alternatif</label>
			    <div class="controls">
			      <input type="text" class='span3' name='a' id="inputEmail" placeholder="">
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="inputPassword">Deskripsi</label>
			    <div class="controls">
			      <textarea name='b' rows='7' class='span3' id="inputPassword" placeholder=""></textarea> 
			    </div>
			  </div>
		
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button type='submit' name='c' class="btn btn-primary">Simpan</button>
  </div>
  </form>
</div>

</body>
</html>
