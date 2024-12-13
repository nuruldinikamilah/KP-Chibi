<?php
 session_start();
 include "../../config/koneksi.php";
 include "../../lib/enkripsi_decrpt.php";
 include "../../lib/send_email.php";

 
 if(isset($_POST['submit'])) 
 {
	  $result = mysqli_query($server1,"UPDATE `pengajuan_pengabdian` SET status_pengajuan='".$_POST['status_pengajuan_pilih']."' WHERE `idx_pengabdian` = '".$_POST['idx_pengabdian']."'");

	 if($result)
        {
            //REDIRECT
            header('location:../../view.php?menu=direktur_lppm&act=daftar_pengajuan_validasi_pengabdian&status=sukses');
        }
        else
        {
            //REDIRECT
            header('location:../../view.php?menu=direktur_lppm&actdaftar_pengajuan_validasi_pengabdian&status=gagal&kode='.mysqli_error());
        
        }
 }
 ?>