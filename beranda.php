<style type="text/css">
<!--
.style3 {font-size: 12px}
-->
.style4 {
	font-size: 16px;
	font-family: "Trebuchet MS";}
</style>
<p class="style4">Data Management</p>
<hr>
<table border="0" >

				<tr>
<td width="609"><p><a href="media.php?module=tambah_anggota" class='btn btn-info'>Tambah Data</a> <a href="kartu_anggota.php" class='btn btn-warning' target="_blank">Cetak Kartu Anggota</a> <a href="media.php?module=tambah_user" class='btn btn-success'>Tambah Data User</a>				</td>				
				<td width="697" align="right"><?php include_once("pencarian1.php");?></td>
				</tr>
			</table>
<?php
	
		include "conn.php";
		include "config/tglindo.php";
		$batas =  5;
		$halaman = $_GET['halaman'];
		if(empty($halaman)){
			$posisi = 0;
			$halaman = 1;
		}else{
			$posisi = ($halaman - 1) * $batas;
		}
		
		$sql = mysql_query("select * from anggota ORDER BY id_anggota ASC limit $posisi, $batas");
		
		echo "<table width='100%' class='table table-bordered table-striped'>
			<tr>
			<th>Kode</th>
			<th>No Induk</th>
			<th>Nama</th>
			<th>Jenis Kelamin</th>
			<th>Email</th>
			<th>No Hp</th>
			<th>Jenis Anggota</th>
			<th>Action</th>
			
			</tr>";
		while($data = mysql_fetch_array($sql)){
			echo "<tr>
				<td>$data[kode]</td>
				<td>$data[induk]</td>
				<td>$data[nama_lengkap]</td>
				<td>$data[jenis_kelamin]</td>
				<td>$data[email]</td>
				<td>$data[nohp]</td>
				<td>$data[status]</td>
				<td  align='center' > 
 
 <a  href='?module=anggota&act=delete&id=$data[id_anggota]' onclick='return confirm('Anda yakin untuk menghapus data ini ?')'>
<i class='icon-remove icon-black'></i></a> &nbsp; <a  href='?module=edit_anggota&id=$data[id_anggota]'><i class='icon-pencil icon-black'></i></a>&nbsp;&nbsp;<a  href='detail_kartu.php?id=$data[id_anggota]' target='_blank'><i class='icon-print icon-black'></i></a>
 
 </td>
				</tr>";
		}
		echo "</table>";
		echo "Halaman : ";
		
		$sqlhal = mysql_query("select * from anggota");
		$sqldat = mysql_query("select * from user_pengunjung");
		$jmldata = mysql_num_rows($sqlhal);
		$jmldat = mysql_num_rows($sqldat);
		$jmlhal = ceil($jmldata/$batas);
		
		// Membuat First dan Previous
		if($halaman > 1){
			$previous = $halaman - 1;
			echo "<a href='$_SERVER[PHP_SELF]?halaman=1&module=anggota' class=\"btn btn-primary edit\">&laquo; First</a>  
			     <a href='$_SERVER[PHP_SELF]?halaman=$previous&module=anggota' class=\"btn btn-primary edit\">&lsaquo; Prev</a>";
		}else{
			echo "&laquo; First | &lsaquo; Prev | ";
		}
			
		//Menampilkan Angka Halaman
		/*for($i=1; $i<=$jmlhal;$i++){
			if($i != $halaman){
				echo " <a href='$_SERVER[PHP_SELF]?halaman=$i'>$i</a> | ";
			}else{
				echo " <b>$i</b> | ";
			}
		}*/
		$angka = ($halaman > 3 ? " ... " : " ");
		
		for($i=$halaman-2; $i<$halaman; $i++){
			if($i < 1)
				continue;
			$angka .= "<a href='$_SERVER[PHP_SELF]?halaman=$i&module=anggota' class=\"btn btn-primary edit\">$i</a> ";
		}
		
		$angka .= " <b>$halaman</b> ";
		
		for($i = $halaman+1; $i<($halaman+3); $i++){
			if($i > $jmlhal)
				break;
			$angka .= "<a href='$_SERVER[PHP_SELF]?halaman=$i&module=anggota' class=\"btn btn-primary edit\">$i</a> ";
		}
		
		$angka .= ($halaman+2 < $jmlhal ? " ... <a href='$_SERVER[PHP_SELF]?halaman=$jmlhal&module=anggota' class=\"btn btn-primary edit\">$jmlhal</a> " : " ");
		
		echo "$angka";
		
		// Membuat Next dan Last
		if($halaman< $jmlhal){
			$next = $halaman + 1;
			echo "<a href='$_SERVER[PHP_SELF]?halaman=$next&module=anggota' class=\"btn btn-primary edit\">Next &rsaquo;</a>  
			     <a href='$_SERVER[PHP_SELF]?halaman=$jmlhal&module=anggota' class=\"btn btn-primary edit\">Last &raquo;</a>";
		}else{
			echo "Next &rsaquo; | Last &raquo; | ";
		}
		
	
		echo"<br>";
		echo"<br>";
		echo"<br>";
		echo"<br>";
	
?></div>
<?
if($_GET[module]=='anggota' and $_GET[act]=='delete'){
$sql=mysql_query("delete from anggota where id_anggota='$_GET[id]'");
echo"<script>window.location.href='?module=anggota'</script>";
}

?>
</div>
