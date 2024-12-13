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
            
           
              //adanya proses review
               $result = mysqli_query($server1,"INSERT INTO `pengajuan_pengabdian` (`judul_pengabdian`, `dekripsi_pengabdian`, `id_ref_kelompok_bidang`, `id_ref_kategori_bidang`, `id_ref_bidang_penelitian`,`skema`, `mitra`,tingkat_penyelenggaraan,tempat_pelaksanaan, luaran, tgl_awal_pelaksanaan,tgl_akhir_pelaksanaan,nama_mitra,alamat_mitra,penanggung_jawab,id_ref_sumber_dana,`nip_pengisi`, `nama_pengisi`, `email_pengisi`,`tahun_pengajuan`, `tgl_insert`) VALUES ('".$judul."', '".$deskripsi."', '".$_POST['rumpun_ilmu']."', '".$_POST['bidang_kategori']."', '".$_POST['bidang_penelitian']."', '".$_POST['skema_penelitian']."','".$_POST['mitra']."' ,'".$_POST['tipel']."' ,'".$_POST['tempel']."' ,'".$_POST['luaran']."' ,'".$tgl_mulai."','".$tgl_akhir."' ,'".$_POST['nama_mitra']."','".$_POST['alamat_mitra']."','".$_POST['penanggung_jawab']."','".$_POST['id_ref_sumber_dana']."','".$_SESSION['nik_user']."', '".$_SESSION['nama_dan_gelar_user']."', '".$_SESSION['email_user']."', year(now()),  now())");
           

            $id =  mysqli_insert_id($server1); 


            //ini ubah untuk pengabdian
              //insert ke pengajuan_penilaian
            $skema = str_replace(' ', '_', $_POST['skema_penelitian']);
            $tampil=mysqli_query($server1,"SELECT
                                                                                          *
                                                                                          FROM
                                                                                          ref_rubik where nama_skema='pengabdian'");

             while($w = mysqli_fetch_array($tampil))
             {
                   $result = mysqli_query($server1,"INSERT INTO `penilaian_rubik_pengabdian` (`idx_rubik`, `idx_pengabdian`  ) 
                      VALUES ('".$w['idx_rubik']."', '".$id."');  ");
             }
             //end insert ke pengajuan penilaian


            


              if($result)
              {
                   $latest_id =  $id;
                   $langkah_satu_id=my_simple_crypt($latest_id, 'e' );
                  //REDIRECT
                  header('location:../../view.php?menu=pengabdian&act=usulan_baru_langkah_dua&idx='.$langkah_satu_id.'&status=sukses_tambah');
              }
              else
              {
                  //REDIRECT
                  header('location:../../view.php?menu=pengabdian&act=usulan_baru_langkah_dua&status=gagal&kode='.mysqli_error($server1));
              }  
              //end ubah untuk pengabdian 
        }
        else if ($langkah_satu_proses=='update') //update
        {
            $kata = "Mengubah Data";
            $idx = my_simple_crypt($_POST['idx'], 'd' );

           
            //adanya proses review
            $result = mysqli_query($server1,"UPDATE `pengajuan_pengabdian` SET `judul_pengabdian` = '".$judul."' , `dekripsi_pengabdian` = '".$deskripsi."' , `id_ref_kelompok_bidang` = '".$_POST['rumpun_ilmu']."' , `id_ref_kategori_bidang` = '".$_POST['bidang_kategori']."' , `id_ref_bidang_penelitian` = '".$_POST['bidang_penelitian']."' , `skema`='".$_POST['skema_penelitian']."',`mitra`='".$_POST['mitra']."',`tingkat_penyelenggaraan`='".$_POST['tipel']."',`tempat_pelaksanaan`='".$_POST['tempel']."',`luaran`='".$_POST['luaran']."',`tgl_awal_pelaksanaan`='".$tgl_mulai."',`tgl_akhir_pelaksanaan`='".$tgl_akhir."',`nama_mitra`='".$_POST['nama_mitra']."',`alamat_mitra`='".$_POST['alamat_mitra']."',`penanggung_jawab`='".$_POST['penanggung_jawab']."',id_ref_sumber_dana='".$_POST['id_ref_sumber_dana']."',`nip_pengisi`='".$_SESSION['nik_user']."',nama_pengisi='".$_SESSION['nama_dan_gelar_user']."',email_pengisi='".$_SESSION['email_user']."',`tgl_update` = now() WHERE `idx_pengabdian` = '".$idx."'");
         

            //insert ke pengajuan_penilaian
          mysqli_query($server1,"delete from penilaian_rubik_pengabdian where idx_pengabdian=".$idx);
          $skema = str_replace(' ', '_', $_POST['skema_penelitian']);
          $tampil=mysqli_query($server1,"SELECT
                                                                                        *
                                                                                        FROM
                                                                                        ref_rubik where nama_skema='pengabdian'");

           while($w = mysqli_fetch_array($tampil))
           {
                 $result = mysqli_query($server1,"INSERT INTO `penilaian_rubik_pengabdian` (`idx_rubik`, `idx_pengabdian`  ) 
                    VALUES ('".$w['idx_rubik']."', '".$idx."');  ");
           }
           //end insert ke pengajuan penilaian*/

            if($result)
            {
                 
                //REDIRECT
                header('location:../../view.php?menu=pengabdian&act=usulan_baru_langkah_dua&idx='.$_POST['idx'].'&status=sukses_ubah');
            }
            else
            {
                //REDIRECT
                header('location:../../view.php?menu=pengabdian&act=usulan_baru_langkah_dua&status=gagal&kode='.mysqli_error($server1));
            }   
        }
    }
?>