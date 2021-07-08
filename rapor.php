<?php
include_once "library/inc.library.php";
include_once "library/inc.connection.php";
# Tahun Terpilih
$dataKelas 		= isset($_POST['cmbKelas']) ? $_POST['cmbKelas'] : '';
$dataPelajaran 	= isset($_POST['cmbPelajaran']) ? $_POST['cmbPelajaran'] : '';
$dataSemester	= isset($_POST['cmbSemester']) ? $_POST['cmbSemester'] : '';

# Filter Data Nilai berdasarkan Combo yang dipilih
$filterSQL	= "";
if(isset($_POST['btnPilih'])) {
	$filterSQL = " AND nilai.kode_kelas = '$dataKelas' AND nilai.semester = '$dataSemester'";
}
else {
	$filterSQL = "";
}
?>

<h4>NILAI RAPORT SISWA</h4>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd" target="_self">


<table id='theList' border=1 width='100%' class='table table-bordered table-striped'>
  <tr>
    <th width="39" height="23" align="center" bgcolor="#CCCCCC"><strong>No</strong></th>
    <th width="80" bgcolor="#CCCCCC"><strong>Kode</strong></th>
    <th width="98" bgcolor="#CCCCCC"><strong>NIS </strong></th>
    <th width="265" bgcolor="#CCCCCC"><strong>Nama Siswa </strong></th>
    <th width="120" bgcolor="#CCCCCC"><strong>Angkatan</strong></th>
    <th width="120" bgcolor="#CCCCCC"><strong>Aksi</strong></th>
   
  </tr>
  <?php
  	// Menampilkan Semua data Siswa dengan Filter per Tahun
	$mySql = "SELECT kelas_siswa.*, nilai.semester, siswa.nis, siswa.nama_siswa, siswa.tahun_angkatan 
			FROM nilai, kelas, kelas_siswa
			LEFT JOIN siswa ON kelas_siswa.kode_siswa = siswa.kode_siswa
			WHERE siswa.nama_siswa='$_SESSION[namalengkap]'  AND kelas.kode_kelas = kelas_siswa.kode_kelas AND kelas.kode_kelas = nilai.kode_kelas
			$filterSQL
			GROUP BY kode_siswa ORDER BY kode_siswa ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$kodeSiswa 	= $myData['kode_siswa'];
		$kodeKelas 	= $myData['kode_kelas'];
		$semester 	= $myData['semester'];
		
		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
  <tr bgcolor="<?php echo $warna; ?>">
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['kode_siswa']; ?></td>
    <td><?php echo $myData['nis']; ?></td>
    <td><?php echo $myData['nama_siswa']; ?></td>
    <td><?php echo $myData['tahun_angkatan']; ?></td>
    <td align="center" bgcolor="<?php echo $warna; ?>"><a href="cetak/raport_siswa.php?kodeSiswa=<?php echo $kodeSiswa;   ?>&kodeKelas=<?php echo $kodeKelas; ?>&semester=<?php echo $semester; ?>" class='btn btn-success' target="_blank">Cetak Raport</a></td>
  </tr>
  <?php } ?>
</table>
