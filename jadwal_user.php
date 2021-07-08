<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM jadwal_guru";
$pageQry= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($pageQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?>
<form name="ss" method="POST" ACTION="media.php?module=jadwal_user"/>
Cari Jadwal Guru <br>
<input type="text" name="t1"/>
<br>
<input type="submit" class="btn btn-info" value="cari"/>
</FORM>
<table width="100%" border="0" cellpadding="2" cellspacing="0"  class='table table-bordered table-striped'>
  <tr>
<td colspan="2" align="right"><h5><b>Jadwal Guru</b></h5></td>
  </tr>
  
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table class='table table-bordered table-striped' width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td width="38" height="23" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
        	<td width="118" bgcolor="#F5F5F5"><strong>Hari</strong></td>
		<td width="105" bgcolor="#F5F5F5"><strong>Jam</strong></td>

        <td width="284" bgcolor="#F5F5F5"><strong>Nama Guru </strong></td>
        <td width="219" bgcolor="#F5F5F5"><strong>Mata Pelajaran</strong></td>
		<td width="92" bgcolor="#F5F5F5"><strong>Kelas</strong></td>
	
       
      </tr>
      <?
	  $t1=$_POST['t1'];
	$mySql = "SELECT* FROM jadwal_guru 
WHERE nama_guru='".$t1."' ORDER BY id_h  ASC ";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$nomor = $mulai; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kode_jadwal'];
		
		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
		if($myData['id_h']==111){
		$hari='Senin';
		} else if ($myData['id_h']==112){
		$hari='Selasa';
		} else if ($myData['id_h']==113){
		$hari='Rabu';
		}else if ($myData['id_h']==114){
		$hari='Kamis';
		}else if ($myData['id_h']==115){
		$hari='Jummat';
		}else if ($myData['id_h']==116){
		$hari='Sabtu';
		}
	?>
      <tr bgcolor="<?php echo $warna; ?>">
        <td align="center"><?php echo $nomor; ?></td>
       <td><?php echo $hari; ?></td>
		<td><?php echo $myData['id_w']; ?></td>
       
        <td><?php echo $myData['nama_guru']; ?></td>
        <td><?php echo $myData['matapelajaran']; ?></td>
		<td><?php echo $myData['kelas']; ?></td>
		
       
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  
</table>
