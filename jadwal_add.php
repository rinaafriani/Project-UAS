<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	
	$txtNama		= $_POST['nim'];
	$cmbKelamin		= $_POST['kelas'];
	$txtAlamat		= $_POST['pelajaran'];
	$txtNoTelp		= $_POST['id_h'];
	$rbAktif		= $_POST['idkelas'];

	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	
	if(trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Guru</b> tidak boleh kosong, harus diisi !";		
	}
	if(trim($cmbKelamin)=="KOSONG") {
		$pesanError[] = "Data belum dipilih !";		
	}
	if(trim($txtAlamat)=="") {
		$pesanError[] = "Data belum dipilih !";		
	}
	if(trim($txtNoTelp)=="") {
		$pesanError[] = "Data  tidak boleh kosong, harus diisi !";		
	}
	if(trim($rbAktif)=="") {
		$pesanError[] = "Data  tidak boleh kosong, harus diisi !";		
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
		$kodeBaru	= buatKode("jadwal_guru", "J");
		
		// Simpan data dari form ke Database
		$cek=mysql_query("select * from jadwal_guru where id_h='$txtNoTelp' and id_w='$rbAktif' and kelas='$cmbKelamin'");
$jumlah=mysql_num_rows($cek);
if ($jumlah)
{
 echo"<script>alert('Maaf, Jadwal Sudah Ada');window.location.href='./'</script>";
} else {
		$mySql	= "INSERT INTO jadwal_guru
							VALUES ( 
									'','admin','$cmbKelamin', '$txtNama','$_POST[nm]', 
									'$txtAlamat', '$txtNoTelp','$rbAktif')";
											
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			// Setelah data disimpan, Refresh
			echo "<meta http-equiv='refresh' content='0; url=media.php?module=jadwal_data'>";
		}
		exit;
	}	
	}
} // Penutup POST

# MEMBUAT NILAI DATA PADA FORM
$dataKode		= buatKode("jadwal_guru", "J");

$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataKelamin	= isset($_POST['kelas']) ? $_POST['kelas'] : '';
$dataAlamat		= isset($_POST['pelajaran']) ? $_POST['pelajaran'] : '';
$dataNoTelp		= isset($_POST['hari']) ? $_POST['hari'] : '';
$dataAktif		= isset($_POST['jam']) ? $_POST['jam'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="post" target="_self">
  <table class="table-list" width="100%" border="0" cellpadding="3" cellspacing="1" >
    <tr>
      <td colspan="3" bgcolor="#F5F5F5"><b>TAMBAH DATA JADWAL</b></td>
    </tr>
	<tr>
      <td><b> Hari</b></td>
      <td><b>:</b></td>
      <td><?php
	  	$sqlfakultas = mysql_query("select * from hari");
          echo"<form action='media.php?module=view_cari&aksi=tampil' method='POST'>";
		  echo"<input type='hidden' name='id_h' value='$_POST[id_h]'>";
		echo"<select name='id_h' id='select' onchange='this.form.submit()'>";
		echo"<option value='0'></option>";
		while($rfakultas = mysql_fetch_array($sqlfakultas)){
			if($rfakultas['id_h']==$_POST['id_h']){
			echo"<option value='$rfakultas[id_h]' selected>$rfakultas[hari]</option>";
		}else {
			echo"<option value='$rfakultas[id_h]'>$rfakultas[hari]</option>";
			}
		}
		echo"</select></form>";
	  ?>     </td>
    </tr>
	<tr>
      <td><b> Jam</b></td>
      <td><b>:</b></td>
      <td>      <?php
	  	$sqlkelas = mysql_query("select * from waktu_j where id_h='$_POST[id_h]'");
		echo"<select name='idkelas' id='select'>";
		echo"<option value='0'></option>";
		while($rkelas = mysql_fetch_array($sqlkelas)){
			echo"<option value='$rkelas[jamm]'>$rkelas[jamm]</option>";
		}
		echo"</select>";
	  ?>
 </td>
    </tr>
    
    <tr>
      </td>
    </tr>
    <tr>
      <td><b>Nip </b></td>
      <td><b>:</b></td>
<td> <select name="nim" id="nim" onchange="changeValue(this.value)" >
        <option value=0>-Pilih-</option>
        <?php
    $result = mysql_query("select * from guru");   
    $jsArray = "var dtMhs = new Array();\n";       
    while ($row = mysql_fetch_array($result)) {   
        echo '<option value="' . $row['nip'] . '">' . $row['nip'] . '</option>';   
        $jsArray .= "dtMhs['" . $row['nip'] . "'] = {nama:'" . addslashes($row['nama_guru']) . "',jrsn:'".addslashes($row['rujukan'])."'};\n";   
    }     
    ?>   
        </select>         
    </tr>
	<tr>
      <td><b>Nama Guru </b></td>
      <td><b>:</b></td>
<td> <input type='text' data-field="x_username" id="nm" name='nm' class='required' placeholder="Nama Guru">     
    </tr>
    <tr>
      <td><b> Kelas</b></td>
      <td><b>:</b></td>
      <td><select name="kelas" id="kelas" onchange="changeValue(this.value)" >
        <option value=0>-Pilih-</option>
        <?php
    $result = mysql_query("select * from tb_kelas");   
       
    while ($row = mysql_fetch_array($result)) {   
        echo '<option value="' . $row['nama_kelas'] . '">' . $row['nama_kelas'] . '</option>';   
        
    }     
    ?>   
        </select>      </td>
    </tr>
    <tr>
      <td><b> Mata Pelajaran</b></td>
      <td><b>:</b></td>
      <td><select name="pelajaran" id="pelajaran" onchange="changeValue(this.value)" >
        <option value=0>-Pilih-</option>
        <?php
    $result = mysql_query("select * from pelajaran");   
       
    while ($row = mysql_fetch_array($result)) {   
        echo '<option value="' . $row['nama_pelajaran'] . '">' . $row['nama_pelajaran'] . '</option>';   
        
    }     
    ?>   
        </select>      </td>
    </tr>
	
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnSimpan" type="submit" value=" Simpan " class='btn btn-success'></td>
    </tr>
  </table>
</form>
<script type="text/javascript">   
    <?php echo $jsArray; ?> 
    function changeValue(kode_jadwal){ 
    document.getElementById('nm').value = dtMhs[kode_jadwal].nama; 
    document.getElementById('jrsn').value = dtMhs[kode_jadwal].jrsn; 
    }; 
    </script> 