<?php
include "conn.php";
$edit=mysql_query("SELECT * FROM tb_kelas where kode_kelas='$_GET[id]'");
    $r=mysql_fetch_array($edit);
echo "<h4>Edit Kelas</h4>
	<hr><br>
          <form method=POST action=./aksi.php?module=kelas&act=update>
          <input type=hidden name=id value='$r[kode_kelas]'>
          <table class='table table-bordered table-striped'>
          <tr><td>Kode Kelas</td><td> : <input type=text name='kode' value='$r[kode_kelas]' size=15 ></td></tr>
<tr><td>Nama Kelas </td><td> : <input type=text name='barang' value='$r[nama_kelas]' size=15></td></tr>

<tr><td> Wali Kelas</td><td> : <input type=text name='jml' value='$r[wali_kelas]' size=15 ></td></tr>


		  	  		  
		  
          <tr><td colspan=2><input type=submit value=Edit Kelas class='btn btn-primary'>
                            <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
          </table></form>";
		  ?>