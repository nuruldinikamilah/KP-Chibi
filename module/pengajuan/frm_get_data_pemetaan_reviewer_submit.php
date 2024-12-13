<?php
 session_start();
 include "../../config/koneksi.php";
 include "../../lib/enkripsi_decrpt.php";
 include "../../lib/send_email.php";


 if(isset($_POST['submit'])) 
 {
	 if (isset($_POST['nip_pilih']))
	 {
		  $result=mysqli_query($server1,"UPDATE `pengajuan_penelitian` SET `nip_reviewer` = '".$_POST['nip_pilih']."' , `nip_pengisi_reviewer` = '".$_SESSION['nik_user'] ."' WHERE `idx_penelitian` = '".$_POST['idx_penelitian']."'");

       if($result)
       {
         //REDIRECT
        header('location:../../view.php?menu=pengajuan&act=daftar_pengajuan&idx='.$_POST['idx'].'&status=sukses&trans=Menambah');
       }
       else
       {
       //REDIRECT
        header('location:../../view.php?menu=pengajuan&act=daftar_pengajuan&status=gagal&kode='.mysqli_error($server1));
       } 
      

	 }

	     
	
 }

 ?>