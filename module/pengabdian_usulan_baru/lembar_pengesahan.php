<?php
session_start();

include_once("../../config/tanggal.php");
include_once("../../config/f_rupiah.php");
include_once("../../config/koneksi.php"); //buat koneksi ke database
include_once ("../../lib/enkripsi_decrpt.php");


 //Define relative path from this script to mPDF
 
 $nama_file='Lembar Pengesahan Pengabdian-'.date("Y"); //Beri nama file PDF hasil.
        // Require composer autoload
        require_once "../../lib/./mpdf_8/vendor/autoload.php";
        $mpdf = new \Mpdf\Mpdf();
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        
        // Buffer the following html with PHP so we can store it to a variable later
        ob_start();

        // This is where your script would normally output the HTML using echo or print
?>
<!-- mulai pdf -->
<!DOCTYPE html>
<html>
<head>
<title>Lembar Pengesahan</title>
  <style>
    

    table
    {
      border-left: 1px solid #fff;
      border-top: 1px solid #fff;
      font-family: calibri;
      font-size: 14px; 
      border-spacing:0;
      border-collapse: collapse; 
      font-family: "Times New Roman", Times, serif;

    }

    table td 
    {
      border-right: 1px solid #fff;
      border-bottom: 1px solid #fff;
      text-align:justify;
      font-family: "Times New Roman", Times, serif;
      vertical-align: text-top;
    }


    p
    {
      margin:0;
      padding:0;
      margin-left: 200px;
      font-family: calibri;
      font-size: 20px; 
    }
   p.isi_agama {
      line-height:2;
      font-size:14px;
      margin-left:0px;
    }
    
table.atas {
      border-width: 0px;
      border-spacing: 0px;
      border-style: none;
      border-collapse: collapse;
      background-color: white;
      font-size: 20px; 
    }
    table.atas th {
      border-width: medium;
      padding: 0px;
      border-style: groove;
      border-color: black;
      background-color: #999;
      -moz-border-radius: 0px 0px 0px 0px;
      font-size : 77%;
      font-family : "Myriad Web",Verdana,Helvetica,Arial,sans-serif;
    }
    table.atas td {
     
      background-color: white;
      font-size : 77%;
      font-family : "Myriad Web",Verdana,Helvetica,Arial,sans-serif;
      font-weight: bold;
    }

    table.pasal {
      border-width: 0px;
      border-spacing: 0px;
      border-style: none;
      border-collapse: collapse;
      background-color: white;
      font-size: 12px; 
    }
    table.pasal th {
      font-family : "Myriad Web",Verdana,Helvetica,Arial,sans-serif;
    }
    table.pasal td {
      background-color: white;
    }
  
      table.border_tebal {
      border-width: 0px;
      border-spacing: 0px;
      border-style: none;
      border-collapse: collapse;
      background-color: white;
    }
    table.border_tebal th {
      border-width: medium;
      padding: 0px;
      border-style: groove;
      border-color: black;
      background-color: #999;
      -moz-border-radius: 0px 0px 0px 0px;
      font-size : 77%;
      font-family : "Myriad Web",Verdana,Helvetica,Arial,sans-serif;
    }
    table.border_tebal td {
      border-width: medium;
      
      border-style: groove;
      border-color: black;
      background-color: white;
      font-size : 77%;
      font-family : "Myriad Web",Verdana,Helvetica,Arial,sans-serif;
      font-weight: bold;
    }




    table tr td.kwitansi_perjanjian
{
 border-width: medium;
      
      border-right: 1px solid #fff;
      border-bottom: 1px solid #fff;
      font-family: "Times New Roman", Times, serif;
    text-align:right;
}

table tr td.no_header_atas
{
      border-right: 1px solid #fff;
      border-bottom: 1px solid #fff;
      font-family: "Times New Roman", Times, serif;
    text-align:center;
    font-size:10px;
}
  




  </style>
</head>
<body>
  <!-- bagian halaman yang akan dikonversi -->
  <div id="wrapper">
  <br />
     <table width="711">
      <tr>
        <td width="703"><center><h2>HALAMAN PENGESAHAN<br>
          PENGABDIAN DAN PEMBERDAYAAN (P2M) UNIKOM
        </h2></center>
        </td>
      </tr>
    </table>
    <br /><br>
            <?php
                $idx=my_simple_crypt($_GET['idx'], 'd' );
                $sql_data_master=mysqli_query($server1,"SELECT * from pengajuan_pengabdian where idx_pengabdian='".$idx."'");
                $r=mysqli_fetch_array($sql_data_master);
            ?>
          <table width="709">
          <tr>
            <td width="21">1.</td>
            <td width="228">Judul P2M </td>
            <td width="23">:</td>
            <td width="417"><?php echo $r['judul_pengabdian'];?></td>
          </tr>
          <tr>
            <td valign="top">2.</td>
            <td valign="top"><b>Pelaksana</b></td>
            <td valign="top"></td>

            <td valign="top">&nbsp;</td>
          </tr>
          <?php
                $sql_data_pelaksana=mysqli_query($server1,"SELECT
                                                            *
                                                            FROM
                                                            `lppm2020`.`pengajuan_anggota_pengabdian` a
                                                            INNER JOIN
                                                            `integrasi`.`karyawan` b
                                                            ON a.`nip_anggota` = b.`nip`
                                                            where a.idx_pengabdian='".$idx."' and status_peneliti='Ketua'");
                $x=mysqli_fetch_array($sql_data_pelaksana);
            ?>
          <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">a. Nama </td>
            <td valign="top">:</td>
            <td valign="top"><?php echo $x['nama_peneliti'];?></td>
          </tr>
          <tr>
            <td valign="top">&nbsp;</td>
            <td valign="top">b. NIP/NIDN </td>
            <td valign="top">:</td>
           
            <td valign="top"><?php echo $x['nip']." / ".$x['nidn'];?></td>
            <?php
                $sql_jab_ketua=mysqli_query($server1,"SELECT
                                                        *
                                                        FROM
                                                        sister.`jabatan_fungsional`
                                                        WHERE `id_dosen`= '".$x['id_sister']."' ORDER BY id_jabfung DESC limit 1");
                $qj=mysqli_fetch_array($sql_jab_ketua);
            ?>

            <?php
                $sql_gol_ketua=mysqli_query($server1,"SELECT
                                                      *
                                                      FROM
                                                      sister.`kepangkatan`
                                                      WHERE `id_dosen`= '".$x['id_sister']."' ORDER BY id_pangkat_golongan DESC LIMIT 1;");
                  $qg=mysqli_fetch_array($sql_gol_ketua);
            ?>
          </tr>
            <tr>
              <td>&nbsp;</td>
              <td>c. Jabfung/Golongan </td>
              <td>:</td>
              <td><?php echo $qj['jabatan_fungsional']?> / <?php echo $qg['pangkat_golongan']?></td>
            </tr>
            <?php
                $sql_p_s_ketua=mysqli_query($server1,"SELECT
                                                        *
                                                        FROM integrasi.karyawan_bagian a
                                                        INNER JOIN
                                                        integrasi.prodi b
                                                        INNER JOIN
                                                        `integrasi`.`fakultas` c
                                                        ON a.`kode_bagian` = b.`kodejur` AND
                                                        b.`kodefak` = c.`kodefak`    
                                                        WHERE a.nip='".$x['nip']."' and homebase='1'");
                $qa=mysqli_fetch_array($sql_p_s_ketua);
            ?>


            <tr>
              <td>&nbsp;</td>
              <td>d. Program Studi  </td>
              <td>:</td>
              <td><?php echo $qa['jurusan'];?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>e. No HP </td>
              <td>:</td>
              <td><?php 
                       if (is_null($x['hp']))
                        {
                            $no_hp='-';
                        }
                        else
                        {
                            $no_hp=$x['hp'];
                        }

                        echo $no_hp;
                        ?>               
             </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>f. Surel </td>
              <td>:</td>
              <td>
                  <?php 
                       if (is_null($x['email_unikom']))
                        {
                            $email_ketua='-';
                        }
                        else
                        {
                            $email_ketua=$x['email_unikom'];
                        }

                        echo $email_ketua;
                        ?> 
              </td>
            </tr>
            <?php
               $sql_pengajuan_anggota_pengabdian=mysqli_query($server1,"SELECT
                                                        *
                                                        from pengajuan_anggota_pengabdian where idx_pengabdian='".$idx."' and status_peneliti='Anggota' and (keterangan='Dosen' or keterangan='DosenLuar')");
               $jum_pengajuan_anggota_pengabdian=mysqli_num_rows($sql_pengajuan_anggota_pengabdian);
              
                //isi nilai identifikasi mahasiswa untuk nomor
                   if ($jum_pengajuan_anggota_pengabdian==0)
                   {
                        $no_identifikasi_mahasiswa='3'; 
                        $no_identifikasi_tingkat_penyelenggara='4';
                        $no_identifikasi_waktu_pelaksanaan='5';
                        $no_identifikasi_tempat_pelaksanaan='6';
                        $no_identifikasi_luaran_yang_dihasilkan='7';
                        $no_identifikasi_mitra='8';
                        $no_identifikasi_jumlah_dana='9';
                        $no_identifikasi_sumber_dana='10';
                   }
                   else
                   {
                       $no_identifikasi_mahasiswa='4';
                        $no_identifikasi_tingkat_penyelenggara='5';
                        $no_identifikasi_waktu_pelaksanaan='6';
                        $no_identifikasi_tempat_pelaksanaan='7';
                        $no_identifikasi_luaran_yang_dihasilkan='8';
                        $no_identifikasi_mitra='9';
                        $no_identifikasi_jumlah_dana='10';
                        $no_identifikasi_sumber_dana='11'; 
                   }



               //hitung total dosen
               if ($jum_pengajuan_anggota_pengabdian>0)
               {
                   $pengajuan_anggota_pengabdian=mysqli_fetch_array($sql_pengajuan_anggota_pengabdian);


                   if ($pengajuan_anggota_pengabdian['keterangan']=='DosenLuar')
                   {
                      $nama_anggota=$pengajuan_anggota_pengabdian['nama_peneliti'];
                   }
                   else if ($pengajuan_anggota_pengabdian['keterangan']=='Dosen')
                   {
                      $sql_pengajuan_anggota_pengabdian_dosen=mysqli_query($server1,"SELECT
                                                                                      *
                                                                                      FROM
                                                                                      `lppm2020`.`pengajuan_anggota_pengabdian` a
                                                                                      INNER JOIN
                                                                                      `integrasi`.`karyawan` b
                                                                                      ON a.`nip_anggota` = b.`nip`
                                                                                      where a.idx_pengabdian='".$idx."' and status_peneliti='Anggota'");
                     $pengajuan_anggota_pengabdian_dosen=mysqli_fetch_array($sql_pengajuan_anggota_pengabdian_dosen);
                     $nama_anggota=$pengajuan_anggota_pengabdian_dosen['nama_peneliti'];
                     $NIDN=$pengajuan_anggota_pengabdian_dosen['nidn'];
                   }
                ?>
                <tr>
                  <td>3.</td>
                  <td><b>Anggota 1 (Dosen)</b></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>a. Nama </td>
                  <td>:</td>
                  <td><?php echo $nama_anggota;?></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <?php
                   if ($pengajuan_anggota_pengabdian['keterangan']=='DosenLuar')
                   {
                      ?>
                        <td>b. NIDN</td>
                        <td>:</td>
                        <td><?php echo $pengajuan_anggota_pengabdian['nip_anggota'];?></td>
                      <?php
                   } 
                   else if ($pengajuan_anggota_pengabdian['keterangan']=='Dosen')
                   {
                      ?>
                        <td>b. NIP/NIDN</td>
                        <td>:</td>
                        <td><?php echo $pengajuan_anggota_pengabdian['nip_anggota']." / ".$NIDN;?></td>
                      <?php
                   }

                  
                   
                }//end hitung total dosen
                  ?>
                </tr>
            <tr>
              <td><?php  echo $no_identifikasi_mahasiswa; ?></td>
              <td><b>Anggota 2 (Mahasiswa)</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <?php
                $sql_pengajuan_anggota_pengabdian_mhs=mysqli_query($server1,"SELECT 
                                                                              b.`nim`,
                                                                              b.`nama`,
                                                                              c.`jurusan`
                                                                            FROM
                                                                              `lppm2020`.`pengajuan_anggota_pengabdian` a 
                                                                              INNER JOIN `integrasi`.`mahasiswa` b 
                                                                              INNER JOIN `integrasi`.`prodi` c
                                                                                ON a.`nip_anggota` = b.`nim` AND
                                                                                b.`kodejur` =  c.`kodejur`
                                                                            WHERE a.idx_pengabdian = '".$idx."' 
                                                                              AND a.status_peneliti = 'Anggota' AND a.`keterangan`='Mahasiswa'");
                 $pengajuan_anggota_pengabdian_mhs=mysqli_fetch_array($sql_pengajuan_anggota_pengabdian_mhs);
            ?>
            <tr>
              <td>&nbsp;</td>
              <td>a. Nama Lengkap </td>
              <td>:</td>
              <td><?php echo ucwords(strtolower($pengajuan_anggota_pengabdian_mhs['nama']));?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>b. Prodi &amp; NIM </td>
              <td>:</td>
              <td><?php echo $pengajuan_anggota_pengabdian_mhs['jurusan']." & ".$pengajuan_anggota_pengabdian_mhs['nim'];?></td>
            </tr>
            <tr>
              <td><?php echo $no_identifikasi_tingkat_penyelenggara;?></td>
              <td>Tingkat Penyelenggara </td>
              <td>:</td>
              <td><?php echo $r['tingkat_penyelenggaraan'];?></td>
            </tr>
            <tr>
              <td><?php echo $no_identifikasi_waktu_pelaksanaan;?></td>
              <td>Waktu Pelaksanaan </td>
              <td>:</td>
              <td><?php echo tgl_indo($r['tgl_awal_pelaksanaan'])." S/D ".tgl_indo($r['tgl_akhir_pelaksanaan']);?></td>
            </tr>
            <tr>
               <td><?php echo $no_identifikasi_tempat_pelaksanaan;?></td>
              <td>Tempat Pelaksanaan </td>
              <td>:</td>
              <td><?php echo $r['tempat_pelaksanaan'];?></td>
            </tr>
            <tr>
              <td><?php echo $no_identifikasi_luaran_yang_dihasilkan;?></td>
              <td>Luaran Yang Dihasilkan </td>
              <td>:</td>
              <td><?php echo $r['luaran'];?></td>
            </tr>
            <tr>
              <td><?php echo $no_identifikasi_mitra;?></td>
              <td>Mitra</td>
              <td>:</td>
              <td><?php echo $r['mitra'];?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>Nama Mitra </td>
              <td>:</td>
              <td><?php echo $r['nama_mitra'];?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>Alamat</td>
              <td>:</td>
             <td><?php echo $r['alamat_mitra'];?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>Penanggung Jawab </td>
              <td>:</td>
             <td><?php echo $r['penanggung_jawab'];?></td>
            </tr>
            <tr>
              <?php
                 $sql_pengajuan_dana_pengabdian=mysqli_query($server1,"SELECT
                                                                        *, SUM(nominal_dana_pengajuan) AS jumlah_dana
                                                                        FROM
                                                                        pengajuan_dana_pengabdian
                                                                        WHERE idx_pengabdian='".$idx."'
                                                                        GROUP BY idx_pengabdian;");
                 $pengajuan_dana_pengabdian=mysqli_fetch_array($sql_pengajuan_dana_pengabdian);
              ?>
              <td><?php echo $no_identifikasi_jumlah_dana;?></td>
              <td>Jumlah Dana </td>
              <td>:</td>
              <td>Rp. <?php echo rupiah($pengajuan_dana_pengabdian['jumlah_dana']);?></td>
            </tr>
            <tr>
               <?php
                 $sql_pengajuan_sumber_dana_pengabdian=mysqli_query($server1,"SELECT
                                                                                id_ref_sumber_dana
                                                                                FROM
                                                                                `pengajuan_pengabdian` a 
                                                                                WHERE `idx_pengabdian`='".$idx."'");
                 $pengajuan_sumber_dana_pengabdian=mysqli_fetch_array($sql_pengajuan_sumber_dana_pengabdian);
              ?>
               <td><?php echo $no_identifikasi_sumber_dana;?></td>
              <td>Sumber Dana </td>
              <td>:</td>
              <?php
                /*if ($pengajuan_sumber_dana_pengabdian['id_ref_sumber_dana']=='mandiri')
                {
                  $sumber_dana='Mandiri';
                }
                else if ($pengajuan_sumber_dana_pengabdian['id_ref_sumber_dana']=='dpnm')
                {
                  $sumber_dana='DPNM';
                }
                else if ($pengajuan_sumber_dana_pengabdian['id_ref_sumber_dana']=='pemda')
                {
                  $sumber_dana='Pemerintah Daerah';
                }
                else if ($pengajuan_sumber_dana_pengabdian['id_ref_sumber_dana']=='luar_negeri')
                {
                  $sumber_dana='Luar Negeri';
                }*/
                if ($pengajuan_sumber_dana_pengabdian['id_ref_sumber_dana']=='internal_PT')
                {
                  $sumber_dana='Internal PT';
                }
                else if ($pengajuan_sumber_dana_pengabdian['id_ref_sumber_dana']=='pemda')
                {
                  $sumber_dana='PEMDA';
                }
                else if ($pengajuan_sumber_dana_pengabdian['id_ref_sumber_dana']=='csr')
                {
                  $sumber_dana='CSR';
                }
                else if ($pengajuan_sumber_dana_pengabdian['id_ref_sumber_dana']=='lainnya_dalam_negeri')
                {
                  $sumber_dana='Lainnya Dalam Negeri';
                }
                else if ($pengajuan_sumber_dana_pengabdian['id_ref_sumber_dana']=='lainnya_luar_negeri')
                {
                  $sumber_dana='Lainnya Luar Negeri';
                }
              ?>
              <td><?php echo $sumber_dana;?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
    </table>
  <table width="715">
        <tr>
          <td width="469">&nbsp;</td>
            <td width="234">Bandung, <?php echo hari_ini()." ".tgl_indo_kata(date("Y-m-d"));?></td>
        </tr>
    </table>
  
      <table width="715">
        <tr>
          <td>Menyetujui</td>
            <td width="359">Hormat Saya, </td>
        </tr>
            <tr>
              <td>Ketua Prodi <?php echo $qa['jurusan'];?></td>
              <td>Ketua Pelaksana</td>
            </tr>
            <tr>
              <td><p align="center">&nbsp;</p>
                <p align="center">&nbsp;</p></td>
        </tr>
              <tr>
                <?php
                  //mencari kaprodi
                 $sql_pengabdian_kaprodi=mysqli_query($server1," SELECT
                                                                  b.`nip`,
                                                                  b.`nama`,
                                                                  b.`nidn`,
                                                                  IF((ISNULL(gelar_depan)&&(ISNULL(gelar_belakang))),CONCAT(nama), 
                                                                 IF(((gelar_depan!='')&&(ISNULL(gelar_belakang))),CONCAT(gelar_depan,' ',nama),
                                                                 IF((gelar_depan!=''),CONCAT(gelar_depan,' ', nama,' ',gelar_belakang),
                                                                 IF((ISNULL(gelar_depan)),CONCAT(nama,' ',gelar_belakang),
                                                                 IF((gelar_depan=''),CONCAT(nama,' ',gelar_belakang),'-'))))) AS nama_titel
                                                                  FROM
                                                                  integrasi.pejabat a
                                                                  INNER JOIN
                                                                  integrasi.karyawan b
                                                                  ON a.`nip`=b.`nip`
                                                                  WHERE 
                                                                  a.`kode_bagian`='".$qa['kodejur']."' AND jenis_jabatan='kaprodi';");
                 $pengabdian_kaprodi=mysqli_fetch_array($sql_pengabdian_kaprodi);
                ?>
                <td><?php echo $pengabdian_kaprodi['nama_titel'];?></td>
                <td><?php echo $x['nama_peneliti'];?></td>
              </tr>
           </tr>
              <tr>
                <td><?php echo $pengabdian_kaprodi['nip']." / ".$pengabdian_kaprodi['nidn'];?></td>
                <td><?php echo $x['nip']." / ".$x['nidn'];?></td>
              </tr>
    </table>
    <br>
   <table width="715">
        <tr>
          <td width="257">&nbsp;</td>
            <td width="446">Mengetahui</td>
        </tr>
    </table>
    </table>
      <br />
      <table width="715">
        <tr>
              <td>Dekan</td>
              <td width="359">Ketua Divisi Pengabdian dan Pemberdayaan</td>
        </tr>
            <tr>
              <td>Fakultas <?php echo ucwords(strtolower($qa['namafak']));?></td>
              <td>Masyarakat (DP2M) </td>
            </tr>
            <tr>
              <td><p align="center">&nbsp;</p>
                <p align="center">&nbsp;</p></td>
        </tr>
              <tr>
                <?php
                  //mencari dekan
                 $sql_pengabdian_dekan=mysqli_query($server1," SELECT
                                                                  b.`nip`,
                                                                  b.`nama`,
                                                                  b.`nidn`,
                                                                  IF((ISNULL(gelar_depan)&&(ISNULL(gelar_belakang))),CONCAT(nama), 
                                                                 IF(((gelar_depan!='')&&(ISNULL(gelar_belakang))),CONCAT(gelar_depan,' ',nama),
                                                                 IF((gelar_depan!=''),CONCAT(gelar_depan,' ', nama,' ',gelar_belakang),
                                                                 IF((ISNULL(gelar_depan)),CONCAT(nama,' ',gelar_belakang),
                                                                 IF((gelar_depan=''),CONCAT(nama,' ',gelar_belakang),'-'))))) AS nama_titel
                                                                  FROM
                                                                  integrasi.pejabat a
                                                                  INNER JOIN
                                                                  integrasi.karyawan b
                                                                  ON a.`nip`=b.`nip`
                                                                  WHERE 
                                                                  a.`kode_bagian`='".$qa['kodefak']."'");
                 $pengabdian_dekan=mysqli_fetch_array($sql_pengabdian_dekan);

                 //mencari ketua dp3m pengabdian
                  $sql_pengabdian_ketua=mysqli_query($server1,"SELECT
                                                                a.`kode_bagian`,
                                                                a.`nama_jabatan`,
                                                                b.`nip`,
                                                                b.`nidn`,
                                                                b.`nama`,
                                                                 IF((ISNULL(gelar_depan)&&(ISNULL(gelar_belakang))),CONCAT(nama), 
                                                                 IF(((gelar_depan!='')&&(ISNULL(gelar_belakang))),CONCAT(gelar_depan,' ',nama),
                                                                 IF((gelar_depan!=''),CONCAT(gelar_depan,' ', nama,' ',gelar_belakang),
                                                                 IF((ISNULL(gelar_depan)),CONCAT(nama,' ',gelar_belakang),
                                                                 IF((gelar_depan=''),CONCAT(nama,' ',gelar_belakang),'-'))))) AS nama_titel
                                                                FROM
                                                                 integrasi.pejabat a
                                                                INNER JOIN
                                                                 integrasi.karyawan b
                                                                ON 
                                                                 a.`nip` = b.`nip`
                                                                WHERE
                                                                 a.`kode_bagian`='122'");
                 $pengabdian_ketua=mysqli_fetch_array($sql_pengabdian_ketua);
                ?>
                <td><?php echo $pengabdian_dekan['nama_titel'];?></td>
                <td><?php echo $pengabdian_ketua['nama_titel'];?></td>
              </tr>
           </tr>
              <tr>
                <td><?php echo $pengabdian_dekan['nip']." / ".$pengabdian_dekan['nidn'];?></td>
                <td><?php echo $pengabdian_ketua['nip']." / ".$pengabdian_ketua['nidn'];?></td>
              </tr>
    </table>
    
  </div>
   <!-- end bagian halaman yang akan dikonversi -->

</body>
</html>



 
<!-- akhir pdf -->



<?php
        // Now collect the output buffer into a variable
        $html = ob_get_contents();
        ob_end_clean();

        // send the captured HTML from the output buffer to the mPDF class for processing
        $mpdf->WriteHTML($html);
       
        
        $mpdf->Output($nama_file.".pdf" ,'I');
?>