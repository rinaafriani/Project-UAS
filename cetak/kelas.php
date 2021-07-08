<body onLoad="javascript:window:print()">
<?php
session_start();

include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

// Membaca Kode Tahun Ajaran dari URL
$tahun		= isset($_GET['tahun']) ?  $_GET['tahun'] : '';

if(isset($tahun)) {
	$filterSql	= "WHERE kelas.tahun_ajar = '$tahun' ";
}
else {
	$filterSql = "";
}
?>
<html>
<head>
<title> :: Laporan Data Kelas | Sistem </title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<h3 align="center"> SMP Negeri 40 Padang </h3>
<p align="center">LAPORAN DATA KELAS </p>
<p align="center">Tahun Ajaran: <?php echo $tahun; ?></p>

<table align="center" class="table-list" width="700" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td width="25" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
    <td width="55" bgcolor="#F5F5F5"><strong>Kode</strong></td>
    <td width="146" bgcolor="#F5F5F5"><strong>Tahun Ajaran </strong></td>
    <td width="97" bgcolor="#F5F5F5"><strong>Nama Kelas </strong></td>
    <td width="105" align="left" bgcolor="#F5F5F5"><strong>Jumlah  Siswa </strong></td>
    <td width="227" bgcolor="#F5F5F5"><strong>Wali Kelas </strong></td>
  </tr>
  <?php
  	// Skrip menampilkan data Kelas
	$mySql = "SELECT kelas.*, guru.nama_guru  FROM kelas 
			  	LEFT JOIN guru ON kelas.kode_guru = guru.kode_guru
				$filterSql
				ORDER BY kelas.tahun_ajar, kelas.kode_kelas ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kode_kelas'];
		
		// Menghitung jumlah Siswa yang ada di setiap Kelas
		$my2Sql = "SELECT COUNT(*) AS total_siswa FROM kelas_siswa WHERE kode_kelas='$Kode'";
		$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query 2 salah : ".mysql_error());
		$my2Data= mysql_fetch_array($my2Qry);
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['kode_kelas']; ?></td>
    <td><?php echo $myData['tahun_ajar']; ?></td>
    <td><?php echo $myData['kelas']." | ".$myData['nama_kelas']; ?></td>
    <td><?php echo $my2Data['total_siswa']; ?></td>
    <td><?php echo $myData['nama_guru']; ?></td>
  </tr>
  <?php } ?>
</table>
<br><br>
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
</body>
</html>