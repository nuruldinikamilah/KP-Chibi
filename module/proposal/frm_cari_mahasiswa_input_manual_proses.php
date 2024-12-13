<?php
    date_default_timezone_set("Asia/Bangkok");

    session_start();
    include "../../config/koneksi.php";
    include "../../lib/enkripsi_decrpt.php";
    include "../../lib/send_email.php";

    if (isset($_POST['nim']))
    {
        //cari dulu
        $cari=mysqli_query($server1,"select * from proposal_tahap_final where nim = '".$_POST['nim']."' and TAHUN='".$_SESSION['tahun_aktif']."' and SMT='".$_SESSION['semester_aktif']."'");
        $ketemu=mysqli_num_rows($cari); 
        

        $keilmuan_decrypted = my_simple_crypt($_POST['keilmuan'], 'd' );
        $nama_mhs = addslashes($_POST['nama']);
        $judul = addslashes($_POST['judul']);

        if (($_POST['jenis']=='K')||($_POST['jenis']=='P'))
        {
          $stat='diterima';
        }
        else
        {
          $stat='';
        }

        //insert query
        if ($ketemu==0)
        {
            //jangan lupa dihapus
         //mysqli_query($server1,"TRUNCATE TABLE `proposal_tahap_final`; ");
            $kata = "Menambah Data";
            $result = mysqli_query($server1,"INSERT INTO `proposal_tahap_final` (`TAHUN`, `SMT`, `NIM`, `NAMA`,`JUDUL`, `KODEPEMBIMBING`, `JENIS`, `TAHUN_PERPANJANGAN`, `SMT_PERPANJANGAN`, `KELOMPOKKEILMUAN`, `TEMA`,`EMAILMHS`, `FILE_PROPOSAL`, `FILE_REVIEW`, STATUS, `TGLINSERTMAHASISWA`,TGLUPDATEKOORDINATOR, DOSEN_UPDATE, TGL_UPDATE, NIP_UPDATE) VALUES ('".$_SESSION['tahun_aktif']."', '".$_SESSION['semester_aktif']."', '".$_POST['nim']."', '".$nama_mhs."','".$judul."', '-', '$_POST[jenis]', NULL, NULL, '".$keilmuan_decrypted."', '$_POST[tema]','".$_POST['email']."','-', '-','".$stat."', NULL, NULL,NULL,now(),'".$_SESSION['nik_user']."')");
        //end query untuk user management



            

          header('location:../../view.php?menu=proposal&act=langkah_satu_cari_mahasiswa&status=sukses');
        }
        else //update
        {
            $kata = "Mengubah Data";
            $result = mysqli_query($server1,"UPDATE `proposal_tahap_final` SET `TAHUN` = '".$_SESSION['tahun_aktif']."' , `SMT` = '".$_SESSION['semester_aktif']."' , `NIM` = '".$_POST['nim']."' , `NAMA` = '".$nama_mhs."',`JUDUL` = '".$judul."' , `KODEPEMBIMBING` = '".$_POST['dosenpembimbing']."' , `JENIS` = '$_POST[jenis]' , `KELOMPOKKEILMUAN` = '".$keilmuan_decrypted."' ,TEMA='".$_POST['tema']."' ,STATUS='".$stat."' ,`EMAILMHS` = '".$_POST['email']."', `FILE_PROPOSAL` =  '-' , `FILE_REVIEW` = '-', `TGLINSERTMAHASISWA` = NULL, TGL_UPDATE=now(), NIP_UPDATE='".$_SESSION['nik_user']."' WHERE `TAHUN` = '".$_SESSION['tahun_aktif']."' AND `SMT` = '".$_SESSION['semester_aktif']."' AND `NIM` = '".$_POST['nim']."'");

             header('location:../../view.php?menu=proposal&act=langkah_satu_cari_mahasiswa&status=ubah');
        }




        //KIRIM EMAIL //
        //SELECT
             $cari=mysqli_query($server1,"SELECT
                                                a.NIM,
                                                a.NAMA,
                                                a.JUDUL,
                                                a.`KELOMPOKKEILMUAN`,
                                                c.`nama_tema`,
                                                a.TAHUN,
                                                a.SMT,
                                                b.`nama` AS nama_dosen,
                                                a.`TGLINSERTMAHASISWA`
                                                FROM
                                                `proposal_tahap_final` a
                                                INNER JOIN
                                                 ref_dosen b
                                                INNER JOIN
                                                 ref_tema c
                                                ON a.`KODEPEMBIMBING` = b.`kddosen` AND
                                                   a.`TEMA` = c.`kd_tema`
                                                WHERE nim='".$_POST['nim']."' AND SMT='".$_SESSION['semester_aktif']."' AND TAHUN=".$_SESSION['tahun_aktif']."
                                                ORDER BY `TGLINSERTMAHASISWA` DESC
                                                LIMIT 1");
             $r=mysqli_fetch_array($cari);

            //email untuk insert
              kirim_email($_POST['email'],"SISTEM PROPOSAL TEKNIK INFORMATIKA UNIKOM","
                <html>
                ".$r['NAMA']." Berhasil ".$kata." Pada Sistem Proposal UNIKOM, Berikut Adalah Data Yang Telah Dimasukan :
                    <body>
                    <hr>
                    <br>
                    <table width='683' border='1'>
                      <tr>
                        <td width='62'><strong>NIM</strong></td>
                        <td width='13'><strong>:</strong></td>
                        <td width='586'>".$r['NIM']."</td>
                      </tr>
                      <tr>
                        <td><strong>NAMA</strong></td>
                        <td><strong>:</strong></td>
                        <td width='586'>".$r['NAMA']."</td>
                      </tr>
                      <tr>
                        <td><strong>JUDUL PENGAJUAN PROPOSAL </strong></td>
                        <td><strong>:</strong></td>
                        <td width='586'>".$r['JUDUL']."</td>
                      </tr>
                      <tr>
                        <td><strong>KELOMPOK KEILMUAN </strong></td>
                        <td><strong>:</strong></td>
                        <td width='586'>".$r['KELOMPOKKEILMUAN']."</td>
                      </tr>
                      <tr>
                        <td><strong>NAMA TEMA </strong></td>
                        <td><strong>:</strong></td>
                        <td width='586'>".$r['nama_tema']."</td>
                      </tr>
                       <tr>
                        <td><strong>TAHUN </strong></td>
                        <td><strong>:</strong></td>
                       <td width='586'>".$r['TAHUN']."</td>
                      </tr>
                       <tr>
                        <td><strong>SMT</strong></td>
                        <td><strong>:</strong></td>
                       <td width='586'>".$r['SMT']."</td>
                      </tr>
                       <tr>
                        <td><strong>NAMA CALON DOSEN PEMBIMBING </strong></td>
                        <td><strong>:</strong></td>
                        <td width='586'>".$r['nama_dosen']."</td>
                      </tr>
                      <tr>
                        <td><strong>Tanggal Memasukan Data</strong></td>
                        <td><strong>:</strong></td>
                        <td width='586'>".$r['TGL_UPDATE']."</td>
                      </tr>
                    </table>

                    </body>
                    </html>
                    ");
            kirim_email("anggasetiyadi@gmail.com",$_SESSION['nama_lengkap']." Menambah atau Mengubah Data Manual Sistem Proposal-".date("d-m-Y")." ".date("h:i:sa"),"KOSONG");
    }
    else
    {
              header('location:../../index.php');
    }
?>