<?php
    session_start();
    include "../../config/koneksi.php";
    include "../../lib/enkripsi_decrpt.php";
    include "../../lib/send_email.php";

	if (($_POST['idx'])&&($_SESSION['nik_user']!=''))
	{
		$idx = my_simple_crypt($_POST['idx'], 'd' );

		 $kata = "Menghapus Data";
		 $result = mysqli_query($server1,"DELETE FROM `pengajuan_penelitian` WHERE `idx_penelitian` = '".$idx."'");

		 $result2 = mysqli_query($server1,"DELETE FROM `pengajuan_dana_penelitian` WHERE `idx_penelitian` = '".$idx."'");

		 $result3 = mysqli_query($server1,"DELETE FROM `pengajuan_anggota_penelitian` WHERE `idx_penelitian` = '".$idx."'");

		 $result4 = mysqli_query($server1,"DELETE FROM `penilaian_rubik` WHERE `idx_penelitian` = '".$idx."'");

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