<?php
session_start();
if(! (session_is_registered(SES_MEMBER)))
{
	echo "<script>window.alert('Untuk mengakses, Anda harus Login Sebagai Members');
        window.location=('../login.html')</script>";
}
?>