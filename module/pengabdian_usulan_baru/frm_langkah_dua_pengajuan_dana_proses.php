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
        $langkah_proses = my_simple_crypt($_POST['langkah_proses'], 'd' );
       	if ($langkah_proses=='insert')
        {
            $kata = "Menambah Data Pengajuan";
            foreach ($_POST['rows'] as $key => $count )
            {
                

                $nama_pengajuan = $_POST['nama_pengajuan_'.$count];

                $nilai_pengajuan = $_POST['nilai_pengajuan_'.$count];
                $nilai_pengajuan =  str_replace('.','',$nilai_pengajuan);
                $nilai_pengajuan =  str_replace('Rp ','',$nilai_pengajuan);
               
                
                $result=mysqli_query($server1,"INSERT INTO `pengajuan_dana_pengabdian` (`nama_dana`, `nominal_dana_pengajuan`, `idx_pengabdian`, `tgl_insert`, `nip_pengisi`) VALUES ('".$nama_pengajuan."', '".$nilai_pengajuan."', '".$idx."', now(), '".$_SESSION['nik_user']."')");

               if($result)
               {
                 //REDIRECT
                header('location:../../view.php?menu=pengabdian&act=usulan_baru_langkah_tiga&idx='.$_POST['idx'].'&status=sukses_tambah');
               }
               else
               {
               //REDIRECT
                header('location:../../view.php?menu=pengabdian&act=usulan_baru_langkah_tiga&status=gagal&kode='.mysqli_error($server1));
               }   
            }
        }
    }
?>