<?php

include_once "library/inc.connection.php";
# Tahun Terpilih
$dataKelas 		= isset($_POST['cmbKelas']) ? $_POST['cmbKelas'] : '';
$dataPelajaran 	= isset($_POST['cmbPelajaran']) ? $_POST['cmbPelajaran'] : '';
$dataSemester	= isset($_POST['cmbSemester']) ? $_POST['cmbSemester'] : '';

# Filter Data Nilai berdasarkan Combo yang dipilih
$filterSQL	= "";
if(isset($_POST['btnPilih1'])) {
	$filterSQL = " WHERE nilai.kode_kelas = '$dataKelas'";
}
elseif(isset($_POST['btnPilih2'])) {
	$filterSQL = " WHERE nilai.kode_kelas = '$dataKelas' AND nilai.kode_pelajaran = '$dataPelajaran'";
}
elseif(isset($_POST['btnPilih3'])) {
	$filterSQL = " WHERE nilai.kode_kelas = '$dataKelas' AND nilai.kode_pelajaran = '$dataPelajaran' AND nilai.semester = '$dataSemester'";
}
else {
	$filterSQL = "";
}
?>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
<body onLoad="javascript:print()"> 
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
<table width="100%" border="0" cellpadding="2" cellspacing="1" class="table-list">


<p align="center"> <span class="style1">SMP Negeri 2 Lubuk Basung </span><br>
DATA NILAI SISWA </p><hr>
<table align="center" width="100%" border="0" cellpadding="2" cellspacing="0" class="table-border">
  

  
  <tr>

  </tr>
  <tr>
    <td colspan="2">
	<table align="center" class="table-list" width="100%" border="1" cellspacing="1" cellpadding="2">
      <tr>
        <td width="30" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
        <td width="70" bgcolor="#F5F5F5"><strong>NIS</strong></td>
        <td width="319" bgcolor="#F5F5F5"><strong>Nama Siswa  </strong></td>
        <td width="70" bgcolor="#F5F5F5"><strong>Semester</strong></td>
        <td width="60" bgcolor="#F5F5F5"><strong>Tugas 1 </strong></td>
        <td width="60" bgcolor="#F5F5F5"><strong>Tugas 2 </strong></td>
        <td width="60" bgcolor="#F5F5F5"><strong>UTS</strong></td>
        <td width="60" bgcolor="#F5F5F5"><strong>UAS</strong></td>
		<td width="66" bgcolor="#F5F5F5"><strong>Rata-Rata</strong></td>
		 <td width="154" align="center" bgcolor="#F5F5F5"><strong>Nilai Angka</strong></td>
      <td width="154" align="center" bgcolor="#F5F5F5"><strong>Nilai Huruf</strong></td>
     
     <td width="154" align="center" bgcolor="#F5F5F5"><strong>Keterangan</strong></td>
      
      </tr>
      <?php
	  // Skrip menampilkan data Nilai
	$mySql = "SELECT nilai.*, pelajaran.nama_pelajaran, siswa.nama_siswa, siswa.nis 
				FROM nilai
				LEFT JOIN pelajaran ON nilai.kode_pelajaran = pelajaran.kode_pelajaran
				LEFT JOIN siswa ON nilai.kode_siswa = siswa.kode_siswa
				$filterSQL
				ORDER BY semester, kode_pelajaran ASC"; 
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['id'];
		
		// Gradasi warna baris
		if($nomor%2==1) { $warna="#FFFFFF"; } else {$warna="#F5F5F5";}
	?>
      <tr bgcolor="<?php echo $warna; ?>">
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['nis']; ?></td>
        <td><?php echo $myData['nama_siswa']; ?></td>
        <td><?php echo $myData['semester']; ?></td>
        <td><?php echo $myData['nilai_tugas1']; ?></td>
        <td><?php echo $myData['nilai_tugas2']; ?></td>
        <td><?php echo $myData['nilai_uts']; ?></td>
        <td><?php echo $myData['nilai_uas']; ?></td>

    <?php 
$total_biaya = ($myData['nilai_tugas1'] *0.15)+ ($myData['nilai_tugas2'] *0.15)+ ($myData['nilai_uts']*0.30)+ ($myData['nilai_uas']*0.40);
 $bobot=($total_biaya/100)*4;
	echo "<td>";
	echo "$total_biaya";
	echo "</td>";
	
	
	?>
  
    <td align="center"><?php echo number_format($bobot, 2, '.', '') ?></td>
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