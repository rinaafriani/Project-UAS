<div id='judul_kontent'><img src='images/user.ico' width='30' height='30'> Data Pasien Konsultasi</div>
<table id='theList' border=1 width='100%'>
<tr><th width="3%">No.</th><th>Nama</th>
<th width="18%">Jenis Kelamin </th>
<th width="7%">Alamat</th>

<th>Aksi</th></tr>
<?php
$sql = mysql_query("select * from rb_login ");
$no=1;
while($r = mysql_fetch_array($sql)){
if($r[aktif]==1){
$status="Online";
}else{
$status="Offline";
}
?>
<tr>
<td class='td' align='center'><?echo$no;?></td>
<td class='td' width='30%'><?echo"$r[nama_lengkap] ";?></td>
<td class='td' align='center'><?echo$r[jenis_kelamin];?></td>
<td class='td'><?echo$r[alamat];?></td>

<td class='td' align='center' width='18%'>
 <a  href='?page=registrasi&act=delete&id=<?echo$r[id_user];?>' onclick="return confirm('Anda yakin untuk menghapus data ini ?')"><button style='width:60px;text-align:center;'>Delete</button></a> </td>
</tr>
<?
$no++;
}
?>
</table>

<?
if($_GET[page]=='registrasi' and $_GET[act]=='delete'){
$sql=mysql_query("delete from user where id_user='$_GET[id]'");
echo"<script>window.location.href='?page=registrasi'</script>";
}

?>