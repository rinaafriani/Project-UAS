<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
}
-->
</style>
<body onLoad="javascript:print()">   
<?php
include('conn.php');


//query
$sql=mysql_query("select * from siswa
where kelas like '$_POST[bulan]%' ORDER BY nis ") or die
(mysql_error());
$nomor = 0; 
?>
<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
}
.style2 {
	font-size: 22px;
	font-weight: bold;
}
-->
</style>

<table width="100%" border="1" align="center" class="tbls">
<tr>
<td colspan="11">
							<p align="center"><strong><span class="style1">SMP NEGERI 40 PADANG</span></strong> <br>
						    Laporan Data Siswa<br>
      Kelas : <?php echo $_POST['bulan'];?></p></td>
   
  </tr>
  <tr>
    <td width="45" bgcolor="#00CCFF"><div align="center"><strong>No</strong></div></td>
    <td width="172" bgcolor="#00CCFF"><div align="center"><strong>Foto</strong></div></td>
    <td width="245" bgcolor="#00CCFF"><div align="center"><strong>Kode</strong></div></td>
    <td width="271" bgcolor="#00CCFF"><div align="center"><strong>NIS</strong></div></td>
    <td width="185" bgcolor="#00CCFF"><div align="center"><strong>Nama Siswa</strong></div></td>
	 <td width="185" bgcolor="#00CCFF"><div align="center"><strong>Kelas</strong></div></td>
	  <td width="185" bgcolor="#00CCFF"><div align="center"><strong>Kelamin</strong></div></td>
   
  </tr>
  <?php 
 
		 while($re=mysql_fetch_array($sql)){
	
		$nomor++;
	if($re['id_h']==111){
		$hari='Senin';
		} else if ($re['id_h']==112){
		$hari='Selasa';
		} else if ($re['id_h']==113){
		$hari='Rabu';
		}else if ($re['id_h']==114){
		$hari='Kamis';
		}else if ($re['id_h']==115){
		$hari='Jummat';
		}else if ($re['id_h']==116){
		$hari='Sabtu';
		}
		  ?>
  <tr align="left" valign="top" >
    <td><?php echo $nomor;?> </td>
	 <td><img src="foto/<?php echo $re['foto']; ?>"  width="50" height="50"> </td>
	 
    <td><?php echo $re[kode_siswa] ?> </td>
	<td><?php echo $re[nis] ?> </td>
	<td><?php echo $re[nama_siswa] ?> </td>
    <td><?php echo $re[kelas] ?> </td>
	<td><?php echo $re[kelamin] ?> </td>
    
  </tr>
 
 
    <?php } ?>
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
