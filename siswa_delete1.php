<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

// Kode di URL harus ada
if(empty($_GET['Kode'])){
	echo "<b>Data yang dihapus tidak ada</b>";
}
else {
	// Membaca Kode dari URL
	$Kode	= $_GET['Kode'];

	# MENGHAPUS GAMBAR/FOTO, Caranya dengan membaca file gambar
	$mySql = "SELECT * FROM siswa WHERE kode_siswa='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$myData= mysql_fetch_array($myQry);
	if(! $myData['foto']=="") {
		if(file_exists("foto/".$myData['foto'])) {
			// Jika file gambarnya ada, akan dihapus
			unlink("foto/".$myData['foto']); 
		}
	}
	
	// Menghapus data sesuai Kode yang didapat di URL
	$mySql = "DELETE FROM siswa WHERE kode_siswa='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Eror hapus data".mysql_error());
	if($myQry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=media.php?module=siswa_data1' >";
	}
}
?>