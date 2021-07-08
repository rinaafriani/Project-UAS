
<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM jadwal_guru";
$pageQry= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($pageQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
$tahun = date('Y');
?>
<style type="text/css">
<!--
.style1 {
	color: #000000;
	font-weight: bold;
}
.style2 {color: #666666}
.style3 {color: #000000}
-->
</style>

<h4 align="center">DAFTAR PELAJARAN SEMESTER 1 (GANJIL)
<BR>
SMP NEGRI 40 PADANG
<BR>
TAHUN PELAJARAN <?PHP echo $tahun ?></h4>
<div align="center">

<hr align="center" width="69%" id="No CSS Style" color="#000000">
<hr align="center" width="48%"  id="No CSS Style" color="#000000">
<hr align="center" width="35%"  id="No CSS Style" color="#000000">
<table class="table-list" width="850" bgcolor="#999999"cellspacing="1" cellpadding="2">
    
    <tr>
      <th  width="7%"><div align="center">Hari</div></th>
      <td width="19%"><div align="center"><strong>Waktu</strong></div></td>
      <td width="30%"><div align="center"><strong>Kelas IX </strong></div></td>
  
    <td width="23%"><div align="center"><strong>Kelas VII </strong></div></td>
     
    <td width="21%"><div align="center"><strong>Kelas VII </strong></div></td>
    </tr>
  </TABLE>
<table class="table-list" width="850" bgcolor="#FFFFFF" border="1" cellspacing="1" cellpadding="2">
    <tr>
      <td width="7%">&nbsp;</td>
      <td width="19%">&nbsp;</td>
      <td width="11%"><div align="center"><strong>1</strong></div></td>
      <td width="9%"><div align="center"><strong>2</strong></div></td>
      <td width="10%"><div align="center"><strong>3</strong></div></td>
      <td width="9%"><div align="center"><strong>1</strong></div></td>
      <td width="7%"><div align="center"><strong>2</strong></div></td>
      <td width="7%"><div align="center"><strong>3</strong></div></td>
      <td width="9%"><div align="center"><strong>1</strong></div></td>
      <td width="5%"><div align="center"><strong>2</strong></div></td>
      <td width="7%"><div align="center"><strong>3</strong></div></td>



    </tr>

  
    <?php
	# Skrip menampilkan data Kelas
	$mySql = "SELECT jadwal_guru.kode_jadwal, kelas, hari.id_h, hari, waktu_j.id_w,jamm,guru.kode_guru
FROM jadwal_guru, hari, waktu_j,guru
WHERE jadwal_guru.id_h = hari.id_h
AND jadwal_guru.id_w = waktu_j.id_w  and jadwal_guru.kode_guru=guru.kode_guru";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
	
	?>
 
  <tr>
  
  
   <td><strong><?php  echo $myData['hari']  ?></strong></td>
   <td><?php  echo $myData['jamm']  ?></td>
  
 
     
   <td><strong>
     <?php  echo $myData['kode_guru']  ?>
   </strong></td>
   <td><strong>
     <?php  echo $myData['kode_guru']  ?>
   </strong></td>
   <td><strong>
  
     <?php  echo $myData['kode_guru']  ?>
   </strong></td>
   <td><strong>
     <?php  echo $myData['kode_guru']  ?>
   </strong></td>
   <td><strong>
     <?php  echo $myData['kode_guru']  ?>
   </strong></td>
   <td><strong>
     <?php  echo $myData['kode_guru']  ?>
   </strong></td>
   <td><strong>
     <?php  echo $myData['kode_guru']  ?>
   </strong></td>
   <td><strong>
     <?php  echo $myData['kode_guru']  ?>
   </strong></td>
     <td><strong>
     <?php  echo $myData['kode_guru']  ?>
   </strong></td>
 

  <?php } ?>
</table>
    <table class="table-list" width="850" border="1" cellspacing="1" cellpadding="2">
    <?php
	# Skrip menampilkan data Kelas
	$mySql = "SELECT jadwal_guru.kode_jadwal, kelas, hari.id_h, hari, waktu_j.id_w,jamm,guru.kode_guru
FROM jadwal_guru, hari, waktu_j,guru
WHERE jadwal_guru.id_h = hari.id_h
AND jadwal_guru.id_w = waktu_j.id_w  and jadwal_guru.kode_guru=guru.kode_guru";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
$myData = mysql_fetch_array($myQry);
	
	?>
 
  <tr>
      <tr>
        <td width="212"><span class="style1">BK</span></td>
	
        <td width="83"><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
        <td width="72"><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
        <td width="73"><div align="center" class="style3"><strong>21K</strong></div></td>
        <td width="70"><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
        <td width="61"><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
        <td width="47"><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
        <td width="51"><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
        <td width="56"><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
        <td width="52"><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
      </tr>
      <tr>
        <td><span class="style3"><strong>PENJASKES</strong></span></td>
        <td><div align="center" class="style3"><strong>230</strong></div></td>
        <td><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
        <td><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
        <td><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
        <td><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
        <td><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
        <td><div align="center" class="style3"><strong>220</strong></div></td>
        <td><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
        <td><div align="center"><span class="style2"><span class="style3"></span></span></div></td>
      </tr>
      <tr>
        <td><span class="style3"><strong>WALI KELAS </strong></span></td>
      	  <td><div align="center" class="style3"><strong>
   	      <?php  echo $myData['kode_guru']  ?>
   	      </strong></div></td>
      	  <td><div align="center" class="style3"><strong>
   	      <?php  echo $myData['kode_guru']  ?>
   	      </strong></div></td>
      	  <td><div align="center" class="style3"><strong>
   	      <?php  echo $myData['kode_guru']  ?>
   	      </strong></div></td>
      	  <td><div align="center" class="style3"><strong>
   	      <?php  echo $myData['kode_guru']  ?>
   	      </strong></div></td>
		        	  <td><div align="center" class="style3"><strong>
	        	      <?php  echo $myData['kode_guru']  ?>
	        	      </strong></div></td>
      	  <td><div align="center" class="style3"><strong>
   	      <?php  echo $myData['kode_guru']  ?>
   	      </strong></div></td>
      	  <td><div align="center" class="style3"><strong>
   	      <?php  echo $myData['kode_guru']  ?>
   	      </strong></div></td>
      	  <td><div align="center" class="style3"><strong>
   	      <?php  echo $myData['kode_guru']  ?>
   	      </strong></div></td>
      	  <td><div align="center" class="style3"><strong>
   	      <?php  echo $myData['kode_guru']  ?>
   	      </strong></div></td>
      </tr>
  </table>
   
     <?php
echo "<table align='right'>";
$tgl = date('d M Y');
echo "<tr><td>Padang, $tgl</td></tr>";
echo "<tr><td>Mengetahui,</td></tr>";
echo "<tr><td><em>&nbsp;</em></td></tr>";
echo "<tr><td><em>&nbsp;</em></td></tr>";
echo "<tr><td><em>&nbsp;</em></td></tr>";
echo "<tr><td>Kepala Sekolah</td></tr>";

?>
    </p>
    <p>
  </p>
      </p>
    <p>&nbsp;    </p>
</div>
