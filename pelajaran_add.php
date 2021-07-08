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
		$kodeBaru	= buatKode("pelajaran", "P");
		$mySql	= "INSERT INTO pelajaran (kode_pelajaran, nama_pelajaran, keterangan) VALUES ('$kodeBaru', '$txtPelajaran', '$txtKeterangan')";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=media.php?module=pelajaran_data'>";
		}
		exit;
	}	
} // Penutup POST
	
# MEMBUAT NILAI DATA PADA FORM
$dataKode		= buatKode("pelajaran", "P");
$dataPelajaran	= isset($_POST['txtPelajaran']) ? $_POST['txtPelajaran'] : '';
$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd">
<table width="100%" cellpadding="2" cellspacing="1" class='table table-bordered table-striped'style="margin-top:0px;">
	<tr>
	  <td colspan="3" bgcolor="#F5F5F5"><strong>TAMBAH DATA PELAJARAN </strong></td>
	</tr>
	<tr>
	  <td width="15%"><b>Kode</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="10"  readonly="readonly"/></td></tr>
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
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;" class="btn btn-primary"></td>
    </tr>
</table>
</form>
