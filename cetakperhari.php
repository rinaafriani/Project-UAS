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
$sql=mysql_query("select * from jadwal_guru
where kelas like '$_POST[bulan]%' ORDER BY kode_jadwal asc ") or die
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
						    Laporan Daftar Pelajaran<br>
      Kelas : <?php echo $_POST['bulan'];?></p></td>
   
  </tr>
  <tr>
    <td width="45" bgcolor="#00CCFF"><div align="center"><strong>No</strong></div></td>
    <td width="172" bgcolor="#00CCFF"><div align="center"><strong>Hari</strong></div></td>
    <td width="245" bgcolor="#00CCFF"><div align="center"><strong>Jam</strong></div></td>
    <td width="271" bgcolor="#00CCFF"><div align="center"><strong>NIP</strong></div></td>
	 <td width="271" bgcolor="#00CCFF"><div align="center"><strong>Nama Guru</strong></div></td>
    <td width="185" bgcolor="#00CCFF"><div align="center"><strong>Mata Pelajaran</strong></div></td>
   
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
    <td align="center"><?php echo $nomor;?> </td>
	 <td align="center"><?php echo $hari ?> </td>
	  <td align="center"><?php echo $re[id_w] ?> </td>
    <td align="center"><?php echo $re[kode_guru] ?> </td>
	<td>&nbsp;&nbsp;<?php echo $re[nama_guru] ?> </td>
    <td align="center"><?php echo $re[matapelajaran] ?> </td>
    
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
