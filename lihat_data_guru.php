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

<p>Data Guru</p>

<table id='theList' border=1 width='100%' class='table table-bordered table-striped'>
<tr><th width="5%" bgcolor="#999999"><span class="style3">No.</span></th>
<th width="19%" bgcolor="#999999"><span class="style3">NIP </span></th>
<th bgcolor="#999999"><span class="style3">Nama Lengkap </span></th>


<th width="18%" bgcolor="#999999"><span class="style3">Jenis Kelamin</span></th>
<th width="14%" bgcolor="#999999"><span class="style3">No Hp</span></th>
<th width="22%" bgcolor="#999999"><span class="style3">Alamat</span></th>






</tr>
<?php
$sql = mysql_query("select * from guru ");
$no=1;
while($r = mysql_fetch_array($sql)){
if($r[aktif]==1){
$status="Online";
}else{
$status="Offline";
}
?>
<tr>
<td class='td' align='center'><span class="style3"><?echo$no;?></span></td>

<td class='td'><span class="style3"><?echo$r[nip];?></span></td>
<td class='td' width='22%' ><span class="style3"><?echo"$r[nama_guru]";?></span></td>


<td class='td'><span class="style3"><?echo$r[kelamin];?></span></td>
<td class='td'><span class="style3"><?echo$r[no_telepon];?></span></td>
<td class='td'><span class="style3"><?echo$r[alamat];?></span></td>


</tr>
<?
$no++;
}
?>
</table>

<?
if($_GET[module]=='lihat_user' and $_GET[act]=='delete'){
$sql=mysql_query("delete from rb_login where username='$_GET[id]'");
echo"<script>window.location.href='?module=lihat_user'</script>";
}

?>