<?php
    session_start();
    include "../../config/koneksi.php";
    include "../../lib/enkripsi_decrpt.php";
    include "../../lib/send_email.php";

	if (($_POST['idx'])&&($_SESSION['nik_user']!=''))
	{
		$idx = my_simple_crypt($_POST['idx'], 'd' );

		 $kata = "Menghapus Data";
		 $result = mysqli_query($server1,"DELETE FROM `pengajuan_anggota_pengabdian` WHERE `idx_anggota_pengabdian` = '".$idx."'");

		 if($result)
		 {
		 	echo "sukses|".$_POST['idx']."|".$_POST['judul']."|".$_POST['ket'];
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