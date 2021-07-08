<?php include "conn.php" ;
include "config/tglindo.php";?>
<body onLoad="javascript:print()"> 
<style type="text/css">
<!--
.style3 {font-size: 12px}
-->
.style6 {font-size: 24px}
</style>

<div class="panel-heading">
                            <table width="100%">
							<tr>
							<td><div align="center">
							  <div align="center"><span class="style6">DINAS KESEHATAN KABUPATEN ASAHAN							  </span>
						      <br>
						      Jl. Tusam No.5 Kisaran, Kabupaten Asahan, Provinsi Sumatera Utara.</div>							 </td>
							</tr>
							</table>
</div>


<table id='theList' border=1 width='100%' class='table table-bordered table-striped'>
<tr><th width="5%" bgcolor="#999999"><span class="style3">No.</span></th>

<th bgcolor="#999999"><span class="style3">Nama Lengkap </span></th>


<th width="14%" bgcolor="#999999"><span class="style3">Email</span></th>
<th width="10%" bgcolor="#999999"><span class="style3">No Hp</span></th>
<th width="19%" bgcolor="#999999"><span class="style3">Alamat</span></th>
</tr>
<?php
$sql = mysql_query("select * from rb_login ");
$no=1;
while($r = mysql_fetch_array($sql)){
if($r[aktif]==1){
$status="Online";
}else{
$status="Offline";
}
?>
<tr>
<td class='td' align='center'><span class="style3"><?echo$no;?></span></td>


<td class='td' width='16%' ><span class="style3"><?echo"$r[nama_lengkap]";?></span></td>


<td class='td'><span class="style3"><?echo$r[email];?></span></td>
<td class='td'><span class="style3"><?echo$r[nohp];?></span></td>
<td class='td'><span class="style3"><?echo$r[alamat];?></span></td>
</tr>
<?
$no++;
}
?>
</table>

<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF" >
<tr>
<td width="63%" bgcolor="#FFFFFF">
							  
	  <p align="center"><br/>
    </td><td width="37%" bgcolor="#FFFFFF"><div align="center"> <?php $tgl = date('d M Y');
echo "Kabupaten Asahan, $tgl";?><br/>
  <br/><br/>
								<br/><br/>
								  Kepala Dinas<br/>
								  
								  
								  </div></td>
</tr></table>

