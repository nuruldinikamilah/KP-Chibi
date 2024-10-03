<?php
 session_start();
 include "../../config/koneksi.php";
 include "../../lib/enkripsi_decrpt.php";
 include "../../lib/send_email.php";


 if(isset($_POST['submit'])) 
 {
	 if (isset($_POST['nip_pilih']))
	 {
		  $result=mysqli_query($server1,"UPDATE `pengajuan_pengabdian` SET `nip_reviewer` = '".$_POST['nip_pilih']."' , `nip_pengisi_reviewer` = '".$_SESSION['nik_user'] ."', `status_pengajuan` = 'diperiksa' WHERE `idx_pengabdian` = '".$_POST['idx_pengabdian']."'");

       if($result)
       {
         //REDIRECT
        header('location:../../view.php?menu=pengajuan&act=daftar_pengajuan_pengabdian&idx='.$_POST['idx_pengabdian'].'&status=sukses&trans=Menambah');
       }
       else
       {
       //REDIRECT
        header('location:../../view.php?menu=pengajuan&act=daftar_pengajuan_pengabdian&status=gagal&kode='.mysqli_error($server1));
       } 
      

	 }

	     
	
 }

 ?>