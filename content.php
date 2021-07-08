<?php
if ($_GET[module]=='home'){
 include "home.php";      
}


elseif ($_GET[module]=='jadwal_data'){
	include "jadwal_data.php";
	

	}elseif ($_GET[module]=='lihat_data_guru'){
	include "lihat_data_guru.php";
	}elseif ($_GET[module]=='jadwal_add'){
	include "jadwal_add.php";
	}elseif ($_GET[module]=='jadwal_delete'){
	include "jadwal_delete.php";
	}elseif ($_GET[module]=='jadwal_edit'){
	include "jadwal_edit.php";
	}elseif ($_GET[module]=='jadwal_user'){
	include "jadwal_user.php";
	}elseif ($_GET[module]=='jadwal_guru'){
	include "jadwal_guru.php";
	}elseif ($_GET[module]=='rapor'){
	include "rapor.php";
	
}elseif ($_GET[module]=='nilai_data'){
	include "nilai_data.php";

}elseif ($_GET[module]=='nilai_add'){
	include "nilai_add.php";
	
}elseif ($_GET[module]=='nilai_delete'){

	include "nilai_delete.php";
}elseif ($_GET[module]=='nilai_edit'){
	include "nilai_edit.php";
}
elseif ($_GET[module]=='wal'){
	include "wal.php";
}
elseif ($_GET[module]=='siswa_data'){
	include "siswa_data.php";
}
elseif ($_GET[module]=='siswa_edit1'){
	include "siswa_edit1.php";
}
elseif ($_GET[module]=='siswa_delete1'){
	include "siswa_delete1.php";
}

elseif ($_GET[module]=='siswa_data1'){
	include "siswa_data_guru.php";
}
elseif ($_GET[module]=='laporan_pelajaran'){
	include "laporan_pelajaran.php";
}
elseif ($_GET[module]=='laporan_guru'){
	include "laporan_guru.php";
}
elseif ($_GET[module]=='Siswa-Add'){
	include "siswa_add.php";
}
elseif ($_GET[module]=='siswa_delete'){
	include "siswa_delete.php";
}
elseif ($_GET[module]=='siswa_edit'){
	include "siswa_edit.php";
}
elseif ($_GET[module]=='laporan_kelas'){
	include "laporan_kelas.php";
}
elseif ($_GET[module]=='laporan_pemesanan_sukses'){
	include "lihat_pemesanan.php";
}
elseif ($_GET[module]=='guru_add'){
	include "guru_add.php";
}
elseif ($_GET[module]=='jadwal_kelas'){
	include "laporan_perkelas.php";
}
elseif ($_GET[module]=='laporan_siswa_perkelas'){
	include "laporan_siswa_perkelas.php";
}
elseif ($_GET[module]=='guru_data'){
	include "guru_data.php";
}
elseif ($_GET[module]=='lihat_kelas'){
	include "lihat_kelas.php";
}
elseif ($_GET[module]=='edit_kelas'){
	include "edit_kelas.php";
}
elseif ($_GET[module]=='tambah_kelas'){
	include "tambah_kelas.php";
}
elseif ($_GET[module]=='guru_delete'){
	include "guru_delete.php";
}
elseif ($_GET[module]=='guru_edit'){
	include "guru_edit.php";
}
elseif ($_GET[module]=='kelas_data'){
	include "kelas_data.php";
}
elseif ($_GET[module]=='kelas_delete'){
	include "kelas_delete.php";
}
elseif ($_GET[module]=='kelas_edit'){
	include "kelas_edit.php";
	
}elseif ($_GET[module]=='kelas_add'){
	include "kelas_add.php";


}elseif ($_GET[module]=='pelajaran_add'){
	include "pelajaran_add.php";


}elseif ($_GET[module]=='pelajaran_data'){
	include "pelajaran_data.php";


}elseif ($_GET[module]=='pelajaran_delete'){
	include "pelajaran_delete.php";

}elseif ($_GET[module]=='pelajaran_edit'){
	include "pelajaran_edit.php";


}elseif ($_GET[module]=='wali_kelas'){
	include "wali_kelas.php";

}elseif ($_GET[module]=='laporan_wal'){
	include "laporan_wal.php";
}

elseif ($_GET[module]=='proses_pengiriman'){
	include "proses_pengiriman.php";
}
elseif ($_GET[module]=='konfirmasi_pemesanan'){
	include "edit_biaya.php";
}
elseif ($_GET[module]=='konfirmasi_pemesanan_cus'){
	include "edit_biaya_cus.php";
}
elseif ($_GET[module]=='edit_akun'){
	include "editakun.php";
}
elseif ($_GET[module]=='lihat_pemesanan_sup'){
	include"lihat_pemesanan_sup.php";
}
elseif ($_GET[module]=='lihat_pemesanan_cus'){
	include"lihat_pemesanan_cus.php";
}
elseif ($_GET[module]=='laporan_customer'){
	include "laporan_customer.php";
}

elseif ($_GET[module]=='pemeriksaan_jurnal'){
	include "pemeriksaan_jurnal.php";
}
elseif ($_GET[module]=='edit_user'){
	include "edit_user.php";
}
elseif ($_GET[module]=='edit_jurnal'){
	include "edit_jurnal.php";
}
elseif ($_GET[module]=='periksa_jurnal'){
	include "periksa_jurnal.php";
}

elseif ($_GET[module]=='simpanformulir'){
		$username=trim(htmlentities($_POST[username]));
		$nama_lengkap=trim(htmlentities($_POST[nama_lengkap]));
		$alamat=trim(htmlentities($_POST[alamat]));
	
		
		$querylogin = mysql_query("INSERT INTO pengunjung (nama,jk, level, keperluan, saran, tgl_input) 
								   VALUES ('$_POST[nama]','$_POST[jk]','$_POST[level]','$_POST[perlu]','$_POST[saran]',NOW())");
			echo "<script>window.alert('Data Anda Sukses Tersimpan');
						window.location=('./')</script>";
		
}

elseif ($_GET[module]=='formulir'){
	include "formulir.php";
}
elseif ($_GET[module]=='pencarian_buku'){
	include "pencarian_buku.php";
}
elseif ($_GET[module]=='profil'){
	include "utama.php";
}
elseif ($_GET[module]=='lihat_jurnal'){
	include "lihat_jurnal.php";
}

elseif ($_GET[module]=='tambah_anggota'){
	include "tambah_anggota.php";
}

elseif ($_GET[module]=='tambah_petugas'){
	include "tambah_petugas.php";
}
elseif ($_GET[module]=='tambah_buku'){
	include "tambah_buku.php";
}
elseif ($_GET[module]=='form_peminjaman'){
	include "form_peminjaman.php";
}
elseif ($_GET[module]=='setting'){
	include "setting.php";
}
elseif ($_GET[module]=='editakun'){
	include "editakun.php";
}
elseif ($_GET[module]=='edit_dosen'){
	include "edit_dosen.php";
}
elseif ($_GET[module]=='edit_kepala'){
	include "edit_kepala.php";
}
elseif ($_GET[module]=='lihat_peminjaman_siswa'){
	include "lihat_peminjaman_siswa.php";
}
elseif ($_GET[module]=='registrasi'){
	include "tambah_pegawai.php";
}
elseif ($_GET[module]=='form_login'){
	echo "<div class='alert alert-info'>Silahkan Login.</div><hr>
		<div class='alert alert-alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			<b>Hello!</b> Untuk melakukan Login , Masukkan Username dan Password Anda, Terima Kasih.
		</div>
		<form method=POST name='formku' onSubmit='return valid()' action='cek_login.php' id='registerHere'>
			<div style='position:relative; left:50%; margin-left:-120px; ' class='container-fluid'>
				<div class='row-fluid'>
					<div class='span12'>
						<form>
							<fieldset>
								<div class='control-group'>
									 <label>Username :</label>
									 <input type=text name='id_user' class='required'>
								</div>
									 
									 <div class='control-group'>
									 <label>Level :</label>
									 <select name='level'>
									 <option value=''>Silahkan Dipilih...</option>
									
									
									 <option value='walikelas'>Guru</option>
									 <option value='admin'>Admin</option></select>
								</div>
								<div class='control-group'>
									 <label>Password :</label>
									 <input type=password name='password' class='required'>
								</div>
										 <button type='submit' class='btn btn-primary'>Login</button> 
							</fieldset>
						</form>
					</div>
				</div>
			</div>
			
		</form><br>";
}


elseif ($_GET[module]=='info'){
  include "info.php";
}


elseif ($_GET[module]=='pelajaran'){
  include "pelajaran.php";
}
elseif ($_GET[module]=='penyakit'){
  include "solusi.php";
}

elseif ($_GET[module]=='input_absen'){
	include "input_absensi.php";
}
elseif ($_GET[module]=='peminjaman'){
	include "lihat_peminjaman.php";
}
elseif ($_GET[module]=='anggota'){
	include "beranda.php";
}
elseif ($_GET[module]=='petugas'){
	include "lihat_petugas.php";
}
elseif ($_GET[module]=='proses'){
	include "proses.php";
}
elseif ($_GET[module]=='lihat_user'){
	include "lihat_user.php";
}
elseif ($_GET[module]=='daftar'){
	include "tambah_user.php";
}

elseif ($_GET[module]=='datapendaftaran'){
  echo "<div class='alert alert-info'>Data Hasil Pengambilan Keputusan Online.</div>";
 
  $prosedur=mysql_query("SELECT * FROM rb_hasil_analisa a left join rb_login b on a.username=b.username ORDER BY a.id_hasil DESC");
  $no=1;
  echo "<table style='border:1px solid #c1c1c1;' class='table table-bordered'>
		<tr>
			<th>No</th><th>Nama Lengkap</th><th>Keputusan Jurusan</th><th>Hasil (Nilai)</th>
		</tr>";
  $no=1;

  while($r=mysql_fetch_array($prosedur)){
  $tanggal = tgl_indo($r[tgl_daftar]);
  if(($no % 2)==0){ $warna="#fff"; } else{ $warna="#f4f4f4"; }
	echo "<tr bgcolor='$warna'><td>$no</td>
				 <td>$r[nama_lengkap]</td>
				 <td>$r[jurusan]</td>
				 <td style='color:red'>$r[nilai]</td>
			 </tr>";
	$no++;
  }
  echo "</table>";
}

elseif ($_GET[module]=='kriteria'){
  echo "<div class='alert alert-info'>Data Kriteria Pengambilan Keputusan Online.</div>";
 
  $prosedur=mysql_query("SELECT * FROM rb_kriteria ORDER BY id_kriteria DESC");
  $no=1;

  echo "<a class='btn btn-primary' href='#myModal1' role='button' data-toggle='modal'>Tambah Kriteria</a>
  		<table style='border:1px solid #c1c1c1;' class='table table-bordered'>";

		echo "<tr>
			<th>No</th><th>Nama Kriteria</th><th>Kepentingan</th><th>Action</th>
		</tr>";
  $no=1;

  while($r=mysql_fetch_array($prosedur)){
  $tanggal = tgl_indo($r[tgl_daftar]);
  if(($no % 2)==0){ $warna="#fff"; } else{ $warna="#f4f4f4"; }
	echo "<tr bgcolor='$warna'><td>$no</td>
				 <td>$r[nama_kriteria]</td>
				 <td>$r[kepentingan]</td>
				 <td width=70><a class='btn btn-danger' href='media.php?module=kriteria&aksi=hapus&id=$r[id_kriteria]'>Delete</a></td>
			 </tr>";
	$no++;
  }
  echo "</table>";

  if ($_GET[aksi]=='hapus'){
  		mysql_query("DELETE FROM rb_kriteria where id_kriteria='$_GET[id]'");
  		echo "<script>window.alert('Sukses Hapus Kriteria Terpilih.');
				window.location='kriteria.html'</script>";
  }

  if (isset($_POST[c])){
  		mysql_query("INSERT INTO rb_kriteria (nama_kriteria,kepentingan) VALUES ('$_POST[a]','$_POST[b]')");
  		echo "<script>window.alert('Sukses Tambah Kriteria Baru.');
				window.location='kriteria.html'</script>";
  }
}

elseif ($_GET[module]=='alternatif'){
  echo "<div class='alert alert-info'>Data alternatif Pengambilan Keputusan Online.</div>";
 
  $prosedur=mysql_query("SELECT * FROM rb_alternatif ORDER BY id_alternatif DESC");
  $no=1;
  echo "<a class='btn btn-primary' href='#myModal2' role='button' data-toggle='modal'>Tambah Alternatif</a>
  		<table style='border:1px solid #c1c1c1;' class='table table-bordered'>
		<tr>
			<th>No</th><th>Nama Alternatif</th><th>Deskripsi</th><th>Action</th>
		</tr>";
  $no=1;

  while($r=mysql_fetch_array($prosedur)){
  $tanggal = tgl_indo($r[tgl_daftar]);
  if(($no % 2)==0){ $warna="#fff"; } else{ $warna="#f4f4f4"; }
	echo "<tr bgcolor='$warna'><td>$no</td>
				 <td>$r[nama_alternatif]</td>
				 <td>$r[deskripsi]</td>
				 <td width=70><a class='btn btn-danger' href='media.php?module=alternatif&aksi=hapus&id=$r[id_alternatif]'>Delete</a></td>
			 </tr>";
	$no++;
  }
  echo "</table>";

    if ($_GET[aksi]=='hapus'){
  		mysql_query("DELETE FROM rb_alternatif where id_alternatif='$_GET[id]'");
  		echo "<script>window.alert('Sukses Hapus Alternatif Terpilih.');
				window.location='alternatif.html'</script>";
  }

  if (isset($_POST[c])){
  		mysql_query("INSERT INTO rb_alternatif (nama_alternatif,deskripsi) VALUES ('$_POST[a]','$_POST[b]')");
  		echo "<script>window.alert('Sukses Tambah Alternatif Baru.');
				window.location='alternatif.html'</script>";
  }
}

elseif ($_GET[module]=='hubungikami'){	
  echo "<div class='alert alert-info'>Hubungi kami secara online (Private)</div><br/>
		<form action=hubungi-aksi.html name='formku' onSubmit='return valid()' method=POST id='registerHere'>
			<fieldset>
				<div class='control-group'>
				<label>Nama Lengkap</label>
					<input id='nama_lengkap' name='nama_lengkap' value='$_SESSION[namalengkap]' type='text' style='width:45%;'/> 
				</div>
				<div class='control-group'>
						<label>Alamat E-mail</label>
					<input name='email' type='text' style='width:45%;' id='email'/> 
				</div>
				<div class='control-group'>
					<input name='subjek' type='hidden' value='From_Guest'/> 
						<label>Message</label>
					<textarea style='width:93%; height:120px;' name='pesan' class='required'></textarea>
				</div>										
					<span class='help-block'></span> 
					<button type='submit' class='btn btn-primary'>Submit</button>
			</fieldset>
		</form>";
}

elseif ($_GET[module]=='hubungiaksi'){
$nama_lengkap = trim(htmlentities($_POST[nama_lengkap]));
$email = trim(htmlentities($_POST[email]));
$subjek = trim(htmlentities($_POST[subjek]));
$pesan = trim(htmlentities($_POST[pesan]));
  mysql_query("INSERT INTO rb_hubungi(nama,
                                   email,
                                   subjek,
                                   pesan,
                                   tanggal) 
                        VALUES('$nama_lengkap',
                               '$email',
                               '$subjek',
                               '$pesan',
                               '$tgl_sekarang')");
							   
  echo "<div style='margin-top:5%; text-align:center;' class='alert alert-success'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			Sukses Mengirim Pesan ke Pakar! <br>Terimakasih telah menghubungi kami. Kami akan segera meresponnya
		</div>";
}

elseif ($_GET[module]=='detailberita'){
	  $sql=mysql_query("select * from rb_berita where id_berita=$_GET[id]");
	  while($r=mysql_fetch_array($sql)){
		  $tgl = tgl_indo($r[tanggal]);
		  $isi_berita = nl2br($r[isi_berita]);
	
			echo "<table><tr>
						<span class='sidebar-title'><a href=news-$r[id_berita].html>$r[judul]</a></span>
						 <div class='date'>Diposting pada : $r[hari], $tgl - $r[jam] WIB  </div><hr>";	 
			echo "<p>$isi_berita</p>";
		 }
			echo "</table><br/>";
}
?>