<?php
include "conn.php";

$KodeCust = $_REQUEST['id'];
$queryPelanggan = mysql_query("select * from pengiriman where id_pengiriman = '$KodeCust'");
$tampilPelanggan = mysql_fetch_array($queryPelanggan);
//buat kode otomatis
	$query_oto = mysql_query("select max(kode_pengiriman) as maksi from pengiriman");
	$data_oto = mysql_fetch_array($query_oto);
	$data_potong = substr($data_oto['maksi'],3,5);
	$data_potong++;
	$kode="";
	for ($i=strlen($data_potong); $i<=2; $i++)
		$kode = $kode."0";
	   $data['kode_pengiriman'] = "K$kode$data_potong";
?>
<?php 
$edit=mysql_query("SELECT * FROM pemesanan where id_pemesanan='$_GET[id]'");
    $r=mysql_fetch_array($edit);
echo "<h4>Proses Pengiriman</h4>
	<hr><br>
          <form method=POST action=./aksi.php?module=proses&act=update>
          <input type=hidden name=id value='$r[id_pemesanan]'>
          <table class='table table-bordered table-striped'>
		   <tr><td>Kode Pengiriman</td><td> : <input type=text name='kode_p' value='$data[kode_pengiriman]' size=15 readonly></td></tr>
          <tr><td>Kode Pemesanan</td><td> : <input type=text name='kode' value='$r[kode_pemesanan]' size=15 readonly></td></tr>
<tr><td>Nama Barang </td><td> : <input type=text name='barang' value='$r[barang]' size=15 readonly></td></tr>

<tr><td>  Jumlah</td><td> : <input type=text name='jml' value='$r[jml]' size=15 readonly></td></tr>
<tr><td> Nama Pemesanan </td><td> : <input type=text name='nama' value='$r[nama]' size=15 readonly></td></tr>
<tr><td>  Nama Perusahaan</td><td> : <input type=text name='perusahaan' value='$r[perusahaan]' size=15 readonly></td></tr>

<tr><td>  Keterangan</td><td> : <textarea name='keterangan' cols='' rows='' readonly>$r[keterangan]</textarea></td></tr>
<tr><td>  Biaya</td><td> : <input type=text name='biaya' value='$r[biaya]' size=15 readonly></td></tr>
<tr><td>  Tujuan</td><td> : <input type=text name='tujuan' value='$r[alamat_perusahaan]' size=15 readonly></td></tr>
<tr><td>  Pengiriman</td><td> : <input type=text name='pengiriman' value='$r[pengiriman]' size=15 readonly></td></tr>

		  	  		  
		  
          <tr><td colspan=2><input type=submit value=Proses class='btn btn-primary'>
                            <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
          </table></form>";
		  ?>