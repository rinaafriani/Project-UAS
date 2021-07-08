<?php
include_once "library/inc.sesadmin.php";
include_once "library/inc.library.php";

# Tahun Terpilih
$tahun 			= isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$dataTahunAngk 	= isset($_POST['cmbTahunAngk']) ? $_POST['cmbTahunAngk'] : $tahun;

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM siswa WHERE tahun_angkatan='$dataTahunAngk'";
$pageQry= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($pageQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?>
<h2>LAPORAN DATA SISWA </h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
<table width="450" border="0" cellpadding="2" cellspacing="1" class="table-list">
<tr>
  <td colspan="3" bgcolor="#CCCCCC"><b>FILTER </b></td>
</tr>
<tr>
  <td width="112"><b>Tahun Angkatan</b></td>
  <td width="5"><b>:</b></td>
  <td width="317">
  <select name="cmbTahunAngk">
    <?php
  $dataSql = "SELECT tahun_angkatan FROM siswa GROUP BY tahun_angkatan ORDER BY tahun_angkatan";
  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
  while ($dataRow = mysql_fetch_array($dataQry)) {
	if ($dataTahunAngk == $dataRow['tahun_angkatan']) {
		$cek = " selected";
	} else { $cek=""; }
	echo "<option value='$dataRow[tahun_angkatan]' $cek>$dataRow[tahun_angkatan]</option>";
  }
  ?>
  </select>
    <strong>
    <input name="btnTampil" type="submit" value="Tampilkan" />
    </strong></td>
</tr>
</table>
</form>

<table class="table-list" width="850" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="27" height="23" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="58" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="74" bgcolor="#CCCCCC"><strong>NIS </strong></td>
    <td width="178" bgcolor="#CCCCCC"><strong>Nama Siswa </strong></td>
    <td width="56" bgcolor="#CCCCCC"><strong>Kelamin</strong></td>
    <td width="261" bgcolor="#CCCCCC"><strong>Alamat</strong></td>
    <td width="90" bgcolor="#CCCCCC"><strong>No. Telepon </strong></td>
    <td width="65" bgcolor="#CCCCCC"><strong>Angkatan</strong></td>
  </tr>
  <?php
  	// Menampilkan Semua data Siswa dengan Filter per Tahun
	$mySql = "SELECT * FROM siswa WHERE tahun_angkatan='$dataTahunAngk' ORDER BY kode_siswa ASC LIMIT $mulai, $baris";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$nomor  = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kode_siswa'];
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['kode_siswa']; ?></td>
    <td><?php echo $myData['nis']; ?></td>
    <td><?php echo $myData['nama_siswa']; ?></td>
    <td><?php echo $myData['kelamin']; ?></td>
    <td><?php echo $myData['alamat']; ?></td>
    <td><?php echo $myData['no_telepon']; ?></td>
    <td><?php echo $myData['tahun_angkatan']; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="4" bgcolor="#F5F5F5"><b>Jumlah data  :</b> <?php echo $jumlah; ?></td>
    <td colspan="4" align="right" bgcolor="#F5F5F5"><b>Halaman ke :</b>
    <?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?open=Laporan-Siswa&hal=$h&tahun=$dataTahunAngk'>$h</a> ";
	}
	?>    </td>
  </tr>
</table>
<br />
<a href="cetak/siswa.php?tahun=<?php echo $dataTahunAngk; ?>&kodeJurusan=<?php echo $dataJurusan; ?>" target="_blank"> 
<img src="images/btn_print2.png" width="20" border="0"/>
</a>