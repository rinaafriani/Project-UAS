
<html>
<head>
<title> :: Laporan Data Wali kelas- Sistem Informasi Akademik Sekolah</title>
<link href="styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<h4>LAPORAN DATA WALI KELAS </h4>
<table class="table-list" width="850" border="0" cellspacing="1" cellpadding="2">
<?php
	include_once "library/inc.library.php";
		include "conn.php" ;
include "config/tglindo.php";
		$batas =  10;
		$halaman = $_GET['halaman'];
		if(empty($halaman)){
			$posisi = 0;
			$halaman = 1;
		}else{
			$posisi = ($halaman - 1) * $batas;
		}
		
		
?>
<style type="text/css">
<!--
.style3 {font-size: 12px}
-->
.style4 {
	font-size: 16px;
	font-family: "Trebuchet MS";}
</style>




<tr><th width="5%" bgcolor="#F5F5F5"><span class="style3">No.</span></th>

<th bgcolor="#F5F5F5"><span class="style3">Nama Lengkap </span></th>


<th width="14%" bgcolor="#F5F5F5"><span class="style3">Email</span></th>
<th width="10%" bgcolor="#F5F5F5"><span class="style3">No Hp</span></th>
<th width="19%" bgcolor="#F5F5F5"><span class="style3">Alamat</span></th>
</tr>
<?php
$sql = mysql_query("select * from rb_login where level='walikelas' ");
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


<?
$no++;
}
?>
</table>
<img src="images/btn_print.png" width="20" onClick="javascript:window.print()" />
</body>
</html>