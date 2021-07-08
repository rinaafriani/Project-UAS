<?php
session_start();

include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
?>
<html>
<head>
<title>:: Laporan Data Siswa </title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2> LAPORAN DATA SISWA </h2>
<table class="table-list" width="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3" bgcolor="#F5F5F5"><strong>INFORMASI</strong></td>
  </tr>
  <tr>
    <td width="120"><strong>Tahun Angkatan </strong></td>
    <td width="17"><strong>:</strong></td>
    <td width="263"><?php echo $tahun; ?></td>
  </tr>
  <tr>
    <td><strong>Jurusan</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $infoData['nama_jurusan']; ?></td>
  </tr>
</table>

<table class="table-list" width="850" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="28" height="23" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
    <td width="76" bgcolor="#F5F5F5"><strong>Kode</strong></td>
    <td width="86" bgcolor="#F5F5F5"><strong>NIS</strong></td>
    <td width="201" bgcolor="#F5F5F5"><strong>Nama Siswa </strong></td>
    <td width="66" bgcolor="#F5F5F5"><strong>Kelamin</strong></td>
    <td width="261" bgcolor="#F5F5F5"><strong>Alamat</strong></td>
    <td width="96" bgcolor="#F5F5F5"><strong>No. Telepon </strong></td>
  </tr>
  <?php
	 // Membaca Kode Tahun Angkatan dari URL
	$tahun	= isset($_GET['tahun']) ?  $_GET['tahun'] : date('Y');
	
 	// Menampilkan Semua data Siswa dengan Filter per Tahun
	$mySql = "SELECT * FROM siswa WHERE tahun_angkatan='$tahun' ORDER BY kode_siswa ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['kode_siswa']; ?></td>
    <td><?php echo $myData['nis']; ?></td>
    <td><?php echo $myData['nama_siswa']; ?></td>
    <td><?php echo $myData['kelamin']; ?></td>
    <td><?php echo $myData['alamat']; ?></td>
    <td><?php echo $myData['no_telepon']; ?></td>
  </tr>
  <?php } ?>
</table>
<img src="../images/btn_print.png" width="20" onClick="javascript:window.print()" />
</body>
</html>