<?php
if(! isset($_SESSION['SES_LOGIN'])) {
	echo "<center>";
	echo "<br> <br> <b>Maaf Akses Anda Ditolak!</b> <br>
		  Yang boleh login hanya Admin dan Pengajaran saja <br>
		  Silahkan masukkan Data Login Anda dengan benar untuk bisa mengakses halaman ini.";
	echo "</center>";
	include_once "login.html";
	exit;
}  
?>