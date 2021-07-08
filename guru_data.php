<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM guru";
$pageQry= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($pageQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?>
<table width="100%" border="0" cellpadding="2" cellspacing="0"  class='table table-bordered table-striped'>
  <tr>
    <td colspan="2" align="right"><h5><b>DATA GURU </b></h5></td>
  </tr>
  <tr>
    <td colspan="2"><a href="media.php?module=guru_add" target="_self" class="btn btn-primary" >Tambah Data</a></td>
  </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table class='table table-bordered table-striped' width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td width="25" height="23" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
        <td width="60" bgcolor="#F5F5F5"><strong>Kode</strong></td>
        <td width="97" bgcolor="#F5F5F5"><strong>NIP</strong></td>
        <td width="250" bgcolor="#F5F5F5"><strong>Nama Guru </strong></td>
        <td width="120" bgcolor="#F5F5F5"><strong>Jenis Kelamin</strong></td>
		<td width="71" bgcolor="#F5F5F5"><strong>No Hp</strong></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong><strong></strong></td>
      </tr>
      <?php
	$mySql = "SELECT * FROM guru ORDER BY kode_guru ASC LIMIT $mulai, $baris";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$nomor = $mulai; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kode_guru'];
		
		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
      <tr bgcolor="<?php echo $warna; ?>">
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['kode_guru']; ?></td>
        <td><?php echo $myData['nip']; ?></td>
        <td><?php echo $myData['nama_guru']; ?></td>
        <td><?php echo $myData['kelamin']; ?></td>
		<td><?php echo $myData['no_telepon']; ?></td>
        <td width="45" align="center"><a href="media.php?module=guru_edit&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data" class="btn btn-info" >Edit</a> </td>
        <td width="45" align="center"><a href="media.php?module=guru_delete&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data"  onclick="return confirm('YAKIN AKAN MENGHAPUS DATA GURU INI ... ?')" class="btn btn-warning" >Delete</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td height="22" bgcolor="#F5F5F5"><b>Jumlah Data :</b> <?php echo $jumlah; ?> </td>
    <td align="right" bgcolor="#F5F5F5"><b>Halaman ke :</b>
      <?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?module=guru-data&hal=$h'>$h</a> ";
	}
	?></td>
  </tr>
</table>
