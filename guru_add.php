<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtNIP			= $_POST['txtNIP'];
	$txtPass			= $_POST['txtPass'];
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
		// Buat Kode Guru
		$kodeBaru	= buatKode("guru", "G");
		
		// Simpan data dari form ke Database
		$mySql	= "INSERT INTO guru ( 
								kode_guru, nip, nama_guru,
								kelamin, alamat, no_telepon, status_aktif)
							VALUES ( 
									'$kodeBaru', '$txtNIP', '$txtNama', 
									'$cmbKelamin', '$txtAlamat', '$txtNoTelp', '$rbAktif')";		
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		
		$mySql1	= "INSERT INTO rb_login ( 
								username,password,nama_lengkap,induk,level,email,nohp,alamat)
							VALUES ( 
									'$txtNIP','$txtPass','$txtNama','$txtNis','walikelas','$cmbKelamin','$txtNoTelp','$txtAlamat')";		
		$myQry1	= mysql_query($mySql1, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			// Setelah data disimpan, Refresh
			echo "<meta http-equiv='refresh' content='0; url=media.php?module=guru_data'>";
		}
		exit;
	}	
} // Penutup POST

# MEMBUAT NILAI DATA PADA FORM
$dataKode		= buatKode("guru", "G");
$dataNIP		= isset($_POST['txtNIP']) ? $_POST['txtNIP'] : '';
$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataKelamin	= isset($_POST['cmbKelamin']) ? $_POST['cmbKelamin'] : '';
$dataAlamat		= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '';
$dataNoTelp		= isset($_POST['txtNoTelp']) ? $_POST['txtNoTelp'] : '';
$dataAktif		= isset($_POST['rbAktif']) ? $_POST['rbAktif'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="post" target="_self">
  <table class="table-list" width="100%" border="0" cellpadding="3" cellspacing="1">
    <tr>
      <td colspan="3" bgcolor="#F5F5F5"><b>TAMBAH DATA GURU</b></td>
    </tr>
    <tr>
      <td width="283"><b>Kode</b></td>
      <td width="5"><b>:</b></td>
      <td width="904"><input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="8" readonly="readonly"></td>
    </tr>
    <tr>
      <td><b>NIP </b></td>
      <td><b>:</b></td>
      <td><input name="txtNIP" type="text" value="<?php echo $dataNIP; ?>" size="40" maxlength="60"> </td>
    </tr>
	 <tr>
      <td><b>Password </b></td>
      <td><b>:</b></td>
      <td><input name="txtPass" type="password" size="40" maxlength="60"> </td>
    </tr>
    <tr>
      <td><b>Nama Guru </b></td>
      <td><b>:</b></td>
      <td><input name="txtNama" type="text" value="<?php echo $dataNama; ?>" size="80" maxlength="100"></td>
    </tr>
    <tr>
      <td><b> Kelamin </b></td>
      <td><b>:</b></td>
      <td><select name="cmbKelamin">
        <option value="KOSONG">....</option>
        <?php
		   $pilihan = array("Laki-laki", "Perempuan");
          foreach ($pilihan as $kelamin) {
            if ($dataKelamin==$kelamin) {
                $cek="selected";
            } else { $cek = ""; }
            echo "<option value='$kelamin' $cek>$kelamin</option>";
          }
          ?>
      </select></td>
    </tr>
    <tr>
      <td><b>Alamat Tinggal </b></td>
      <td><b>:</b></td>
      <td><input name="txtAlamat" type="text" value="<?php echo $dataAlamat; ?>" size="80" maxlength="100"></td>
    </tr>
    <tr>
      <td><b>No. Telepon </b></td>
      <td><b>:</b></td>
      <td><input name="txtNoTelp" type="text" value="<?php echo $dataNoTelp; ?>" size="30" maxlength="30"></td>
    </tr>
    <tr>
      <td><b>Status Aktif </b></td>
      <td><b>:</b></td>
      <td><input name="rbAktif" type="radio" value="Aktif" checked>Aktif
 	 <input name="rbAktif" type="radio" value="Tidak">
 	 Tidak Aktif </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnSimpan" type="submit" value=" Simpan "></td>
    </tr>
  </table>
</form>
