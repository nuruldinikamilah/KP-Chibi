<?php
    session_start();
    include "../../config/koneksi.php";
    include "../../lib/enkripsi_decrpt.php";
    include "../../lib/send_email.php";

	if (($_POST['idx'])&&($_SESSION['nik_user']!=''))
	{
		$idx = my_simple_crypt($_POST['idx'], 'd' );

		 $kata = "Membatalkan Data";
		 $result = mysqli_query($server1,"UPDATE `pengajuan_pengabdian` SET `validasi_proposal_pengguna` = NULL WHERE `idx_pengabdian` = '".$idx."'");

		 if($result)
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