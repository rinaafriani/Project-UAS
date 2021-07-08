<body onLoad="javascript:window:print()">
<?php
session_start();

include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

// Membaca Kode Tahun Ajaran dari URL
$kodeSiswa	= isset($_GET['kodeSiswa']) ?  $_GET['kodeSiswa'] : '';
$kodeKelas	= isset($_GET['kodeKelas']) ?  $_GET['kodeKelas'] : '';
$semester	= isset($_GET['semester']) ?  $_GET['semester'] : '';

if(isset($kodeKelas) and isset($semester) and  isset($kodeSiswa)) {
	// SQL Filter data Nilai Raport
	$filterSQL = " WHERE nilai.kode_kelas='$kodeKelas' AND nilai.semester='$semester' AND nilai.kode_siswa='$kodeSiswa'";
		
	// Skrip untuk menampilkan informasi Kelas dan Siswa
	$infoSql = "SELECT * FROM kelas WHERE kode_kelas='$kodeKelas'";
	$infoQry = mysql_query($infoSql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$infoData= mysql_fetch_array($infoQry);
	
	// Skrip untuk menampilkan data Siswa
	$info2Sql = "SELECT * FROM siswa WHERE kode_siswa='$kodeSiswa'";
	$info2Qry = mysql_query($info2Sql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$info2Data= mysql_fetch_array($info2Qry);
}
else {
	$filterSQL = "";
	$filter2SQL = "";
	exit;
}
?>
<html>
<head>
<title>:: Nilai Raport Siswa</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<p align="center"> <span class="style1">SMP Negeri 2 Lubuk Basung </span><br>
NILAI RAPORT SISWA </p><hr>
<table  align="center"class="table-list" width="300" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td width="110"><strong>Tahun Ajaran </strong></td>
    <td width="17"><strong>:</strong></td>
    <td width="173"><?php echo $infoData['tahun_ajar']; ?></td>
  </tr>
  <tr>
    <td><strong>Nama Kelas </strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $infoData['kelas']; ?>  <?php echo $infoData['nama_kelas']; ?></td>
  </tr>
  <tr>
    <td><strong>Semester</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $semester; ?></td>
  </tr>
  <tr>
    <td><strong>NIS</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $info2Data['nis']; ?></td>
  </tr>
  <tr>
    <td><strong>Nama Siswa </strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $info2Data['nama_siswa']; ?></td>
  </tr>
</table>
<br>
<table align="center" class="table-list"  width="100%" border="1" cellspacing="1" cellpadding="2">
  
  
  <tr>
    <td width="36" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
    <td width="310" bgcolor="#F5F5F5"><strong>Mata Pelajaran </strong></td>
    <td width="66" bgcolor="#F5F5F5"><strong>Tugas 1 </strong></td>
    <td width="66" bgcolor="#F5F5F5"><strong>Tugas 2 </strong></td>
    <td width="66" bgcolor="#F5F5F5"><strong>UTS</strong></td>
    <td width="66" bgcolor="#F5F5F5"><strong>UAS</strong></td>
	<td width="66" bgcolor="#F5F5F5"><strong>Rata-Rata</strong></td>
	  <td width="154" align="center" bgcolor="#F5F5F5"><strong>Nilai Angka</strong></td>
    <td width="154" align="center" bgcolor="#F5F5F5"><strong>Nilai Huruf</strong></td>
  
    <td width="154" align="center" bgcolor="#F5F5F5"><strong>Keterangan</strong></td>
  </tr>
  <?php
	$mySql = "SELECT nilai.*, pelajaran.nama_pelajaran FROM nilai
				LEFT JOIN pelajaran ON nilai.kode_pelajaran = pelajaran.kode_pelajaran
				$filterSQL
				ORDER BY nilai.kode_pelajaran ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td align="left"><?php echo $myData['nama_pelajaran']; ?></td>
    <td align="center"><?php echo $myData['nilai_tugas1']; ?></td>
    <td align="center"><?php echo $myData['nilai_tugas2']; ?></td>
    <td align="center"><?php echo $myData['nilai_uts']; ?></td>
    <td align="center"><?php echo $myData['nilai_uas']; ?></td>
	<?php 
$total_biaya = ($myData['nilai_tugas1'] *0.15)+ ($myData['nilai_tugas2'] *0.15)+ ($myData['nilai_uts']*0.30)+ ($myData['nilai_uas']*0.40);
 $bobot=($total_biaya/100)*4;
	echo "<td>";
	echo "$total_biaya";
	echo "</td>";?>
  
    <td align="center"><?php echo $bobot ?></td>
	<?php
	
	if($bobot >  3.38)
	{
	$nil_huru="A";
	
	} else if($bobot > 3.51)
	{
	$nil_huru="A-";
	
	}else if($bobot > 3.18)
	{
	$nil_huru="B+";
	
	}else if($bobot > 2.85)
	{
	$nil_huru="B";
	}
	
	else if($bobot > 2.51)
	{
	$nil_huru="B-";
	}
	
	else if($bobot > 2.18)
	{
	$nil_huru="c+";
	}
	else if($bobot > 1.85)
	{
	$nil_huru="C";
	}
	else if($bobot > 1.51)
	{
	$nil_huru="C-";
	} else{
	
	$nil_huru="D";
	}
	?>
	
	 <td align="center"><?php echo $nil_huru ?></td>
	   <td align="center"><?php echo $myData['keterangan']; ?></td>
  </tr>
  <?php } ?>
</table>
<br><br>

	<?php
echo "<table align='right'>";
$tgl = date('d M Y');
echo "<tr><td>Lubuk Basung, $tgl</td></tr>";
echo "<tr><td>Mengetahui,</td></tr>";
echo "<tr><td><em>&nbsp;</em></td></tr>";
echo "<tr><td><em>&nbsp;</em></td></tr>";
echo "<tr><td><em>&nbsp;</em></td></tr>";
echo "<tr><td>Kepala Sekolah</td></tr>";

?>
<p>
</p>
</body>
</html>