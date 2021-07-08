<?php

include_once "library/inc.library.php";
include_once "library/inc.connection.php";

// Kode di URL harus ada
if(empty($_GET['Kode'])){
	echo "<b>Data yang dihapus tidak ada</b>";
}
else {
	// Membaca Kode dari URL
	$Kode	= $_GET['Kode'];
	
	// Menghapus data sesuai Kode yang didapat di URL
	$mySql	= "DELETE FROM pelajaran WHERE kode_pelajaran='$Kode'";
	$myQry	= mysql_query($mySql, $koneksidb) or die ("Eror hapus data".mysql_error());
	if($myQry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=media.php?module=pelajaran_data'>";
	}
}
?>