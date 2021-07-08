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
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr>
          <td width="26" height="23" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
		   <td width="60" bgcolor="#F5F5F5"><strong>Foto</strong></td>
          <td width="60" bgcolor="#F5F5F5"><strong>Kode</strong></td>
          <td width="90" bgcolor="#F5F5F5"><strong>NIS</strong></td>
          <td width="314" bgcolor="#F5F5F5"><strong>Nama Siswa </strong></td>
		    <td width="60" bgcolor="#F5F5F5"><strong>Kelas </strong></td>
          <td width="80" bgcolor="#F5F5F5"><strong>Kelamin</strong></td>
          <td colspan="3" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        </tr>
        <?php
	$mySql = "SELECT * FROM siswa where wali_kelas='$_SESSION[namalengkap]'  ORDER BY kode_siswa ASC LIMIT $mulai, $baris";
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
		   <td> <img src="foto/<?php echo $myData['foto']; ?>"  width="50" height="50"></td>
          <td><?php echo $myData['kode_siswa']; ?></td>
          <td><?php echo $myData['nis']; ?></td>
          <td><?php echo $myData['nama_siswa']; ?></td>
		  <td><?php echo $myData['kelas']; ?></td>
          <td><?php echo $myData['kelamin']; ?></td>
         
          <td width="45" align="center"><a href="media.php?module=siswa_edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a> </td>
          <td width="45" align="center"><a href="media.php?module=siswa_delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data"  onclick="return confirm('YAKIN AKAN MENGHAPUS DATA SISWA INI ... ?')">Delete</a></td>
        </tr>
        <?php } ?>
      </table></td>
    </tr>
    
</table>
