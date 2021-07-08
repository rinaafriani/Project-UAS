<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM kelas";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	 = mysql_num_rows($pageQry);
$maksData= ceil($jumlah/$baris);
?>
<table width="800" border="0" cellpadding="2" cellspacing="0" class='table table-bordered table-striped'>
  
  <tr>
    <td colspan="2" align="right"><h4><b>DATA KELAS </b></h4></td>
  </tr>
  
  <tr>
    <td colspan="2"><a href="media.php?module=kelas_add" target="_self" class="btn btn-primary" >Tambah Data</a></td>
  </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<table class='table table-bordered table-striped' width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td width="28" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
        <td width="75" bgcolor="#F5F5F5"><strong>Kode</strong></td>
        <td width="131" bgcolor="#F5F5F5"><strong>Tahun Ajaran </strong></td>
        <td width="129" bgcolor="#F5F5F5"><strong>Nama Kelas </strong></td>
        <td width="85" align="center" bgcolor="#F5F5F5"><strong> Qty Siswa</strong></td>
        <td width="217" bgcolor="#F5F5F5"><strong>Wali Kelas </strong></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><b>Tools</b><b></b></td>
        </tr>
      <?php
	# Skrip menampilkan data Kelas
	$mySql = "SELECT kelas.*, guru.nama_guru FROM kelas
				LEFT JOIN guru ON kelas.kode_guru = guru.kode_guru
				ORDER BY kelas.tahun_ajar, kelas.kode_kelas ASC LIMIT $hal, $baris";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kode_kelas'];
		
		# Sub Skrip menghitung jumlah siswa
		$my2Sql = "SELECT COUNT(*) AS total_siswa FROM kelas_siswa WHERE kode_kelas='$Kode'";
		$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query 2 salah : ".mysql_error());
		$my2Data= mysql_fetch_array($my2Qry);
		
		// Gradasi warna baris
		if($nomor%2==1) { $warna="#FFFFFF"; } else {$warna="#F5F5F5";}
	?>
      <tr bgcolor="<?php echo $warna; ?>">
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['kode_kelas']; ?></td>
        <td><?php echo $myData['tahun_ajar']; ?></td>
        <td><?php echo $myData['kelas']." | ".$myData['nama_kelas']; ?></td>
        <td align="center"><?php echo $my2Data['total_siswa']; ?></td>
        <td><?php echo $myData['nama_guru']; ?></td>
        <td width="45" align="center"><a href="media.php?module=kelas_edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
        <td width="45" align="center"><a href="media.php?module=kelas_delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA KELAS INI ... ?')">Delete</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td height="22" bgcolor="#F5F5F5"><b>Jumlah Data :</b> <?php echo $jumlah; ?> </td>
    <td height="22" align="right" bgcolor="#F5F5F5"><b>Halaman ke :</b>      
	<?php
	for ($h = 1; $h <= $maksData; $h++) {
		$list[$h] = $baris * $h - $baris;
		echo " <a href='?module=kelas_data&hal=$list[$h]'>$h</a> ";
	}
	?>	</td>
  </tr>
</table>
