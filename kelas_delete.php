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
	
	// Menghapus data sesuai Kode yang didapat di URL
	$mySql	= "DELETE FROM kelas WHERE kode_kelas='$Kode'"; 
	$myQry	= mysql_query($mySql, $koneksidb) or die ("Eror hapus data".mysql_error());
	if($myQry){
		// Menghapus data kelas siswa
		$my2Sql	= "DELETE FROM kelas_siswa WHERE kode_kelas='$Kode'";
		mysql_query($my2Sql, $koneksidb);
		
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=media.php?module=kelas_data'>";
	}
}
?>