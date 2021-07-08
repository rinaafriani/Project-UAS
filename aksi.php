<?php
session_start();
include "conn.php";
//include "../fungsi/library.php";

$module=$_GET[module];
$act=$_GET[act];


// Menghapus data
if (isset($page) AND $act=='hapus'){
  mysql_query("DELETE FROM ".$page." WHERE id_".$page."='$_GET[id]'");
  header('location:media.php?page='.$page);
}
// Menghapus data
if (isset($page) AND $act=='hapus'){
  mysql_query("DELETE FROM contact WHERE id_contact='$_GET[id]'");
  header('location:media.php?page='.$page);
}


// Input user
elseif ($page=='akun' AND $act=='input'){
  $pass=md5($_POST[password]);
  if(empty($_POST[username])){
  header('location:media.php?page='.$page);
  }else{
  mysql_query("INSERT INTO admin(username,
                                password,
                                nama_lengkap,
                                email,
								no_telp) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
                                '$_POST[no_telp]')");
  header('location:media.php?page='.$page);
}
}

// Update user
elseif ($page=='akun' AND $act=='update'){
  // Apabila password tidak diubah
  if (empty($_POST[password])) {
    mysql_query("UPDATE admin set username='$_POST[username]',
                                  nama_lengkap='$_POST[nama_lengkap]',
                                  email='$_POST[email]',
								  no_telp='$_POST[no_telp]' WHERE id = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST[password]);
    mysql_query("UPDATE admin set username='$_POST[username]',
                                  password='$pass',
                                  nama_lengkap='$_POST[nama_lengkap]',
                                  email='$_POST[email]',
								  no_telp='$_POST[no_telp]' WHERE id = '$_POST[id]'");
  }
  header('location:media.php?page='.$page);
}
if ($page=='akun' AND $_GET[act]=='delete'){
  // Apabila password tidak diubah
  if (empty($_POST[password])) {
    mysql_query("delete from admin WHERE id     = '$_GET[id]'");
  }
 header('location:media.php?page='.$page);
}


// Input modul
elseif ($page=='modul' AND $act=='input'){
  mysql_query("INSERT INTO modul(nama_modul,
                                 link,
                                 publish,
                                 aktif,
                                 status,
                                 urutan) 
	                       VALUES('$_POST[nama_modul]',
                                '$_POST[link]',
                                '$_POST[publish]',
                                '$_POST[aktif]',
                                '$_POST[status]',
                                '$_POST[urutan]')");
  header('location:media.php?page='.$page);
}

// Update modul
elseif ($page=='modul' AND $act=='update'){
  mysql_query("UPDATE modul SET nama_modul = '$_POST[nama_modul]',
                                link       = '$_POST[link]',
                                publish    = '$_POST[publish]',
                                aktif      = '$_POST[aktif]',
                                status     = '$_POST[status]',
                                urutan     = '$_POST[urutan]'  
                          WHERE id_modul   = '$_POST[id]'");
  header('location:media.php?page='.$page);
}


// Input agenda
elseif ($page=='agenda' AND $act=='input'){
  $mulai=sprintf("%02d%02d%02d",$_POST[thn_mulai],$_POST[bln_mulai],$_POST[tgl_mulai]);
  $selesai=sprintf("%02d%02d%02d",$_POST[thn_selesai],$_POST[bln_selesai],$_POST[tgl_selesai]);
  
  mysql_query("INSERT INTO agenda(tema,
                                  isi_agenda,
                                  tempat,
                                  tgl_mulai,
                                  tgl_selesai,
                                  tgl_posting,
                                  id_user) 
					                VALUES('$_POST[tema]',
                                 '$_POST[isi_agenda]',
                                 '$_POST[tempat]',
                                 '$mulai',
                                 '$selesai',
                                 '$tgl_sekarang',
                                 '$_SESSION[namauser]')");
  header('location:media.php?page='.$page);
}

// Update agenda
elseif ($page=='agenda' AND $act=='update'){
  $mulai=sprintf("%02d%02d%02d",$_POST[thn_mulai],$_POST[bln_mulai],$_POST[tgl_mulai]);
  $selesai=sprintf("%02d%02d%02d",$_POST[thn_selesai],$_POST[bln_selesai],$_POST[tgl_selesai]);

  mysql_query("UPDATE agenda SET tema        = '$_POST[tema]',
                                 isi_agenda  = '$_POST[isi_agenda]',
                                 tgl_mulai   = '$mulai',
                                 tgl_selesai = '$selesai',
                                 tempat      = '$_POST[tempat]'  
                           WHERE id_agenda   = '$_POST[id]'");
  header('location:media.php?page='.$page);
}


// Input pengumuman
elseif ($page=='pengumuman' AND $act=='input'){
  $tanggal=sprintf("%02d%02d%02d",$_POST[thn],$_POST[bln],$_POST[tgl]);
  
  mysql_query("INSERT INTO pengumuman(judul,
                                      isi,
                                      tanggal,
                                      tgl_posting,
                                      id_user) 
					                   VALUES('$_POST[judul]',
                                    '$_POST[isi_pengumuman]',
                                    '$tanggal',
                                    '$tgl_sekarang',
                                    '$_SESSION[namauser]')");
  header('location:media.php?page='.$page);
}

// Update pengumuman
elseif ($page=='pengumuman' AND $act=='update'){
  $tanggal=sprintf("%02d%02d%02d",$_POST[thn],$_POST[bln],$_POST[tgl]);

  mysql_query("UPDATE pengumuman SET judul         = '$_POST[judul]',
                                     isi           = '$_POST[isi_pengumuman]',
                                     tanggal       = '$tanggal'
                               WHERE id_pengumuman = '$_POST[id]'");
  header('location:media.php?page='.$page);
}


// Input berita
elseif ($page=='berita' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    // Apabila tipe gambar bukan jpeg akan tampil peringatan
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
      echo "Gagal menyimpan data !!! <br>
            Tipe file <b>$nama_file</b> : $tipe_file <br>
            Tipe file yang diperbolehkan adalah : <b>JPG/JPEG</b>.<br>";
      	echo "<a href=javascript:history.go(-1)>Ulangi Lagi</a>";	 		  
    }
    else{
      move_uploaded_file($lokasi_file,"foto_berita/$nama_file_unik");
      mysql_query("INSERT INTO berita(judul,
                                      id_kategori,
                                      isi_berita,
                                      id_user,
                                      jam,
                                      tanggal,
                                      hari,
                                      gambar) 
                              VALUES('$_POST[judul]',
                                     '$_POST[kategori]',
                                     '$_POST[isi_berita]',
                                     '$_SESSION[namauser]',
                                     '$jam_sekarang',
                                     '$tgl_sekarang',
                                     '$hari_ini',
                                     '$nama_file_unik')");
     header('location:media.php?page='.$page);
   }
   }
   else{
     mysql_query("INSERT INTO berita(judul,
                                     id_kategori,
                                     isi_berita,
                                     id_user,
                                     jam,
                                     tanggal,
                                     hari) 
                             VALUES('$_POST[judul]',
                                    '$_POST[kategori]',
                                    '$_POST[isi_berita]',
                                    '$_SESSION[namauser]',
                                    '$jam_sekarang',
                                    '$tgl_sekarang',
                                    '$hari_ini')");
    header('location:media.php?page='.$page);
  }
}

// Update berita
elseif ($page=='berita' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE berita SET judul       = '$_POST[judul]',
                                   id_kategori = '$_POST[kategori]',
                                   isi_berita  = '$_POST[isi_berita]'  
                             WHERE id_berita   = '$_POST[id]'");
  }
  else{
    move_uploaded_file($lokasi_file,"foto_berita/$nama_file");
    mysql_query("UPDATE berita SET judul       = '$_POST[judul]',
                                   id_kategori = '$_POST[kategori]',
                                   isi_berita  = '$_POST[isi_berita]',
                                   gambar      = '$nama_file'   
                             WHERE id_berita   = '$_POST[id]'");
  }
  header('location:media.php?page='.$page);
}


// Input soal
elseif ($page=='lowongan' AND $act=='input'){
    mysql_query("INSERT INTO lowongan(id_perusahaan,lowongan,tgl_lowongan,user_posting) 
                            VALUES('$_POST[perusahaan]',
								   '$_POST[lowongan]',
                                   '$tgl_sekarang',
                                   '$_POST[username]')");
  
  header('location:media.php?page='.$page);
}

// Update lowongan
elseif ($page=='lowongan' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE lowongan SET judul     = '$_POST[judul]',
                                   url       = '$_POST[link]'
                             WHERE id_lowongan = '$_POST[id]'");
  }
  else{
    move_uploaded_file($lokasi_file,"foto_berita/$nama_file");
    mysql_query("UPDATE lowongan SET judul     = '$_POST[judul]',
                                   url       = '$_POST[link]',
                                   gambar    = '$nama_file'   
                             WHERE id_lowongan = '$_POST[id]'");
  }
  header('location:media.php?page='.$page);
}

// Update profil
elseif ($page=='profil' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE modul SET static_content = '$_POST[isi]'
                            WHERE id_modul       = '$_POST[id]'");
  }
  else{
    move_uploaded_file($lokasi_file,"foto_berita/$nama_file");
    mysql_query("UPDATE modul SET static_content = '$_POST[isi]',
                                  gambar         = '$nama_file'    
                            WHERE id_modul       = '$_POST[id]'");
  }
  header('location:media.php?page='.$page);
}



elseif ($module=='biaya' AND $act=='update'){
  
  
    mysql_query("UPDATE pemesanan set status='Sudah Terkonfirmasi',biaya='$_POST[biaya]' WHERE id_pemesanan = '$_POST[id]'");
  
 
 
 echo"<script>alert('Konfirmasi Pemesanan Sukses');window.location.href='media.php?module=lihat_pemesanan_sup'</script>";
}
elseif ($module=='biaya_cus' AND $act=='update'){
  
  
    mysql_query("UPDATE pemesanan set status='$_POST[keputusan]' WHERE id_pemesanan = '$_POST[id]'");
  
 
 
 echo"<script>alert('Konfirmasi Pemesanan Sukses');window.location.href='media.php?module=home'</script>";
}
elseif ($module=='proses' AND $act=='update'){
  
  
    mysql_query("UPDATE pemesanan set pengiriman='Sudah diKirim' WHERE id_pemesanan = '$_POST[id]'");
  
 $kl=mysql_query("insert into pengiriman(kode_pengiriman,kode_pemesanan,barang,jml,nama,perusahaan,tujuan,pengiriman)
 value('$_POST[kode_p]','$_POST[kode]','$_POST[barang]','$_POST[jml]','$_POST[nama]','$_POST[perusahaan]','$_POST[tujuan]','Sudah diKirim')");

 
 echo"<script>alert('Proses Berhasil');window.location.href='media.php?module=home'</script>";
}

elseif ($module=='perpanjang' AND $act=='update'){
  // Apabila password tidak diubah
  
    mysql_query("UPDATE trans_pinjam set 
                                 
								  tgl_pinjam='$_POST[tgl_pinjam]',
								  tgl_kembali='$_POST[tgl_kembali]'
								   WHERE id_trans = '$_POST[id]'");
  
  // Apabila password diubah
 
   echo"<script>alert('Data Anda Sukses Tersimpan');window.location.href='media.php?module=peminjaman'</script>";
}

elseif ($module=='buku' AND $act=='update'){
  // Apabila password tidak diubah
  
    mysql_query("UPDATE data_buku set 
                                 
								  judul='$_POST[judul]',
								  pengarang='$_POST[pengarang]',
								   penerbit='$_POST[penerbit]',
								    lokasi='$_POST[lokasi]',
									 jumlah_buku='$_POST[jumlah]'
								   WHERE id = '$_POST[id]'");
  
  // Apabila password diubah
 
   echo"<script>alert('Data Anda Sukses Tersimpan');window.location.href='media.php?module=buku'</script>";
}

elseif ($module=='anggota' AND $act=='update'){
  // Apabila password tidak diubah
  
    mysql_query("UPDATE anggota set 
                                 
								  induk='$_POST[judul]',
								  nama_lengkap='$_POST[pengarang]',
								   jenis_kelamin='$_POST[penerbit]',
								    email='$_POST[lokasi]',
									 nohp='$_POST[jumlah]',
									 status='$_POST[jenis]'
								   WHERE id_anggota = '$_POST[id]'");
  
  // Apabila password diubah
 
   echo"<script>alert('Data Anda Sukses Tersimpan');window.location.href='media.php?module=anggota'</script>";
}
elseif ($module=='buku' AND $act=='cari'){
  // Apabila password tidak diubah
  
    mysql_query("UPDATE trans_pinjam set 
                                  kode='$_POST[kode]',
								  judul_buku='$_POST[judul]',
								  pengarang='$_POST[pengarang]'
								  
								    
								   WHERE id_trans = '$_POST[id]'");
  
  // Apabila password diubah
 
   echo"<script>alert('Data Anda Sukses as Tersimpan');window.location.href='media.php?module=buku'</script>";
}


elseif ($module=='user' AND $act=='update'){
  // Apabila password tidak diubah
  
    mysql_query("UPDATE rb_login set 
                                 
								  username='$_POST[user]',
								  password='$_POST[pass]',
								   nama_lengkap='$_POST[nama]',
								    
									 email='$_POST[email]',
									 nohp='$_POST[nohp]',
									 alamat='$_POST[alamat]'
								   WHERE username = '$_POST[id]'");
  
  // Apabila password diubah
 
   echo"<script>alert('Data Anda Sukses Tersimpan');window.location.href='media.php?module=lihat_user'</script>";
}

elseif ($module=='revisi' AND $act=='update'){
  // Apabila password tidak diubah
  $judul = $_POST['judul'];
		
		$nama_file=$_FILES['gambar']['name'];
		$path=$_FILES['gambar']['tmp_name'];
		$destination="./files/$nama_file";
		move_uploaded_file($path,$destination);
    mysql_query("UPDATE download set 
                                 
								  judul='$_POST[judul]',isi='$nama_file'
								  
								   WHERE id_download = '$_POST[id]'");
  
  // Apabila password diubah
 
   echo"<script>alert('Data Anda Sukses Tersimpan');window.location.href='media.php?module=lihat_jurnal'</script>";
}
elseif ($module=='visi' AND $act=='update'){
  // Apabila password tidak diubah
  
    mysql_query("UPDATE rb_halaman set 
                                 
								  judul='$_POST[judul]',detail='$_POST[detail]'
								 
								  
								   WHERE halaman = '$_POST[id]'");

  
  // Apabila password diubah
 
   echo"<script>alert('Data Sukses di Update');window.location.href='media.php?module=edit_visi'</script>";
}
elseif ($module=='setting' AND $act=='update'){
  // Apabila password tidak diubah
  
    mysql_query("UPDATE rb_login set 
                                 
								  username='$_POST[jangka]',password='$_POST[denda]'
								 
								  
								   WHERE username = '$_POST[id]'");

  
  // Apabila password diubah
 
   echo"<script>alert('Data Sukses di Update');window.location.href='media.php?module=edit_akun'</script>";
}
elseif ($module=='tunjangan' AND $act=='update'){
  // Apabila password tidak diubah
  
    mysql_query("UPDATE tunjangan set 
                                 
								  nip='$_POST[nip]',nama='$_POST[nama]'
								  ,jabatan='$_POST[jabatan]'
								  ,tnj='$_POST[tunjangan]'
								 
								  
								   WHERE id_tunjangan = '$_POST[id]'");

  
  // Apabila password diubah
 
   echo"<script>alert('Data Sukses di Update');window.location.href='media.php?module=lihat_tunjangan'</script>";
}
elseif ($module=='pegawai' AND $act=='update'){
  // Apabila password tidak diubah
  
    mysql_query("UPDATE rb_login set 
                                 
								  nidn='$_POST[nip]',
								  nama_lengkap='$_POST[nama]',
								   
								    email='$_POST[email]',
									 nohp='$_POST[nohp]',
									 alamat='$_POST[alamat]'
								 
								  
								   WHERE username = '$_POST[id]'");

  
  // Apabila password diubah
 
   echo"<script>alert('Data Berhasil Di Update');window.location.href='media.php?module=lihat_dosen'</script>";
}
elseif ($module=='kepala' AND $act=='update'){
  // Apabila password tidak diubah
  
    mysql_query("UPDATE rb_login set 
                                 
								  nidn='$_POST[nip]',
								  nama_lengkap='$_POST[nama]',
								   
								    email='$_POST[email]',
									 nohp='$_POST[nohp]',
									 alamat='$_POST[alamat]'
								 
								  
								   WHERE username = '$_POST[id]'");

  
  // Apabila password diubah
 
   echo"<script>alert('Data Berhasil Di Update');window.location.href='media.php?module=lihat_kepala'</script>";
}
elseif ($module=='jurnal' AND $act=='update'){
  // Apabila password tidak diubah
  
    mysql_query("UPDATE download set 
                                 
								  status='$_POST[status]',
								  catatan='$_POST[catatan]',
								  tgl_periksa=NOW()
								   
								    
								 
								  
								   WHERE id_download= '$_POST[id]'");

  
  // Apabila password diubah
 
   echo"<script>alert('Pemeriksaan Sukses');window.location.href='media.php?module=pemeriksaan_jurnal'</script>";
}

?>

