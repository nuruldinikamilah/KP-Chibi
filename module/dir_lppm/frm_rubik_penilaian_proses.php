<?php
    session_start();
    include "../../config/koneksi.php";
    include "../../lib/enkripsi_decrpt.php";
    include "../../lib/send_email.php";
	if(isset($_POST['skema_db'])) 
    { 
    	for ($x = 1; $x <= $_POST['jumlah_data']; $x++) 
		{
			//echo $_POST['idx_'.$x];
			//echo $_POST['data_'.$x];
			$result = mysqli_query($server1,"UPDATE `ref_rubik` SET `bobot` = '".$_POST['data_'.$x]."' WHERE `idx_rubik` = '".$_POST['idx_'.$x]."'");

		}

		if($result)
        {
            //REDIRECT
            header('location:../../view.php?menu=direktur_lppm&act=rubik_penilaian&status=sukses_ubah&status=sukses&skema_post='.$_POST['nama_skema']);
        }
        else
        {
            //REDIRECT
            header('location:../../view.php?menu=direktur_lppm&act=rubik_penilaian&status=gagal&kode='.mysqli_error());
        
        }
    }
?>