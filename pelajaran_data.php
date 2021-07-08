<?php

include_once "library/inc.library.php";
include_once "library/inc.connection.php";

?>
<table width="800" border="0" cellpadding="2" cellspacing="0" class='table table-bordered table-striped'>
  <tr>
    <td colspan="2" align="right"><h4><b>DATA PELAJARAN </b></h4></td>
  </tr>
  <tr>
    <td colspan="2"><a href="media.php?module=pelajaran_add" target="_self" class="btn btn-primary" >Tambah Data</a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table class='table table-bordered table-striped' width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td width="25" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
        <td width="60" bgcolor="#F5F5F5"><strong>Kode</strong></td>
        <td width="437" bgcolor="#F5F5F5"><strong>Nama Pelajaran </strong></td>
       
        <td colspan="2" align="center" bgcolor="#CCCCCC"><b>Tools</b></td>
      </tr>
      <?php
	$mySql = "SELECT * FROM pelajaran ORDER BY kode_pelajaran ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query pelajaran salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kode_pelajaran'];
		
		// Gradasi warna baris
		if($nomor%2==1) { $warna="#FFFFFF"; } else {$warna="#F5F5F5";}
	?>
      <tr bgcolor="<?php echo $warna; ?>">
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['kode_pelajaran']; ?></td>
        <td><?php echo $myData['nama_pelajaran']; ?></td>
       
        <td width="50" align="center"><a href="media.php?module=pelajaran_edit&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
        <td width="50" align="center"><a href="media.php?module=pelajaran_delete&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PELAJARAN INI ... ?')">Delete</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
</table>
