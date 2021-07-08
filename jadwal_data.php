<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM jadwal_guru";
$pageQry= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($pageQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?>
<table width="100%" border="0" cellpadding="2" cellspacing="0"  class='table table-bordered table-striped'>
  <tr>
    <td colspan="2" align="right"><h5><b>Jadwal Guru</b></h5></td>
  </tr>
  <tr>
    <td colspan="2"><a href="media.php?module=jadwal_add" target="_self" class="btn btn-primary" >Tambah Data</a></td>
  </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table class='table table-bordered table-striped' width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td width="38" height="23" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
        <td width="122" bgcolor="#F5F5F5"><strong>Kode Jadwal</strong></td>
      
        <td width="284" bgcolor="#F5F5F5"><strong>Kode Guru </strong></td>
		 <td width="284" bgcolor="#F5F5F5"><strong>Nama Guru </strong></td>
        <td width="219" bgcolor="#F5F5F5"><strong>Mata Pelajaran</strong></td>
		<td width="92" bgcolor="#F5F5F5"><strong>Kelas</strong></td>
		<td width="118" bgcolor="#F5F5F5"><strong>ID Hari</strong></td>
		<td width="105" bgcolor="#F5F5F5"><strong>Jam</strong></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong><strong></strong></td>
      </tr>
      <?php
	$mySql = "SELECT * FROM jadwal_guru ORDER BY kode_jadwal ASC LIMIT $mulai, $baris";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$nomor = $mulai; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kode_jadwal'];
		
		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
      <tr bgcolor="<?php echo $warna; ?>">
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['kode_jadwal']; ?></td>

        <td><?php echo $myData['kode_guru']; ?></td>
		 <td><?php echo $myData['nama_guru']; ?></td>
        <td><?php echo $myData['matapelajaran']; ?></td>
		<td><?php echo $myData['kelas']; ?></td>
		<td><?php echo $myData['id_h']; ?></td>
		<td><?php echo $myData['id_w']; ?></td>
        <td width="67" align="center"><a href="media.php?module=jadwal_edit&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data" class="btn btn-info" >Edit</a> </td>
        <td width="71" align="center"><a href="media.php?module=jadwal_delete&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data"  onclick="return confirm('YAKIN AKAN MENGHAPUS DATA INI ... ?')" class="btn btn-warning" >Delete</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td height="22" bgcolor="#F5F5F5"><b>Jumlah Data :</b> <?php echo $jumlah; ?> </td>
    <td align="right" bgcolor="#F5F5F5"><b>Halaman ke :</b>
      <?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?module=jadwal_data&hal=$h'>$h</a> ";
	}
	?></td>
  </tr>
</table>
