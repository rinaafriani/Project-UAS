<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtNIP			= $_POST['txtNIP'];
	$txtNama		= $_POST['txtNama'];
	$cmbKelamin		= $_POST['cmbKelamin'];
	$txtAlamat		= $_POST['txtAlamat'];
	$txtNoTelp		= $_POST['txtNoTelp'];
	$rbAktif		= $_POST['rbAktif'];

	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if(trim($txtNIP)=="") {
		$pesanError[] = "Data <b>NIP</b> tidak boleh kosong, harus diisi !";		
	}
	if(trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Guru</b> tidak boleh kosong, harus diisi !";		
	}
	if(trim($cmbKelamin)=="KOSONG") {
		$pesanError[] = "Data <b>Jenis Kelamin</b> belum dipilih !";		
	}
	if(trim($txtAlamat)=="") {
		$pesanError[] = "Data <b>Alamat Tinggal</b> tidak boleh kosong, harus diisi !";		
	}
	if(trim($txtNoTelp)=="") {
		$pesanError[] = "Data <b>No. Telepon</b> tidak boleh kosong, harus diisi !";		
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
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database	
				
		// Membaca Kode dari form
		$Kode	= $_POST['txtKode'];

		// SQL Simpan data ke tabel database
		$mySql	= "UPDATE jadwal_guru SET 
						nip='$txtNIP', kode_guru='$txtNama',
						kelas='$cmbKelamin', matapelajaran='$txtAlamat',
						 id_h='$txtNoTelp', id_w='$rbAktif'
				  WHERE kode_jadwal='$Kode'";		
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			// Setelah data disimpan, Refresh
			echo "<meta http-equiv='refresh' content='0; url=media.php?module=jadwal_data'>";
		}
		exit;
	}	
} // Penutup POST

# TAMPILKAN DATA YANG AKAN DIUBAH/DIEDIT
$Kode	= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
$mySql 	= "SELECT * FROM jadwal_guru WHERE kode_jadwal='$Kode'";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData = mysql_fetch_array($myQry); 
	
	# MEMBUAT NILAI DATA PADA VARIABEL FORM
	// Masukkan data dari Database ke dalam variabel, supaya bisa dipanggil di Form
	$dataKode		= $myData['kode_jadwal'];
	$dataNIP		= isset($_POST['txtNIP']) ? $_POST['txtNIP'] : $myData['nip'];
	$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['kode_guru'];
	$dataKelamin	= isset($_POST['cmbKelamin']) ? $_POST['cmbKelamin'] : $myData['kelas'];
	$dataAlamat		= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : $myData['matapelajaran'];
	$dataNoTelp		= isset($_POST['txtNoTelp']) ? $_POST['txtNoTelp'] : $myData['id_h'];
	

	$dataAktif		= isset($_POST['rbAktif']) ? $_POST['rbAktif'] : $myData['id_w'];
	
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="post" target="_self">
  <table class="table-list" width="100%" border="0" cellpadding="3" cellspacing="1">
    <tr>
      <td colspan="3" bgcolor="#F5F5F5"><b>UBAH DATA JADWAL GURU</b></td>
    </tr>
    <tr>
      <td width="234"><b>Kode</b></td>
      <td width="5"><b>:</b></td>
      <td width="953"><input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="8" readonly="readonly">
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>"> </td>
    </tr>
    <tr>
      <td><b>NIP </b></td>
      <td><b>:</b></td>
      <td><input name="txtNIP" type="text" value="<?php echo $dataNIP; ?>" size="40" maxlength="60"> </td>
    </tr>
    <tr>
      <td><b>Nama Guru </b></td>
      <td><b>:</b></td>
      <td><input name="txtNama" type="text" value="<?php echo $dataNama; ?>" size="80" maxlength="100"></td>
    </tr>
    <tr>
      <td><b> Kelas </b></td>
      <td><b>:</b></td>
      <td><input name="cmbKelamin" type="text" value="<?php echo $dataKelamin; ?>" size="80" maxlength="100"></td>
    </tr>
    <tr>
      <td><b>Mata Pelajaran</b></td>
      <td><b>:</b></td>
      <td><input name="txtAlamat" type="text" value="<?php echo $dataAlamat; ?>" size="80" maxlength="100"></td>
    </tr>
    <tr>
      <td><b>Hari </b></td>
      <td><b>:</b></td>
      <td><input name="txtNoTelp" type="text" value="<?php echo $dataNoTelp; ?>" size="30" maxlength="25"></td>
    </tr>
	<tr>
      <td><b>Jam </b></td>
      <td><b>:</b></td>
      <td><input name="rbAktif" type="text" value="<?php echo $dataAktif; ?>" size="30" maxlength="25"></td>
    </tr>
   
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnSimpan" type="submit" value=" Simpan " class='btn btn-success'></td>
    </tr>
  </table>
</form>
</body>
</html>
