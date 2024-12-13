<?php
    session_start();
    include "../../config/koneksi.php";
    include "../../lib/enkripsi_decrpt.php";
    include "../../lib/send_email.php";

    if ($_SESSION['nik_user']=='')
    {
            header('location:../../index.php');
    }
  	else
  	{
  		   $idx = my_simple_crypt($_POST['idx'], 'd' );
  		   $result=mysqli_query($server1,"UPDATE `pengajuan_penelitian` SET `validasi_proposal_pengguna` = 'y' , `tgl_validasi_proposal_pengguna` = now() WHERE `idx_penelitian` = '".$idx."' ");

                 if($result)
                 {
                   //REDIRECT
                  header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_lima&idx='.$_POST['idx'].'&status=sukses');
                 }
                 else
                 {
                 //REDIRECT
                  header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_lima&status=gagal&kode='.mysqli_error($server1));
                 }  
  			
  	}
  	?>