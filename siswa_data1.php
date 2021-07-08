<?php

include_once "library/inc.library.php";
include_once "library/inc.connection.php";

$pencarianSQL	= "";
# PENCARIAN DATA 
if(isset($_POST['btnCari'])) {
	$txtKataKunci	= trim($_POST['txtKataKunci']);

	// Menyusun sub query pencarian
	$pencarianSQL	= "WHERE nis='$txtKataKunci' OR nama_siswa LIKE '%$txtKataKunci%' ";
}

# Teks pada form
$dataKataKunci = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';


# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM siswa $pencarianSQL";
$pageQry= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($pageQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?>
<table width="700" border="0" cellpadding="2" cellspacing="0" class='table table-bordered table-striped'>
    <tr>
      <td colspan="2" align="right"><h4 align="center"><b>DATA SISWA </b></h4></td>
    </tr>
    <tr>
      <td colspan="2">




	  </td>
    </tr>
    <tr>

    </tr>
    
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr>
          <td width="26" height="23" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
          <td width="60" bgcolor="#F5F5F5"><strong>Kode</strong></td>
          <td width="90" bgcolor="#F5F5F5"><strong>NIS</strong></td>
          <td width="314" bgcolor="#F5F5F5"><strong>Nama Siswa </strong></td>

          <td colspan="3" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        </tr>
        <?php
	$mySql = "SELECT kelas_siswa.kode_kelas, siswa.kode_siswa, nis, nama_siswa, kelas.kode_guru, guru.kode_guru, nama_guru
FROM kelas_siswa, siswa, kelas, guru
WHERE guru.nama_guru ='$_SESSION[namalengkap]'
AND kelas_siswa.kode_siswa = siswa.kode_siswa
AND kelas_siswa.kode_kelas = kelas.kode_kelas
AND kelas.kode_guru = guru.kode_guru";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$nomor = $mulai; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kode_siswa'];
		
		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
        <tr bgcolor="<?php echo $warna; ?>">
          <td align="center"><?php echo $nomor; ?></td>
          <td><?php echo $myData['kode_siswa']; ?></td>
          <td><?php echo $myData['nis']; ?></td>
          <td><?php echo $myData['nama_siswa']; ?></td>
         
       
         
          <td width="45" align="center"><a href="media.php?module=siswa_edit1&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a> </td>
          <td width="45" align="center"><a href="media.php?module=siswa_delete1&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data"  onclick="return confirm('YAKIN AKAN MENGHAPUS DATA SISWA INI ... ?')">Delete</a></td>
        </tr>
        <?php } ?>
      </table></td>
    </tr>
    <tr class="selKecil">
      <td height="22" bgcolor="#F5F5F5"><b>Jumlah Data :</b> <?php echo $jumlah; ?> </td>
      <td align="right" bgcolor="#F5F5F5"><b>Halaman ke :</b>
        <?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?module=siswa_data&hal=$h'>$h</a> ";
	}
	?></td>
    </tr>
</table>
