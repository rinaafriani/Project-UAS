<?php
include "conn.php";
$edit=mysql_query("SELECT * FROM rb_halaman ");
    $r=mysql_fetch_array($edit);
echo "<h4>Edit Data</h4>
	<hr><br>
          <form method=POST action=./aksi.php?module=visi&act=update>
          <input type=hidden name=id value='$r[halaman]'>
          <table class='table table-bordered table-striped'>
          <tr><td>Judul </td><td> : <input type=text name='judul' value='$r[judul]' size=15 ></td></tr>
		  <tr><td>Detail </td><td> : <textarea name='detail' rows='15' class='form-control' >$r[detail]</textarea></td></tr>

		  	  		  
		  
          <tr><td colspan=2><input type=submit value=Update class='btn btn-primary'>
                            <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
          </table></form>";
		  ?>