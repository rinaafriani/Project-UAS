<?php
session_start();
if(! (session_is_registered(SES_ADMIN)))
{
		echo "<script>window.alert('Untuk mengakses, Anda harus Login Sebagai Admin');
        window.location=('../administrator.php')</script>";
}
?>