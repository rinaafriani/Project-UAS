

<h3><span class="glyphicon glyphicon-book"></span>  Laporan Jadwal Pelajaran</h3>
 
						<form name="f1" method=post action="cetakperhari.php" target="_blank">
						<table class='table table-bordered table-striped' >
						 <tr>
      <td><b> Kelas</b></td>
      <td><b>:</b></td>
      <td><select name="bulan" id="bulan" onchange="changeValue(this.value)" >
        <option value=0>-Pilih-</option>
        <?php
    $result = mysql_query("select * from tb_kelas");   
       
    while ($row = mysql_fetch_array($result)) {   
        echo '<option value="' . $row['nama_kelas'] . '"> ' . $row['nama_kelas'] . '</option>';   
        
    }     
    ?>   
        </select>      </td>
    </tr></table>
<br>
<input type="submit" name="simpan" value="Print" class="btn btn-success">
</form>
						
	<br><br><br><br>