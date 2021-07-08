<?php
	
		include "conn.php" ;
include "config/tglindo.php";
		$batas =  10;
		$halaman = $_GET['halaman'];
		if(empty($halaman)){
			$posisi = 0;
			$halaman = 1;
		}else{
			$posisi = ($halaman - 1) * $batas;
		}
		
		
?>
<style type="text/css">
<!--
.style3 {font-size: 12px}
-->
.style4 {
	font-size: 16px;
	font-family: "Trebuchet MS";}
</style>

<p><?php include "tambah_kelas.php";?></p>
<table width="880"  border=1  class='table table-bordered table-striped'>
<tr>
<th bgcolor="#999999"><span class="style3">Kode Kelas</span></th>

<th bgcolor="#999999"><span class="style3">Nama Kelas</span></th>


<th width="35%" bgcolor="#999999"><span class="style3">Wali Kelas</span></th>



<th width="29%" bgcolor="#999999"><span class="style3">Aksi</span></th>



</tr>

<?php
$sql = mysql_query("select * from tb_kelas  ");
$no=1;
while($r = mysql_fetch_array($sql)){
if($r[aktif]==1){
$status="Online";
}else{
$status="Offline";
}
?>
<tr>


<td class='td' width='14%' ><span class="style3"><?echo"$r[kode_kelas]";?></span></td>
<td class='td' width='22%' ><span class="style3"><?echo"$r[nama_kelas]";?></span></td>


<td class='td'><span class="style3"><?echo$r[wali_kelas];?></span></td>

<td width='29%' align='center' class='td style3'>
<a  href='?module=edit_kelas&id=<?echo$r[kode_kelas];?>'>
<button class='btn btn-warning'>Edit</button></a>  <a  href='?module=lihat_kelas&act=delete&id=<?echo$r[kode_kelas];?>' onclick="return confirm('Anda yakin untuk menghapus data ini ?')">
 <button class='btn btn-danger'>Delete</button></a> </td></tr>
<?
$no++;
}
?>
</table>

<?
if($_GET[module]=='lihat_kelas' and $_GET[act]=='delete'){
$sql=mysql_query("delete from tb_kelas where kode_kelas='$_GET[id]'");
echo"<script>window.location.href='?module=lihat_kelas'</script>";
}

?>