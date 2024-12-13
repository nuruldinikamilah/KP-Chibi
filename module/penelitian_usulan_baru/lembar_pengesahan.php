<?php
session_start();
ob_start();
include_once("../../config/tanggal.php");
include_once("../../config/f_rupiah.php");
include_once("../../config/koneksi.php"); //buat koneksi ke database
include_once ("../../lib/enkripsi_decrpt.php");


 //Define relative path from this script to mPDF
 
 $nama_file='Lembar Pengesahan Penelitian-'.date("Y"); //Beri nama file PDF hasil.
 define('_MPDF_PATH','../../lib/mpdf60/');
//define("_JPGRAPH_PATH", '../mpdf60/graph_cache/src/');

//define("_JPGRAPH_PATH", '../jpgraph/src/'); 
 
include(_MPDF_PATH . "mpdf.php");
//include(_MPDF_PATH . "graph.php");

//include(_MPDF_PATH . "graph_cache/src/");

$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
 
//Beginning Buffer to save PHP variables and HTML tags
//Memulai proses untuk menyimpan variabel php dan html
ob_start();
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
        <?php
                $idx=my_simple_crypt($_GET['idx'], 'd' );
                $sql_data_master=mysqli_query($server1,"SELECT * from pengajuan_penelitian where idx_penelitian='".$idx."'");
                $r=mysqli_fetch_array($sql_data_master);
            ?>
        <td width="703"><center><h2>HALAMAN PENGESAHAN<br>
          SKEMA <?php echo strtoupper($r['skema']);?>
        </h2></center>
        </td>
      </tr>
    </table>
    <br /><br>
            
          <table width="709">
          <tr>
            <td width="21">1.</td>
            <td width="228">Judul Penelitian </td>
            <td width="23">:</td>
            <td width="417"><?php echo $r['judul_penelitian'];?></td>
          </tr>
          <tr>
            <td valign="top">2.</td>
            <td valign="top"><b>Ketua Pelaksana</b></td>
            <td valign="top"></td>

            <td valign="top">&nbsp;</td>
          </tr>
          <?php
                $sql_data_pelaksana=mysqli_query($server1,"SELECT
                                                            *
                                                            FROM
                                                            `lppm2020`.`pengajuan_anggota_penelitian` a
                                                            INNER JOIN
                                                            `lppm2020`.`karyawan` b
                                                            ON a.`nip_anggota` = b.`nip`
                                                            where a.idx_penelitian='".$idx."' and status_peneliti='Ketua'");
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
            
            <tr>
              <td>3.</td>
              <td>Waktu Pelaksanaan </td>
              <td>:</td>
              <td><?php echo tgl_indo($r['tgl_awal_pelaksanaan'])." S/D ".tgl_indo($r['tgl_akhir_pelaksanaan']);?></td>
            </tr>
            <tr>
              <td>4.</td>
              <td>Luaran Yang Dihasilkan </td>
              <td>:</td>
              <td><?php echo $r['luaran'];?></td>
            </tr>
            <tr>
              <td>5.</td>
              <td>Mitra</td>
              <td>:</td>
              <td><?php echo $r['mitra'];?></td>
            </tr>
             <tr>
              <?php
                 $sql_pengajuan_dana_penelitian=mysqli_query($server1,"SELECT
                                                                        *, SUM(nominal_dana_pengajuan) AS jumlah_dana
                                                                        FROM
                                                                        pengajuan_dana_penelitian
                                                                        WHERE idx_penelitian='".$idx."'
                                                                        GROUP BY idx_penelitian;");
                 $pengajuan_dana_penelitian=mysqli_fetch_array($sql_pengajuan_dana_penelitian);
              ?>
            <tr>
              <td>6.</td>
              <td>Jumlah Dana </td>
              <td>:</td>
              <td>Rp. <?php echo rupiah($pengajuan_dana_penelitian['jumlah_dana']);?></td>
            </tr>
              <tr>
               <td>7.</td>
              <td>Kelompok Penelitian</td>
              <td>:</td>
              <td><?php echo ucwords($r['nama_kelompok_penelitian']);?></td>
            </tr>
            <tr>
               <td>8.</td>
              <td>Kelompok Keilmuan Program Studi</td>
              <td>:</td>
              <td><?php echo ucwords($r['nama_kelompok_keilmuan']);?></td>
            </tr>
 </table>
 <br><br><br><br><br><br>
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
              <td>Kepala Prodi <?php echo $qa['jurusan'];?></td>
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
    <br> <br> <br>
   <table width="715">
        <tr>
          <td width="673" align="center">Mengetahui</td>
            <td width="30">&nbsp;</td>
        </tr>
    </table>
    </table>
      <br />
      <table width="715">
        <tr>
              <td width="672" align="center">Dekan</td>
              <td width="31" align="center">&nbsp;</td>
        </tr>
            <tr>
              <td align="center">Fakultas <?php echo ucwords(strtolower($qa['namafak']));?></td>
              <td align="center">&nbsp;</td>
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
                                                                 a.`kode_bagian`='81'");
                 $pengabdian_ketua=mysqli_fetch_array($sql_pengabdian_ketua);
                ?>
                <td align="center"><?php echo $pengabdian_dekan['nama_titel'];?></td>
                <td>&nbsp;</td>
              </tr>
           </tr>
              <tr>
                <td align="center"><?php echo $pengabdian_dekan['nip']." / ".$pengabdian_dekan['nidn'];?></td>
                <td>&nbsp;</td>
              </tr>
    </table>
    
  </div>
   <!-- end bagian halaman yang akan dikonversi -->

</body>
</html>
<?php
//penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf

$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_file.".pdf" ,'I');
exit;
?>