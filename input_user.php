<?php
include "conn.php";
$page = $_GET[page];
$act = $_GET[act];
//if($page=='registrasi' and $act=='save')
//{
if(empty($_POST[username]) 
or empty($_POST[password])
or empty($_POST[nama]) 
or empty($_POST[jk]) 
or empty($_POST[nohp]) 

 
){
 echo"<script>alert('Silahkan Lengkapi Data Anda Terlebih Dahulu !');window.location.href='media.php?module=daftar'</script>";
}else{
$cek=mysql_query("select * from rb_login where username='$_POST[username]'");
$jumlah=mysql_num_rows($cek);
if ($jumlah)
{
 echo"<script>alert('Maaf, data ini sudah terdaftar');window.location.href='media.php?module=daftar'</script>";
} else {
			
$kl=mysql_query("insert into rb_login(username,password,nama_lengkap,induk,level,email,nohp,alamat)
 value('$_POST[username]','$_POST[password]','$_POST[nama]','$_POST[nis]','siswa','$_POST[jk]','$_POST[nohp]','$_POST[alamat]')");
 $kk=mysql_query("insert into siswa(username,password,nama_lengkap,induk,level,email,nohp,alamat)
 value('$_POST[username]','$_POST[password]','$_POST[nama]','$_POST[nis]','siswa','$_POST[jk]','$_POST[nohp]','$_POST[alamat]')");
 
 echo"<script>alert('Data Anda Sukses Tersimpan');window.location.href='login.html'</script>";


}
}
?>