<?php

include_once "library/inc.library.php";
include_once "library/inc.connection.php";


# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtPelajaran	= $_POST['txtPelajaran'];
	$txtPelajaran	= str_replace("'","&acute;",$txtPelajaran);
	$txtKeterangan	= $_POST['txtKeterangan'];

	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($txtPelajaran)=="") {
		$pesanError[] = "Data <b>Nama Pelajaran</b> tidak boleh kosong !";		
	}
	if (trim($txtKeterangan)=="") {
		$pesanError[] = "Data <b>Keterangan</b> tidak boleh kosong !";	
	}
	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika jumlah error $pesanError tidak ada, simpan datanya
		$Kode	= $_POST['txtKode'];
		$mySql	= "UPDATE pelajaran SET nama_pelajaran='$txtPelajaran', keterangan = '$txtKeterangan' WHERE kode_pelajaran='$Kode'";
		$myQry=mysql_query($mySql, $koneksidb) or die ("Gagal query update".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=media.php?module=pelajaran_data'>";
		}
		exit;
	}	
} // Penutup POST

# MEMBACA DATA DARI DATABASE
$Kode	 = isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
$mySql	= "SELECT * FROM pelajaran WHERE kode_pelajaran='$Kode'";
$myQry	= mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData = mysql_fetch_array($myQry);

	# MEMBUAT NILAI DATA PADA FORM
	$dataKode		= $myData['kode_pelajaran'];
	$dataPelajaran	= isset($_POST['txtPelajaran']) ? $_POST['txtPelajaran'] : $myData['nama_pelajaran'];
	$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : $myData['keterangan'];
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmedit">
<table class="table-list" width="100%" style="margin-top:0px;">
	<tr>
	  <td colspan="3" bgcolor="#F5F5F5"><strong>UBAH DATA PELAJARAN</strong></td>
	</tr>
	<tr>
	  <td width="15%"><b>Kode</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="textfield" value="<?php echo $dataKode; ?>" size="8" maxlength="4"  readonly="readonly"/>
    <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td></tr>
	<tr>
	  <td><b>Nama Pelajaran </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtPelajaran" value="<?php echo $dataPelajaran; ?>" size="80" maxlength="100" /></td>
	</tr>
	<tr>
      <td><b>Keterangan</b></td>
	  <td><b>:</b></td>
	  <td><input name="txtKeterangan" value="<?php echo $dataKeterangan; ?>" size="80" maxlength="100" /></td>
    </tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
</form>

