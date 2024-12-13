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

        $langkah_satu_proses = my_simple_crypt($_POST['langkah_satu_proses'], 'd' );
        $judul = addslashes($_POST['judul']);
        $deskripsi = addslashes($_POST['deskripsi']);
        $tgl_mulai = date('Y-m-d', strtotime($_POST['tgl_mulai']));
        $tgl_akhir = date('Y-m-d', strtotime($_POST['tgl_akhir']));



        //insert query
        if ($langkah_satu_proses=='insert')
        {
          //jangan lupa dihapus
         //mysqli_query($server1,"TRUNCATE TABLE `pengajuan_penelitian`; ");

          $kata = "Menambah Data";
          
          if (($_POST['skema_penelitian']=='penelitian dasar')||($_POST['skema_penelitian']=='penelitian terapan'))
          {
            //adanya proses review
             $result = mysqli_query($server1,"INSERT INTO `pengajuan_penelitian` (`judul_penelitian`, `dekripsi_penelitian`, `id_ref_kelompok_bidang`, `id_ref_kategori_bidang`, `id_ref_bidang_penelitian`,`skema`, `mitra`,luaran,tgl_awal_pelaksanaan,tgl_akhir_pelaksanaan,`nip_pengisi`, `nama_pengisi`, `email_pengisi`,`tahun_pengajuan`, `tgl_insert`, nama_kelompok_keilmuan, nama_kelompok_penelitian) VALUES ('".$judul."', '".$deskripsi."', '".$_POST['rumpun_ilmu']."', '".$_POST['bidang_kategori']."', '".$_POST['bidang_penelitian']."', '".$_POST['skema_penelitian']."','".$_POST['mitra']."','".$_POST['luaran']."','".$tgl_mulai."','".$tgl_akhir."'  ,'".$_SESSION['nik_user']."', '".$_SESSION['nama_dan_gelar_user']."', '".$_SESSION['email_user']."', year(now()),  now(), '".$_POST['nama_kelompok_keilmuan']."','".$_POST['kelompok_penelitian']."')");
          }
          else
          {
            //tanpa proses review
             $cari_dir_lppm=mysqli_query($server1,"SELECT
                                                  *
                                                  FROM
                                                  pengguna WHERE role='dir_lppm' AND STATUS=1");
             $w=mysqli_fetch_array($cari_dir_lppm);
             $result = mysqli_query($server1,"INSERT INTO `pengajuan_penelitian` (`judul_penelitian`, `dekripsi_penelitian`, `id_ref_kelompok_bidang`, `id_ref_kategori_bidang`, `id_ref_bidang_penelitian`,`skema`, status_pengajuan,`mitra`,`nip_pengisi`,`nip_reviewer`, `nip_pengisi_reviewer`,`nama_pengisi`, `email_pengisi`,`tahun_pengajuan`, `tgl_insert`, nama_kelompok_penelitian,tgl_awal_pelaksanaan,tgl_akhir_pelaksanaan) VALUES ('".$judul."', '".$deskripsi."', '".$_POST['rumpun_ilmu']."', '".$_POST['bidang_kategori']."', '".$_POST['bidang_penelitian']."', '".$_POST['skema_penelitian']."','diperiksa','".$_POST['mitra']."' ,'".$_SESSION['nik_user']."','".$w['nip']."', '".$w['nip']."','".$_SESSION['nama_dan_gelar_user']."', '".$_SESSION['email_user']."', year(now()),  now(), '".$_POST['kelompok_penelitian']."','".$tgl_mulai."','".$tgl_akhir."')");
          }

          $id =  mysqli_insert_id($server1); 


            //insert ke pengajuan_penilaian
          $skema = str_replace(' ', '_', $_POST['skema_penelitian']);
          $tampil=mysqli_query($server1,"SELECT
                                                                                        *
                                                                                        FROM
                                                                                        ref_rubik where nama_skema='".$skema."'");

           while($w = mysqli_fetch_array($tampil))
           {
                 $result = mysqli_query($server1,"INSERT INTO `penilaian_rubik` (`idx_rubik`, `idx_penelitian`  ) 
                    VALUES ('".$w['idx_rubik']."', '".$id."');  ");
           }
           //end insert ke pengajuan penilaian*/


            if($result)
            {
                 $latest_id =  $id;
                 $langkah_satu_id=my_simple_crypt($latest_id, 'e' );
                //REDIRECT
                header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_dua&idx='.$langkah_satu_id.'&status=sukses_tambah');
            }
            else
            {
                //REDIRECT
                header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_dua&status=gagal&kode='.mysqli_error($server1));
            }   
        }
        else if ($langkah_satu_proses=='update') //update
        {
            $kata = "Mengubah Data";
            $idx = my_simple_crypt($_POST['idx'], 'd' );

            if (($_POST['skema_penelitian']=='penelitian dasar')||($_POST['skema_penelitian']=='penelitian terapan'))
          {
            //adanya proses review
            $result = mysqli_query($server1,"UPDATE `pengajuan_penelitian` SET `judul_penelitian` = '".$judul."' , `dekripsi_penelitian` = '".$deskripsi."' , `id_ref_kelompok_bidang` = '".$_POST['rumpun_ilmu']."' , `id_ref_kategori_bidang` = '".$_POST['bidang_kategori']."' , `id_ref_bidang_penelitian` = '".$_POST['bidang_penelitian']."' , `skema`='".$_POST['skema_penelitian']."',`mitra`='".$_POST['mitra']."',`nip_pengisi`='".$_SESSION['nik_user']."',nama_pengisi='".$_SESSION['nama_dan_gelar_user']."',email_pengisi='".$_SESSION['email_user']."',`tgl_update` = now(), nama_kelompok_keilmuan='".$_POST['nama_kelompok_keilmuan']."', nama_kelompok_penelitian='".$_POST['kelompok_penelitian']."',`tgl_awal_pelaksanaan`='".$tgl_mulai."',`tgl_akhir_pelaksanaan`='".$tgl_akhir."' WHERE `idx_penelitian` = '".$idx."'");
          }
          else
          {
            //tanpa  proses review
            //tanpa proses review
             $cari_dir_lppm=mysqli_query($server1,"SELECT
                                                  *
                                                  FROM
                                                  pengguna WHERE role='dir_lppm' AND STATUS=1");
             $w=mysqli_fetch_array($cari_dir_lppm);
               $result = mysqli_query($server1,"UPDATE `pengajuan_penelitian` SET `judul_penelitian` = '".$judul."' , `dekripsi_penelitian` = '".$deskripsi."' , `id_ref_kelompok_bidang` = '".$_POST['rumpun_ilmu']."' , `id_ref_kategori_bidang` = '".$_POST['bidang_kategori']."' , `id_ref_bidang_penelitian` = '".$_POST['bidang_penelitian']."' , `skema`='".$_POST['skema_penelitian']."',`mitra`='".$_POST['mitra']."',status_pengajuan='diperiksa',nip_reviewer='".$w['nip']."',`nip_pengisi`='".$_SESSION['nik_user']."',nama_pengisi='".$_SESSION['nama_dan_gelar_user']."',email_pengisi='".$_SESSION['email_user']."',nip_pengisi_reviewer='".$w['nip']."',nama_kelompok_keilmuan='".$_POST['nama_kelompok_keilmuan']."', `tgl_update` = now(), nama_kelompok_penelitian='".$_POST['kelompok_penelitian']."',`tgl_awal_pelaksanaan`='".$tgl_mulai."',`tgl_akhir_pelaksanaan`='".$tgl_akhir."' WHERE `idx_penelitian` = '".$idx."'");
          }


            //insert ke pengajuan_penilaian
          mysqli_query($server1,"delete from penilaian_rubik where idx_penelitian=".$idx);
          $skema = str_replace(' ', '_', $_POST['skema_penelitian']);
          $tampil=mysqli_query($server1,"SELECT
                                                                                        *
                                                                                        FROM
                                                                                        ref_rubik where nama_skema='".$skema."'");

           while($w = mysqli_fetch_array($tampil))
           {
                 $result = mysqli_query($server1,"INSERT INTO `penilaian_rubik` (`idx_rubik`, `idx_penelitian`  ) 
                    VALUES ('".$w['idx_rubik']."', '".$idx."');  ");
           }
           //end insert ke pengajuan penilaian*/

            if($result)
            {
                 
                //REDIRECT
                header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_dua&idx='.$_POST['idx'].'&status=sukses_ubah');
            }
            else
            {
                //REDIRECT
                header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_dua&status=gagal&kode='.mysqli_error($server1));
            }   
        }
    }
?>