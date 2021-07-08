<?php
include_once "library/inc.library.php";
include_once "library/inc.connection.php";

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$cmbSemester	= $_POST['cmbSemester'];
	$cmbKelas		= $_POST['cmbKelas'];
	$cmbPelajaran	= $_POST['cmbPelajaran'];
	$cmbGuru		= $_POST['cmbGuru'];
	$cmbSiswa		= $_POST['cmbSiswa'];

	$txtTugas1		= $_POST['txtTugas1'];		
	$txtTugas2		= $_POST['txtTugas2'];		
	$txtNilaiUTS	= $_POST['txtNilaiUTS'];
	$txtNilaiUAS	= $_POST['txtNilaiUAS'];
	$txtKeterangan	= $_POST['txtKeterangan'];

	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($cmbSemester)=="KOSONG") {
		$pesanError[] = "Data <b>Semester</b> tidak boleh kosong !";			
	}
	if (trim($cmbPelajaran)=="KOSONG") {
		$pesanError[] = "Data <b>Nama Pelajaran</b> belum dipilih !";	
	}
	if (trim($cmbGuru)=="KOSONG") {
		$pesanError[] = "Data <b>Guru Pengajar</b> belum dipilih !";	
	}
	if (trim($cmbKelas)=="KOSONG") {
		$pesanError[] = "Data <b>Kelas</b> belum dipilih !";	
	}
	if (trim($cmbSiswa)=="KOSONG") {
		$pesanError[] = "Data <b>Siswa</b> belum dipilih !";	
	}
	if (trim($txtTugas1)=="" or ! is_numeric(trim($txtTugas2))) {
		$pesanError[] = "Data <b>Nilai Tugas 1</b> harus diisi angka  atau 0 !";		
	}
	if (trim($txtTugas2)=="" or ! is_numeric(trim($txtTugas2))) {
		$pesanError[] = "Data <b>Nilai Tugas 2</b> harus diisi angka  atau 0 !";		
	}
	if (trim($txtNilaiUTS)=="" or ! is_numeric(trim($txtNilaiUTS))) {
		$pesanError[] = "Data <b>Nilai UTS</b> harus diisi angka  atau 0 !";		
	}
	if (trim($txtNilaiUAS)=="" or ! is_numeric(trim($txtNilaiUAS))) {
		$pesanError[] = "Data <b>Nilai UAS</b> harus diisi angka  atau 0 !";		
	}
	if (trim($txtKeterangan)=="") {
		$pesanError[] = "Data <b>Keterangan</b> belum diisi !";
	}
			
	# Validasi Nilai, jika sudah ada akan ditolak
	$sqlCek="SELECT * FROM nilai WHERE semester='$cmbSemester' 
									AND kode_pelajaran='$cmbPelajaran' 
									AND kode_kelas='$cmbKelas' 
									AND kode_siswa='$cmbSiswa' ";
	$qryCek=mysql_query($sqlCek, $koneksidb) or die ("Eror Query".mysql_error()); 
	if(mysql_num_rows($qryCek)>=1){
		$pesanError[] = "<b>DATA NILAI UNTUK SISWA TERSEBUT SUDAH DIMASUKAN</b>";
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
		$mySql	= "INSERT INTO nilai (semester, kode_pelajaran, kode_guru, kode_kelas, 
									  kode_siswa, nilai_tugas1, nilai_tugas2, 
									  nilai_uts, nilai_uas, keterangan) 
					VALUES ('$cmbSemester', '$cmbPelajaran', '$cmbGuru', '$cmbKelas', 
							'$cmbSiswa', '$txtTugas1', '$txtTugas2', 
							'$txtNilaiUTS', '$txtNilaiUAS', '$txtKeterangan')";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			// Refresh
			//echo "<meta http-equiv='refresh' content='0; url=?open=Nilai-Add'>";
		}
		//exit;
	}	
} // Penutup POST
	
# Membuat Nilai Data pada Variabel Form
$dataSemester	= isset($_POST['cmbSemester']) ? $_POST['cmbSemester'] : '';
$dataPelajaran	= isset($_POST['cmbPelajaran']) ? $_POST['cmbPelajaran'] : '';
$dataGuru		= isset($_POST['cmbGuru']) ? $_POST['cmbGuru'] : '';
$dataKelas 		= isset($_POST['cmbKelas']) ? $_POST['cmbKelas'] : '';
$dataSiswa 		= isset($_POST['cmbSiswa']) ? $_POST['cmbSiswa'] : '';
$dataTugas1 	= isset($_POST['txtTugas1']) ? $_POST['txtTugas1'] : '';
$dataTugas2 	= isset($_POST['txtTugas2']) ? $_POST['txtTugas2'] : '';
$dataNilaiUTS 	= isset($_POST['txtNilaiUTS']) ? $_POST['txtNilaiUTS'] : '';
$dataNilaiUAS 	= isset($_POST['txtNilaiUAS']) ? $_POST['txtNilaiUAS'] : '';
$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd">
<table width="100%" cellpadding="2" cellspacing="1" class="table-list" style="margin-top:0px;">
	<tr>
	  <td colspan="3" bgcolor="#F5F5F5"><strong><h4>MEMBUAT NILAI HASIL BELAJAR</h4></strong></td>
	</tr>
	<tr>
	  <td width="15%" bgcolor="#CCCCCC"><strong>DATA PELAJARAN </strong></td>
	  <td width="1%">&nbsp;</td>
	  <td width="84%">&nbsp;</td>
    </tr>
	<tr>
      <td><strong>Semester</strong></td>
	  <td><b>:</b></td>
	  <td><select name="cmbSemester">
          <option value="KOSONG">....</option>
          <?php
		  $pilihan	= array("1" => "Ganjil", "2" => "Genap");
          foreach ($pilihan as $isi => $info ) {
            if ($dataSemester==$isi) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$isi' $cek> $isi - $info</option>";
          }
          ?>
      </select></td>
    </tr>
	<tr>
      <td><strong>Pelajaran</strong></td>
	  <td><b>:</b></td>
	  <td><select name="cmbPelajaran">
          <option value="KOSONG">....</option>
          <?php
	  $dataSql = "SELECT * FROM pelajaran ORDER BY kode_pelajaran";
	  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($dataRow = mysql_fetch_array($dataQry)) {
	  	if ($dataRow['kode_pelajaran'] == $dataPelajaran) {
			$cek = " selected";
		} else { $cek=""; }
	  	echo "<option value='$dataRow[kode_pelajaran]' $cek> $dataRow[nama_pelajaran]</option>";
	  }
	  ?>
      </select></td>
    </tr>
	<tr>
      <td><b>Guru Pengajar </b></td>
	  <td><b>:</b></td>
	  <td><select name="cmbGuru">
          <option value="KOSONG">....</option>
          <?php
	  $dataSql = "SELECT * FROM guru ORDER BY kode_guru";
	  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($dataRow = mysql_fetch_array($dataQry)) {
	  	if ($dataRow['kode_guru'] == $dataGuru) {
			$cek = " selected";
		} else { $cek=""; }
	  	echo "<option value='$dataRow[kode_guru]' $cek> $dataRow[nama_guru]</option>";
	  }
	  ?>
      </select></td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td bgcolor="#CCCCCC"><strong>DATA  SISWA </strong></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
      <td><b>Pilih Kelas </b></td>
	  <td><b>:</b></td>
	  <td><select name="cmbKelas">
          <option value="KOSONG">....</option>
          <?php
	  $dataSql = "SELECT * FROM kelas ORDER BY tahun_ajar";
	  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($dataRow = mysql_fetch_array($dataQry)) {
		if ($dataRow['kode_kelas'] == $dataKelas) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$dataRow[kode_kelas]' $cek>$dataRow[kelas] | $dataRow[nama_kelas] ( $dataRow[tahun_ajar] )</option>";
	  }
	  ?>
        </select>
          <input name="btnPilih" type="submit" value=" Pilih " /></td>
    </tr>
	<tr>
      <td><b>Pilih Siswa </b></td>
	  <td><b>:</b></td>
	  <td><select name="cmbSiswa">
          <option value="KOSONG">....</option>
          <?php
	  $dataSql = "SELECT siswa.* FROM siswa, kelas_siswa 
	  			  WHERE siswa.kode_siswa = kelas_siswa.kode_siswa AND kelas_siswa.kode_kelas='$dataKelas'
				  ORDER BY nama_siswa";
	  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($dataRow = mysql_fetch_array($dataQry)) {
	  	if ($dataRow['kode_siswa'] == $dataSiswa) {
			$cek = " selected";
		} else { $cek=""; }
	  	echo "<option value='$dataRow[kode_siswa]' $cek>$dataRow[nis] - $dataRow[nama_siswa]</option>";
	  }
	  ?>
      </select></td>
    </tr>
	<tr>
      <td bgcolor="#CCCCCC"><strong>INPUT NILAI </strong></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td><strong>Nilai Tugas 1 </strong></td>
	  <td><b>:</b></td>
	  <td><input name="txtTugas1" type="text" value="<?php echo $dataTugas1; ?>" size="10" maxlength="5" /></td>
    </tr>
	<tr>
	  <td><strong>Nilai Tugas 2 </strong></td>
	  <td><b>:</b></td>
	  <td><input name="txtTugas2" type="text" value="<?php echo $dataTugas2; ?>" size="10" maxlength="5" /></td>
    </tr>
	<tr>
	  <td><strong>Nilai UTS (MID) </strong></td>
	  <td><b>:</b></td>
	  <td><input name="txtNilaiUTS" type="text" value="<?php echo $dataNilaiUTS; ?>" size="10" maxlength="5" /></td>
    </tr>
	<tr>
	  <td><strong>Nilai UAS </strong></td>
	  <td><b>:</b></td>
	  <td><input name="txtNilaiUAS" type="text" value="<?php echo $dataNilaiUAS; ?>" size="10" maxlength="5" /></td>
    </tr>
	<tr>
	  <td><strong>Keterangan</strong></td>
	  <td><b>:</b></td>
	  <td><input name="txtKeterangan" type="text" value="<?php echo $dataKeterangan; ?>" size="70" maxlength="100" /></td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN NILAI " style="cursor:pointer;" /></td>
    </tr>
</table>
</form>
