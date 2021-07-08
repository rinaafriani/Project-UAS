<?php
include_once "library/inc.sesadmin.php";

# Tahun Terpilih
$dataKelas 		= isset($_POST['cmbKelas']) ? $_POST['cmbKelas'] : '';
$dataSiswa 		= isset($_POST['cmbSiswa']) ? $_POST['cmbSiswa'] : '';
$dataSemester	= isset($_POST['cmbSemester']) ? $_POST['cmbSemester'] : '';

$filterSQL	= "";
# Filter Kelas
if(isset($_POST['btnPilih1'])) {
	$filterSQL = " WHERE nilai.kode_kelas = '$dataKelas'";
}
elseif(isset($_POST['btnPilih2'])) {
	$filterSQL = " WHERE nilai.kode_kelas = '$dataKelas' AND nilai.kode_siswa = '$dataSiswa'";
}
elseif(isset($_POST['btnPilih3'])) {
	$filterSQL = " WHERE nilai.kode_kelas = '$dataKelas' AND nilai.kode_siswa = '$dataSiswa' AND nilai.semester = '$dataSemester'";
}
else {
	$filterSQL = "";
}


# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM nilai $filterSQL";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	 = mysql_num_rows($pageQry);
$maksData= ceil($jumlah/$baris);
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
<table width="400" border="0" cellpadding="2" cellspacing="1" class="table-list">
<tr>
  <td colspan="3" bgcolor="#CCCCCC"><b>FILTER DATA </b></td>
</tr>
<tr>
  <td width="112"><b>Pilih Kelas </b></td>
  <td width="5"><b>:</b></td>
  <td width="317">
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
      <input name="btnPilih1" type="submit" value=" Pilih " /></td>
</tr>
<tr>
  <td><b>Pilih Siswa </b></td>
  <td><b>:</b></td>
  <td><select name="cmbSiswa">
    <option value="KOSONG">....</option>
    <?php
	  $dataSql = "SELECT siswa.* FROM siswa, kelas_siswa 
	  			  WHERE siswa.kode_siswa = kelas_siswa.kode_siswa AND kelas_siswa.kode_kelas='$dataKelas'
				  ORDER BY nama_siswa";
	  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($dataRow = mysql_fetch_array($dataQry)) {
	  	if ($dataRow['kode_siswa'] == $dataSiswa) {
			$cek = " selected";
		} else { $cek=""; }
	  	echo "<option value='$dataRow[kode_siswa]' $cek>$dataRow[nis] - $dataRow[nama_siswa]</option>";
	  }
	  ?>
  </select>
    <input name="btnPilih2" type="submit" value=" Pilih " /></td>
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
    <input name="btnPilih3" type="submit" value=" Pilih " /></td>
</tr>
</table>
</form>

<table width="800" border="0" cellpadding="2" cellspacing="0" class="table-border">
  <tr>
    <td colspan="2"><a href="?open=Nilai-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a></td>
  </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="30" align="center"><strong>No</strong></th>
        <th width="70">NIS</th>
        <th width="70"><b>Semester</b></th>
        <th width="319"><strong>Nama Pelajaran  </strong></th>
        <th width="60">Tugas 1 </th>
        <th width="60">Tugas 2 </th>
        <th width="60">UTS</th>
        <th width="60">UAS</th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><b>Tools</b><b></b></td>
        </tr>
      <?php
	  // Skrip menampilkan data Kelas
	$mySql = "SELECT nilai.*, pelajaran.nama_pelajaran, siswa.nama_siswa, siswa.nis 
				FROM nilai
				LEFT JOIN pelajaran ON nilai.kode_pelajaran = pelajaran.kode_pelajaran
				LEFT JOIN siswa ON nilai.kode_siswa = siswa.kode_siswa
				$filterSQL
				ORDER BY semester, kode_pelajaran ASC LIMIT $hal, $baris";
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
        <td><?php echo $myData['semester']; ?></td>
        <td><?php echo $myData['nama_pelajaran']; ?></td>
        <td><?php echo $myData['nilai_tugas1']; ?></td>
        <td><?php echo $myData['nilai_tugas2']; ?></td>
        <td><?php echo $myData['nilai_uts']; ?></td>
        <td><?php echo $myData['nilai_uas']; ?></td>
        <td width="46" align="center"><a href="?open=Nilai-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
        <td width="45" align="center"><a href="?open=Nilai-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA NILAI PELAJARAN INI ... ?')">Delete</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td height="22" bgcolor="#CCCCCC"><b>Jumlah Data :</b> <?php echo $jumlah; ?> </td>
    <td height="22" align="right" bgcolor="#CCCCCC"><b>Halaman ke :</b>      
	<?php
	for ($h = 1; $h <= $maksData; $h++) {
		$list[$h] = $baris * $h - $baris;
		echo " <a href='?open=Nilai-Data&hal=$list[$h]'>$h</a> ";
	}
	?>	</td>
  </tr>
</table>
