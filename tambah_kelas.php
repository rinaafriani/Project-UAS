<?php
include "conn.php" ;
?>

<form class='form-horizontal' action='input_kelas.php' method='POST' >
	  <fieldset>
		<div class='alert alert-alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			Silahkan Mengisi Data pada Form di bawah ini dengan baik dan benar.
		</div><br/>
		 <div class='control-group'>
	      <label class='control-label' for='input01'>Kode Kelas </label>
	      <div class='controls'>
	        <input type='text' data-field="x_username" id="x_username" name='kode' class='required' placeholder="Kode Kelas" >      
	      </div>
	</div>
	    <div class='control-group'>
	      <label class='control-label' for='input01'>Nama Kelas </label>
	      <div class='controls'>
	        <input type='text' data-field="x_username" id="x_username" name='barang' class='required' placeholder="Nama Kelas">      
	      </div>
	</div>
	
	 <div class='control-group'>
		<label class='control-label' for='input01'>Wali Kelas</label>
		<div class='controls'>
	       <select name="nm" id="nm"  >
        <option value=0>-Pilih-</option>
        <?php
    $result = mysql_query("select * from guru");   
       
    while ($row = mysql_fetch_array($result)) {   
        echo '<option value="' . $row['nama_guru'] . '">' . $row['nama_guru'] . '</option>';   
        
    }     
    ?>   
        </select>    
	        <br /> <span id='error1'></span>            
       </div>
	</div>
	
	
	
	 
	 
	
	
	<div class='control-group'>
		<label class='control-label' for='input01'></label>
	      <div class='controls'>
	       <button type='submit' class='btn btn-success' rel='tooltip' title='first tooltip'>Simpan</button>
	       
	      </div>
	
	</div> 
</fieldset>
	</form>