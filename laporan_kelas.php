<body onLoad="javascript:print()">  
<?php
	
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
<h3 align="center"> SMP NEGERI 40 PADANG</h3>
<p align="center">Laporan Data Kelas</p><hr>
<table  align="center" width="880"  border=1  class='table table-bordered table-striped'>
<tr>
<th bgcolor="#999999"><span class="style3">Kode Kelas</span></th>

<th bgcolor="#999999"><span class="style3">Nama Kelas</span></th>


<th width="35%" bgcolor="#999999"><span class="style3">Wali Kelas</span></th>







</tr>

<?php
$sql = mysql_query("select * from tb_kelas  ");
$no=1;
while($r = mysql_fetch_array($sql)){
if($r[aktif]==1){
$status="Online";
}else{
$status="Offline";
}
?>
<tr>


<td class='td' width='14%' ><span class="style3"><?echo"$r[kode_kelas]";?></span></td>
<td class='td' width='22%' ><span class="style3"><?echo"$r[nama_kelas]";?></span></td>


<td class='td'><span class="style3"><?echo$r[wali_kelas];?></span></td>

</tr>
<?
$no++;
}
?>
</table>

<br>
<br>
<br>
	<?php
echo "<table align='right'>";
$tgl = date('d M Y');
echo "<tr><td>Padang, $tgl</td></tr>";
echo "<tr><td>Mengetahui,</td></tr>";
echo"<tr><td>&nbsp;</td></tr>";
echo"<tr><td>&nbsp;</td></tr>";
echo"<tr><td>&nbsp;</td></tr>";
echo"<tr><td>&nbsp;</td></tr>";
echo "<tr><td>Kepala Sekolah </td></tr>";

?>
