<?php
include "conn.php";
$page = $_GET[page];
$act = $_GET[act];
//if($page=='registrasi' and $act=='save')
//{
if(empty($_POST[kode]) 
or empty($_POST[barang])
or empty($_POST[nm]) 


 
){
 echo"<script>alert('Silahkan Lengkapi Data Anda Terlebih Dahulu !');window.location.href='media.php?module=lihat_kelas'</script>";
}else{
$cek=mysql_query("select * from tb_kelas where kode_kelas='$_POST[kode]'");
$jumlah=mysql_num_rows($cek);
if ($jumlah)
{
 echo"<script>alert('Maaf, data ini sudah terdaftar');window.location.href='media.php?module=lihat_kelas'</script>";
} else {
			
$kl=mysql_query("insert into tb_kelas(kode_kelas,nama_kelas,wali_kelas)
 value('$_POST[kode]','$_POST[barang]','$_POST[nm]')");
 
 
 echo"<script>alert('Data Anda Sukses Tersimpan');window.location.href='media.php?module=lihat_kelas'</script>";


}
}
?>