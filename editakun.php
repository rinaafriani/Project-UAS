<style type="text/css">
<!--
.style1 {font-size: 18px}
-->
</style>
<?php

$edit=mysql_query("SELECT * FROM rb_login where nama_lengkap='$_SESSION[namalengkap]' ");
    $r=mysql_fetch_array($edit);

?>
<form name="form1" method="post" >
<input type="hidden" name="id" value="<?php echo "$r[username]";?>">
  <table width="521" class='table table-bordered table-striped'>
    <tr>
      <td colspan="2"><div align="center" class="style1">Edit Akun</div>        <div align="center"></div></td>
    </tr>
    <tr>
      <td width="123">Username</td>
      
        <td width="386"> : <input type="text" name="jangka" value="<?php echo "$r[username]";?>" size="15"></td>
      </tr>
    <tr>
      <td>Password </td>
      <td>
        : <input type="password" name="denda" value="<?php echo "$r[password]";?>" size="15"></tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="btnSimpan" id="btnSimpan" class="btn btn-info" value="Simpan">
      </label></td>
    </tr>
  </table>

<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtNIP			= $_POST['jangka'];
	$txtNama		= $_POST['denda'];


	

		// SQL Simpan data ke tabel database
		$mySql	= "UPDATE rb_login SET 
						username='$txtNIP',
						password 	='$txtNama'
						
				  WHERE nama_lengkap='$_SESSION[namalengkap]' ";		
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			// Setelah data disimpan, Refresh
			echo "<meta http-equiv='refresh' content='0; url=media.php?module=edit_akun'>";
		}
		exit;
	}	

