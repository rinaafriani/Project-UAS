<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtNis			= $_POST['txtNis'];
	$txtNama		= $_POST['txtNama'];
	$cmbKelamin		= $_POST['cmbKelamin'];
	$cmbAgama		= $_POST['cmbAgama'];
	$txtTempatLahir	= $_POST['txtTempatLahir'];
	$txtTanggal		= InggrisTgl($_POST['txtTanggal']);
	$txtAlamat		= $_POST['txtAlamat'];
	$txtNoTelepon	= $_POST['txtNoTelepon'];
	$cmbAngkatan	= $_POST['cmbAngkatan'];
	$cmbStatus		= $_POST['cmbStatus'];

	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if(trim($txtNis)=="") {
		$pesanError[] = "Data <b>NIS Siswa</b> tidak boleh kosong, harus diisi !";		
	}

	# VALIDASI NIS DI DATABASE, jika sudah ada akan ditolak
	$Kode	= $_POST['txtKode'];
	$sqlCek="SELECT * FROM siswa WHERE nis='$txtNis' AND NOT(kode_siswa='$Kode')";
	$qryCek=mysql_query($sqlCek, $koneksidb) or die ("Eror Query".mysql_error()); 
	if(mysql_num_rows($qryCek)>=1){
		$pesanError[] = "Maaf, NIS <b> $txtNis </b> sudah ada, ganti dengan yang lain";
	}

	if(trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Siswa</b> tidak boleh kosong, harus diisi !";		
	}
	if(trim($cmbKelamin)=="KOSONG") {
		$pesanError[] = "Data <b>Jenis Kelamin</b> belum dipilih !";		
	}
	if(trim($cmbAgama)=="KOSONG") {
		$pesanError[] = "Data <b>Agama</b> belum dipilih !";		
	}
	if(trim($txtTempatLahir)=="") {
		$pesanError[] = "Data <b>Tempat Lahir</b> tidak boleh kosong, harus diisi !";		
	}
	if(trim($txtAlamat)=="") {
		$pesanError[] = "Data <b>Alamat Tinggal</b> tidak boleh kosong, harus diisi !";		
	}
	if(trim($txtNoTelepon)=="") {
		$pesanError[] = "Data <b>No. Telepon</b> tidak boleh kosong, harus diisi !";		
	}
	if(trim($cmbAngkatan)=="KOSONG") {
		$pesanError[] = "Data <b>Tahun Angkatan</b> belum dipilih !";		
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
				
		// Membaca Kode dari form hidden
		$Kode	= $_POST['txtKode'];
		
		# SKRIP UNTUK MENYIMPAN FOTO/GAMBAR
		if (empty($_FILES['namaFile']['tmp_name'])) {
			// Jika file baru tidak ada, mama file gambar lama yang dibaca
			$file_foto = $_POST['txtNamaFile'];
		}
		else  {
			// Jika file gambar lama ada, akan dihapus
			if(! $_POST['txtNamaFile']=="") {
			if(file_exists("foto/".$_POST['txtNamaFile'])) {
				unlink("foto/".$_POST['txtNamaFile']);	
			}
			}

			// Membaca nama file foto/gambar
			$file_foto = $_FILES['namaFile']['name'];
			$file_foto = stripslashes($file_foto);
			$file_foto = str_replace("'","",$file_foto);
			
			// Simpan gambar
			$file_foto = $Kode.".".$file_foto;
			copy($_FILES['namaFile']['tmp_name'],"foto/".$file_foto);					
		}

		// SQL Simpan data ke tabel database
		$mySql	= "UPDATE siswa  SET 
						nis='$txtNis', nama_siswa='$txtNama',
						kelamin='$cmbKelamin', agama='$cmbAgama', 
						tempat_lahir='$txtTempatLahir', tanggal_lahir='$txtTanggal',
						alamat='$txtAlamat', no_telepon='$txtNoTelepon', 
						foto='$file_foto', tahun_angkatan='$cmbAngkatan', status='$cmbStatus'
				  WHERE kode_siswa='$Kode'";		
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			// Setelah data disimpan, Refresh
			echo "<meta http-equiv='refresh' content='0; url=media.php?module=siswa_data'>";
		}
		exit;
	}	
} // Penutup POST

// Skrip membaca variable dari URL (Kode dikirim dari menu Edit)
$Kode	= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 

# TAMPILKAN DATA LOGIN UNTUK DIEDIT
$mySql 	= "SELECT * FROM siswa WHERE kode_siswa='$Kode'";
$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData = mysql_fetch_array($myQry); 

	# MEMBUAT NILAI DATA PADA FORM
	// Masukkan data ke dalam variabel, supaya bisa dipanggil di Form
	$dataKode		= $myData['kode_siswa'];
	$dataNis		= isset($_POST['txtNis']) ? $_POST['txtNis'] : $myData['nis'];
	$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nama_siswa'];
	$dataKelamin	= isset($_POST['cmbKelamin']) ? $_POST['cmbKelamin'] : $myData['kelamin'];
	$dataAgama		= isset($_POST['cmbAgama']) ? $_POST['cmbAgama'] : $myData['agama'];
	$dataTempatLahir= isset($_POST['txtTempatLahir']) ? $_POST['txtTempatLahir'] : $myData['tempat_lahir'];
	$dataTanggal	= isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] :  IndonesiaTgl($myData['tanggal_lahir']);
	$dataAlamat		= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : $myData['alamat'];
	$dataNoTelepon	= isset($_POST['txtNoTelepon']) ? $_POST['txtNoTelepon'] : $myData['no_telepon'];
	$dataAngkatan	= isset($_POST['cmbAngkatan']) ? $_POST['cmbAngkatan'] : $myData['tahun_angkatan'];
	$dataStatus		= isset($_POST['cmbStatus']) ? $_POST['cmbStatus'] : $myData['status'];

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="post" enctype="multipart/form-data" target="_self">
  <table class="table-list" width="100%" border="0" cellpadding="3" cellspacing="1">
    <tr>
      <td colspan="3" bgcolor="#F5F5F5"><b> UBAH DATA SISWA</b></td>
    </tr>
    <tr>
      <td width="284"><b>Kode</b></td>
      <td width="5"><b>:</b></td>
      <td width="920"><input name="textfield" type="text" value="<?php echo $dataKode; ?>" size="10" maxlength="8" readonly="readonly">
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>"></td>
    </tr>
    <tr>
      <td><b>NIS</b></td>
      <td><b>:</b></td>
      <td><input name="txtNis" type="text" value="<?php echo $dataNis; ?>" size="40" maxlength="60"> </td>
    </tr>
    <tr>
      <td><b>Nama Siswa </b></td>
      <td><b>:</b></td>
      <td><input name="txtNama" type="text" value="<?php echo $dataNama; ?>" size="80" maxlength="100"></td>
    </tr>
    <tr>
      <td><b>Jenis Kelamin </b></td>
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
      <td><b>Agama</b></td>
      <td><b>:</b></td>
      <td><select name="cmbAgama">
        <option value="KOSONG">....</option>
        <?php
		   $pilihan = array("Islam","Kristen","Katolik","Hindu","Budha");
          foreach ($pilihan as $agama) {
            if ($dataAgama==$agama) {
                $cek="selected";
            } else { $cek = ""; }
            echo "<option value='$agama' $cek>$agama</option>";
          }
          ?>
      </select></td>
    </tr>
    <tr>
      <td><strong>Tempat, Tgl Lahir </strong></td>
      <td><b>:</b></td>
      <td><input name="txtTempatLahir" type="text" value="<?php echo $dataTempatLahir; ?>" size="40" maxlength="100">
        , <input name="txtTanggal" type="text" class="tcal" value="<?php echo $dataTanggal; ?>" size="20" maxlength="20" /></td>
    </tr>
    <tr>
      <td><b>Alamat Lengkap </b></td>
      <td><b>:</b></td>
      <td><input name="txtAlamat" type="text" value="<?php echo $dataAlamat; ?>" size="80" maxlength="100"></td>
    </tr>
    <tr>
      <td><b>No. Telepon</b></td>
      <td><b>:</b></td>
      <td><input name="txtNoTelepon" type="text" value="<?php echo $dataNoTelepon; ?>" size="30" maxlength="30"></td>
    </tr>
    <tr>
      <td><strong>Foto Siswa </strong></td>
      <td><strong>:</strong></td>
      <td><input name="namaFile" type="file" size="60" />
          <input name="txtNamaFile" type="hidden" value="<?php echo $myData['foto']; ?>" /></td>
    </tr>
    <tr>
      <td><strong>Tahun Angkatan </strong></td>
      <td><b>:</b></td>
      <td><select name="cmbAngkatan">
        <option value="KOSONG">....</option>
        <?php 
		for ($thn = date('Y') - 4; $thn <= date('Y'); $thn++) {
			if($thn==$dataAngkatan) { $cek=" selected";} else { $cek="";}
			echo "<option value='$thn' $cek>$thn</option>";
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td><b>Status Aktif </b></td>
      <td><b>:</b></td>
      <td><select name="cmbStatus">
        <option value="KOSONG">....</option>
        <?php
		   $pilihan = array("Aktif", "Lulus", "Keluar");
          foreach ($pilihan as $status) {
            if ($dataStatus==$status) {
                $cek="selected";
            } else { $cek = ""; }
            echo "<option value='$status' $cek>$status</option>";
          }
          ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnSimpan" type="submit" value=" Simpan "></td>
    </tr>
  </table>
</form>
