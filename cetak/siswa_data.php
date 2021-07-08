<?php

include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

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
<body onLoad="javascript:print()"> 
<table width="700" border="0" cellpadding="2" cellspacing="0" ALIGN="CENTER" class="table-border">
    <tr>
     <h4 align="center"><b>LAPORAN DATA SISWA </b></h4>

   
   <HR>
    </tr>
    <tr>
      <td colspan="2"><table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr>
          <td width="26" height="23" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
          <td width="60" bgcolor="#F5F5F5"><strong>Kode</strong></td>
          <td width="90" bgcolor="#F5F5F5"><strong>NIS</strong></td>
          <td width="314" bgcolor="#F5F5F5"><strong>Nama Siswa </strong></td>
          <td width="80" bgcolor="#F5F5F5"><strong>Kelamin</strong></td>
         
        </tr>
        <?php
	$mySql = "SELECT * FROM siswa $pencarianSQL ORDER BY kode_siswa ASC LIMIT $mulai, $baris";
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
          <td><?php echo $myData['kelamin']; ?></td>
         
        </tr>
        <?php } ?>
      </table></td>
    </tr>
    <tr class="selKecil">

    </td>
    </tr>
</table>
