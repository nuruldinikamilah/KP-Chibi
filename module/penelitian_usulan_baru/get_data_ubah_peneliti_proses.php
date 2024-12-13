<?php
	session_start();
    include "../../config/koneksi.php";
    include "../../lib/enkripsi_decrpt.php";
    include "../../lib/send_email.php";

	if (($_POST['idx'])&&($_SESSION['nik_user']!=''))
	{
		$idx = my_simple_crypt($_POST['idx'], 'd' );

		$kata = "Mengubah Data";
		$result = mysqli_query($server1,"UPDATE `pengajuan_anggota_penelitian` SET `nip_anggota` = '".$_POST['nip_ubah']."' , `nama_peneliti` = '".$_POST['nama_ubah']."' , `status_peneliti` = '".$_POST['status_peneliti']."' , `keterangan` = '".$_POST['keterangan_anggota_ubah']."' , `tgl_update` = now() WHERE `idx_anggota_peneliti` = '".$idx."';");

		if($result)
		 {
		 	//echo "sukses|".$_POST['idx']."|".$_POST['judul']."|".$_POST['nominal'];
		 	echo "sukses|".$_POST['judul']."|".$_POST['sesi'];
		 }
		 else
		 {
               echo "error|".mysqli_error();
		 }  
	}
	else
	{
		echo "error|".mysqli_error();
	}

	
?>