<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
?>
<h3 align="center"> LAPORAN DATA PELAJARAN </h3>

<table align="center" class='table table-bordered table-striped' width="700" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="25" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="60" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="437" bgcolor="#CCCCCC"><strong>Nama Pelajaran </strong></td>
    <td width="143" bgcolor="#CCCCCC"><strong>Keterangan</strong></td>
  </tr>
  <?php
	$mySql = "SELECT * FROM pelajaran ORDER BY kode_pelajaran ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['kode_pelajaran']; ?></td>
    <td><?php echo $myData['nama_pelajaran']; ?></td>
    <td><?php echo $myData['keterangan']; ?></td>
  </tr>
  <?php } ?>
</table>
<br />
<a href="cetak/pelajaran.php" target="_blank"> 
<img src="images/btn_print2.png" width="20" border="0"/>
</a>