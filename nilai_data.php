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
<h3> <strong>DATA NILAI</strong> </h3>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
<table width="600" border="0" cellpadding="2" cellspacing="1" class='table table-bordered table-striped'>
<tr>
  <td colspan="3" bgcolor="#CCCCCC"><b>FILTER DATA </b></td>
</tr>
<tr>
  <td width="110"><b>Pilih Kelas </b></td>
  <td width="5"><b>:</b></td>
  <td width="469">
  <select name="cmbKelas">
    <option value="KOSONG">....</option>
    <?php
	  $dataSql = "SELECT * FROM kelas ORDER BY tahun_ajar";
	  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($dataRow = mysql_fetch_array($dataQry)) {
		if ($dataRow['kode_kelas'] == $dataKelas) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$dataRow[kode_kelas]' $cek>$dataRow[kelas] | $dataRow[nama_kelas] ( $dataRow[tahun_ajar] )</option>";
	  }
	  ?>
  </select>
      <input name="btnPilih1" type="submit" value=" Pilih " class="btn btn-primary" /></td>
</tr>
<tr>
  <td><b>Pilih Pelajaran </b></td>
  <td><b>:</b></td>
  <td><select name="cmbPelajaran">
    <option value="KOSONG">....</option>
    <?php
	  $dataSql = "SELECT pelajaran.* FROM nilai, pelajaran 
	  				WHERE nilai.kode_pelajaran = pelajaran.kode_pelajaran
					AND nilai.kode_kelas = '$dataKelas'
					GROUP BY nilai.kode_pelajaran ORDER BY nilai.kode_pelajaran";
	  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($dataRow = mysql_fetch_array($dataQry)) {
	  	if ($dataRow['kode_pelajaran'] == $dataPelajaran) {
			$cek = " selected";
		} else { $cek=""; }
	  	echo "<option value='$dataRow[kode_pelajaran]' $cek> $dataRow[nama_pelajaran]</option>";
	  }
	  ?>
  </select>
  <input name="btnPilih2" type="submit" value=" Pilih " class="btn btn-primary"/></td>
</tr>
<tr>
  <td><b>Pilih Semester </b></td>
  <td><b>:</b></td>
  <td><select name="cmbSemester">
    <option value="KOSONG">....</option>
    <?php
		  $pilihan	= array("1" => "Ganjil", "2" => "Genap");
          foreach ($pilihan as $isi => $info ) {
            if ($isi == $dataSemester) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$isi' $cek> $isi - $info</option>";
          }
          ?>
  </select>
    <input name="btnPilih3" type="submit" value=" Pilih "  class="btn btn-primary"/></td>
</tr>
</table>
</form>

<table width="800" border="0" cellpadding="2" cellspacing="0" class='table table-bordered table-striped'>
  
  <tr>
    <td colspan="2"><a href="media.php?module=nilai_add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a></td>
  </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<table class='table table-bordered table-striped' width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td width="30" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
        <td width="70" bgcolor="#F5F5F5"><strong>NIS</strong></td>
        <td width="319" bgcolor="#F5F5F5"><strong>Nama Siswa  </strong></td>
        <td width="70" bgcolor="#F5F5F5"><strong>Semester</strong></td>
        <td width="60" bgcolor="#F5F5F5"><strong>Tugas 1 </strong></td>
        <td width="60" bgcolor="#F5F5F5"><strong>Tugas 2 </strong></td>
        <td width="60" bgcolor="#F5F5F5"><strong>UTS</strong></td>
        <td width="60" bgcolor="#F5F5F5"><strong>UAS</strong></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><b>Tools</b><b></b></td>
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
        <td width="46" align="center"><a href="media.php?module=nilai_edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data" class="btn btn-info">Edit</a></td>
        <td width="45" align="center"><a href="media.php?module=nilai_delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA NILAI PELAJARAN INI ... ?')" class="btn btn-warning">Delete</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
</table>
