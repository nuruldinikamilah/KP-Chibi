<?php

    session_start();

  //Defines the name of the export file "codelution-export.xls"
    include "../../lib/enkripsi_decrpt.php";
    include "../../config/koneksi.php";
    include "../../config/tanggal.php";


if(isset($_POST['submit'])) 
{ 
      $pilihan=$_POST['pilihan'];
      foreach($pilihan as $key=>$value)
       {
        $query[] = "kd_pro_thp_final="."'".$value."'"; // store in array
        
         $content = "SELECT 
                       *, `ref_dosen`.`nama` AS nama_dosen 
                      FROM 
                      proposal_tahap_final
                      INNER JOIN
                      ref_dosen
                      INNER JOIN
                      ref_keilmuan
                       ON `proposal_tahap_final`.`KODEPEMBIMBING` = ref_dosen.`kddosen` AND
                       `proposal_tahap_final`.`KELOMPOKKEILMUAN` = `ref_keilmuan`.`kd_keilmuan` WHERE  proposal_tahap_final.TAHUN='".$_SESSION['tahun_aktif']."' and proposal_tahap_final.STATUS='diterima' and proposal_tahap_final.SMT='".$_SESSION['semester_aktif']."' and (" . implode(' OR ', $query).");"; // implode with OR
       
       }
       
      $sql=mysqli_query($server1,$content);



//Define relative path from this script to mPDF
      $nama_file='cetak_kartu_bimbingan'; //Beri nama file PDF hasil.
      define('_MPDF_PATH','mpdf60/');
      //define("_JPGRAPH_PATH", '../mpdf60/graph_cache/src/');

      //define("_JPGRAPH_PATH", '../jpgraph/src/'); 
       
      include(_MPDF_PATH . "mpdf.php");
      //include(_MPDF_PATH . "graph.php");

      //include(_MPDF_PATH . "graph_cache/src/");

      $mpdf=new mPDF('utf-8', 'A5'); // Create new mPDF Document


      //Beginning Buffer to save PHP variables and HTML tags
      ob_start(); 

      $mpdf->useGraphs = true;
      $mpdf->AddPage('P','','','','',3,3,3,3,10,10);

      ?>
      <!DOCTYPE html>
      <html>
      <head>
          <title>xx</title>
          <style>
           body {
                  font-family: "Courier New", Courier, "Lucida Sans Typewriter";
              }
           table.timecard {
        margin: auto;
        width: 300px;
        border-collapse: collapse;
        border: 1px solid #fff; /*for older IE*/
        border-style: hidden;
      }

      table.timecard caption {
        background-color: #f79646;
        color: #fff;
        font-size: x-large;
        font-weight: bold;
        letter-spacing: .3em;
      }

      table.timecard thead th {
        padding: 8px;
        background-color: #fde9d9;
        font-size: large;
      }

      table.timecard thead th#thDay {
        width: 40%; 
      }

      table.timecard thead th#thRegular, table.timecard thead th#thOvertime, table.timecard thead th#thTotal {
        width: 20%;
      }

      table.timecard th, table.timecard td {
        padding: 15px;
        border-width: 1px;
        border-style: solid;
        border-color: #f79646 #ccc;

      }

      table.timecard td {
        text-align: right;


      }

      table.timecard tbody th {
        text-align: left;
        font-weight: normal;
      }
      
      P.blocktext {
    margin-left: auto;
    margin-right: auto;
    width: auto;
    text-align:center;
    font-size:8px;
    padding: 15px;
}
          </style>
      </head>
      <body>
      <div id="wrapper">
           <!-- Bagian halaman HTML yang akan konvert -->
      <?php
      while($r=mysqli_fetch_array($sql))
      {
        if ($r['JENIS']=='B')
        {
          $jenis = 'Baru';
        }
        else
        {
          $jenis = "Perpanjangan";
        }
        ?>
            <table width="710">
              <tr>
                 <td><p style="text-align:left; font-size: 16px; font-weight:bold;font-style: italic;">Fakultas Teknik dan Ilmu Komputer</p></td><td>Status Pengajuan : 
                  <?php echo $jenis;?></td>
              </tr>
               <tr>
                 <td><p style="text-align:left; font-size: 16px; font-weight:bold;">UNIVERSITAS KOMPUTER INDONESIA</p></td>
              </tr>
            </table>
            <br>
            <table width="710">
              <tr>
                 <td> <center><p style="text-align:center; font-size: 20px; font-weight:bold;">KARTU BIMBINGAN SKRIPSI</p></center></td>
              </tr>
             <tr>
                 <td> <center><p style="text-align:center; font-size: 20px; font-weight:bold;">PROGRAM STUDI TEKNIK INFORMATIKA</p></center></td>
              </tr>
              <tr>
                 <td> <center><p style="text-align:center; font-size: 20px; font-weight:bold;">SEMESTER <?php echo $r['SMT'];?> TAHUN AKADEMIK 
                  <?php echo $r['TAHUN']."/".intval($r['TAHUN']+1);?></p></center></td>
              </tr>
            </table>
            <hr>
            <table width="709">
              <tr>
                <td width="200"><strong>NIM/NAMA MAHASISWA</td>
                <td width="23"><strong>:</td>
                <td width="417"> <strong><?php echo $r['NIM']."/".$r['NAMA'];?></strong></td>
              </tr>
              <tr>
                <td><strong>NIP/NAMA PEMBIMBING</td>
                <td><strong>:</td>
                <td><div align="justify"><strong><?php echo $r['nip']."/".$r['nama_dosen'];?></strong></td>
              </tr>

              <tr>
                <td valign="top"><strong>JUDUL</td>
                <td valign="top"><strong>:</td>
               <td ><div align="justify"><strong><?php echo $r['JUDUL'];?></strong></td>
              </tr>
              
            </table>
            <hr>
            
             <?php
               if (strlen($r['JUDUL']) <= 60)
               {
                    ?>
                    <br><br>
                    <?php
                } 
                else 
                {
                  ?>
                  <br>
                  <?php
                }
                ?>
              
            <table width="709" class="timecard">
              <tr>
                <th width="2">NO</th>
                <th width="350">MATERI BIMBINGAN</th>
                <th width="70"> <strong>TANGGAL</strong></th>
                <th width="23"> <strong>PARAF PEMBIMBING</strong></th>
                <th width="23"> <strong>PARAF MAHASISWA</strong></th>
              </tr>
              <?php
                for ($x = 1; $x <= 12; $x++) 
                {
                  ?>
                   <tr>
                    <th><?php echo $x;?></th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                   <th>&nbsp;</th>
                  </tr>
                  <?php
                }
              ?>
            </table>
            <P class="blocktext">Dikembangkan Oleh Direktorat Pengembangan Teknologi & Sistem Informasi UNIKOM</P>
      <?php
      }
    }
      ?>



      <?php
      
      $html = ob_get_contents(); //Proses untuk mengambil data
      ob_end_clean();
      //Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
      $mpdf->WriteHTML(utf8_encode($html));
      // LOAD a stylesheet
      $stylesheet = file_get_contents('mpdfstyletables.css');
      $mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text

      $mpdf->WriteHTML($html,1);

      $mpdf->Output($nama_file."-".$data['no_sj'].".pdf" ,'I');

       


      exit; 

      ?>
      </body>
      </html>