<?php
    session_start();
    include "../../config/koneksi.php";
    include "../../lib/enkripsi_decrpt.php";
    include "../../lib/send_email.php";

    $idx = my_simple_crypt($_POST['idx'], 'd' );
    $langkah_proses = my_simple_crypt($_POST['langkah_proses'], 'd' );
    $kata = "Menambah Data Anggota Peneliti";

    if ($_SESSION['nik_user']=='')
    {
            header('location:../../index.php');
    }
    else
    {
        if ($_POST['banyak_data_peneliti']<$_POST['banyak_data_peneliti_sebelumnya'])
        {
           //REDIRECT
                header('location:../../view.php?menu=pengabdian&act=usulan_baru_langkah_empat&idx='.$_POST['idx'].'&status=sukses');
        }
        else if ($_POST['banyak_data_peneliti']==$_POST['banyak_data_peneliti_sebelumnya'])
        {
           //REDIRECT
                header('location:../../view.php?menu=pengabdian&act=usulan_baru_langkah_empat&idx='.$_POST['idx'].'&status=sukses');
        }

        //jika ada yang ditambahkan
        else if (($langkah_proses=='insert')&&($_POST['banyak_data_peneliti']!=$_POST['banyak_data_peneliti_sebelumnya']))
        {
            foreach ($_POST['rows'] as $key => $count )
            {
                $nip_anggota_peneliti = $_POST['nip_anggota_peneliti_'.$count];

                $nama_belakang = $_POST['nama_belakang_'.$count];
                $status_peneliti = $_POST['status_peneliti_'.$count];
                $keterangan_peneliti = ucfirst($_POST['keterangan_peneliti_'.$count]);
                $program_studi_peneliti = $_POST['program_studi_peneliti_'.$count];
                $universitas = $_POST['universitas_'.$count];
                
                $result=mysqli_query($server1,"INSERT INTO `pengajuan_anggota_pengabdian` (`nip_anggota`, `nama_peneliti`, `status_peneliti`, `keterangan`, `idx_pengabdian`, `tgl_insert`, `nip_pengisi`, prodi_dosen_luar, universitas_dosen_luar) VALUES ('".$nip_anggota_peneliti."', '".$nama_belakang."', '".$status_peneliti."', '".$keterangan_peneliti."', '".$idx."', now(), '".$_SESSION['nik_user']."', '".$program_studi_peneliti."','".$universitas."')");




               if($result)
               {
                 //REDIRECT
                header('location:../../view.php?menu=pengabdian&act=usulan_baru_langkah_empat&idx='.$_POST['idx'].'&status=sukses');
               }
               else
               {
               //REDIRECT
                header('location:../../view.php?menu=pengabdian&act=usulan_baru_langkah_tiga&status=gagal&kode='.mysqli_error($server1));
               }   
            }
        }
        else if (($langkah_proses=='insert')&&($_POST['banyak_data_peneliti']==isset($_POST['banyak_data_peneliti_sebelumnya'])))
        {
               //REDIRECT
               header('location:../../view.php?menu=pengabdian&act=usulan_baru_langkah_empat&idx='.$_POST['idx']);
        
        }
        
        //exe 1 data
        else 
        {
                $nip_anggota_peneliti = $_POST['nip_anggota_peneliti_1'];

                $nama_belakang = $_POST['nama_belakang_1'];
                $status_peneliti = $_POST['status_peneliti_1'];
                $keterangan_peneliti = ucfirst($_POST['keterangan_peneliti_1']);
               
                
                $result=mysqli_query($server1,"INSERT INTO `pengajuan_anggota_pengabdian` (`nip_anggota`, `nama_peneliti`, `status_peneliti`, `keterangan`, `idx_pengabdian`, `tgl_insert`, `nip_pengisi`, prodi_dosen_luar, universitas_dosen_luar) VALUES ('".$nip_anggota_peneliti."', '".$nama_belakang."', '".$status_peneliti."', '".$keterangan_peneliti."', '".$idx."', now(), '".$_SESSION['nik_user']."', '','')");




               if($result)
               {
                 //REDIRECT
                header('location:../../view.php?menu=pengabdian&act=usulan_baru_langkah_empat&idx='.$_POST['idx'].'&status=sukses');
               }
               else
               {
               //REDIRECT
                header('location:../../view.php?menu=pengabdian&act=usulan_baru_langkah_tiga&status=gagal&kode='.mysqli_error($server1));
               }   
        }
        
    }
?>