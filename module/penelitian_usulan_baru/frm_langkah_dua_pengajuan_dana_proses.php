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
               
                
                $result=mysqli_query($server1,"INSERT INTO `pengajuan_dana_penelitian` (`nama_dana`, `nominal_dana_pengajuan`, `idx_penelitian`, `tgl_insert`, `nip_pengisi`) VALUES ('".$nama_pengajuan."', '".$nilai_pengajuan."', '".$idx."', now(), '".$_SESSION['nik_user']."')");

               if($result)
               {
                 //REDIRECT
                header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_tiga&idx='.$_POST['idx'].'&status=sukses_tambah');
               }
               else
               {
               //REDIRECT
                header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_tiga&status=gagal&kode='.mysqli_error($server1));
               }   
            }
        }
       	 /*echo "<p>Ini Nanti Yang Akan Di Insert</p>";
            foreach ($_POST['rows'] as $key => $count )
            {
                $nama_pengajuan = $_POST['nama_pengajuan_'.$count];
                $nilai_pengajuan = $_POST['nilai_pengajuan_'.$count];

               
                echo "Data nama pengajuan KE ".$count.": ".$nama_pengajuan."<br>";
                echo "Data nilai pengajuan KE ".$count.": ".$nilai_pengajuan."<br>";
                
                echo "<br><br>";
            }*/
        /*
        //insert query
        if ($langkah_satu_proses=='insert')
        {
          //jangan lupa dihapus
         //mysqli_query($server1,"TRUNCATE TABLE `pengajuan_penelitian`; ");

          $kata = "Menambah Data";
          $result = mysqli_query($server1,"INSERT INTO `pengajuan_penelitian` (`judul_penelitian`, `dekripsi_penelitian`, `id_ref_kelompok_bidang`, `id_ref_kategori_bidang`, `id_ref_bidang_penelitian`, `nip_pengisi`, `nama_pengisi`, `email_pengisi`,`tahun_pengajuan`, `tgl_insert`) VALUES ('".$judul."', '".$deskripsi."', '".$_POST['rumpun_ilmu']."', '".$_POST['bidang_kategori']."', '".$_POST['bidang_penelitian']."', '".$_SESSION['nik_user']."', '".$_SESSION['nama_dan_gelar_user']."', '".$_SESSION['email_user']."', year(now()),  now())");

            if($result)
            {
                 $latest_id =  mysqli_insert_id($server1); 
                 $langkah_satu_id=my_simple_crypt($latest_id, 'e' );
                //REDIRECT
                header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_dua&idx='.$langkah_satu_id.'&status=sukses_tambah');
            }
            else
            {
                //REDIRECT
                header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_dua&status=gagal&kode='.mysql_error());
            }   
        }
        else if ($langkah_satu_proses=='update') //update
        {
            
        }*/
    }
?>