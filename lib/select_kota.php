<?php
if (!empty($_GET['q'])){
	if (ctype_digit($_GET['q'])) {
		include '../config/koneksi.php';
		
		$query = mysql_query("SELECT * FROM lokasi_kecamatan where id_kab_kot=$_GET[q] order by nama_kecamatan asc");
			echo"<option selected value=''>Pilih Kecamatan</option>";
			while($d = mysql_fetch_array($query)){
				echo "<option value='$d[id_kecamatan]'>$d[nama_kecamatan]</option>";
			}

	}
}

else
{
		include '../config/koneksi.php';
			$query = mysql_query("SELECT * FROM lokasi_desa where id_kecamatan=$_GET[kec] order by nama_desa asc");
			echo"<option selected value=''>Pilih Kelurahan/Desa</option>";
			while($d = mysql_fetch_array($query)){
				echo "<option value='$d[id_desa]'>$d[nama_desa]</option>";
			}		
}
?>
