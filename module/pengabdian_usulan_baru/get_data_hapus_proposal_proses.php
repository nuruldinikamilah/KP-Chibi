<?php
    session_start();
    include "../../config/koneksi.php";
    include "../../lib/enkripsi_decrpt.php";
    include "../../lib/send_email.php";

	if (($_POST['idx'])&&($_SESSION['nik_user']!=''))
	{
		$idx = my_simple_crypt($_POST['idx'], 'd' );

		 $kata = "Menghapus Data";
		 $result = mysqli_query($server1,"DELETE FROM `pengajuan_pengabdian` WHERE `idx_pengabdian` = '".$idx."'");

		 $result2 = mysqli_query($server1,"DELETE FROM `pengajuan_dana_pengabdian` WHERE `idx_pengabdian` = '".$idx."'");

		 $result3 = mysqli_query($server1,"DELETE FROM `pengajuan_anggota_pengabdian` WHERE `idx_pengabdian` = '".$idx."'");

		 $result4 = mysqli_query($server1,"DELETE FROM `penilaian_rubik_pengabdian` WHERE `idx_pengabdian` = '".$idx."'");

		 if(($result)&&($result2)&&($result3))
		 {
		 	echo "sukses|".$_POST['idx']."|".$_POST['judul'];
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